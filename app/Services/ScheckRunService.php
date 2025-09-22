<?php

namespace App\Services;

use App\Models\ScheckGeneralRange;
use App\Models\ScheckResult;
use App\Models\ScheckRun;
use App\Models\ScheckSetting;
use App\Models\ScheckSite;
use App\Models\ScheckTopRange;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ScheckRunService
{
    /**
     * Codes shared across general/top range tables.
     *
     * @return array<int>
     */
    public static function rangeCodes(): array
    {
        return [10, 20, 35, 40, 50, 55, 70, 100];
    }

    /**
     * Create a new run and register it in session.
     */
    public static function startNewRun(): ScheckRun
    {
        $run = ScheckRun::create([
            'status' => 'draft',
            'started_at' => now(),
        ]);

        session([
            'scheck_run_id' => $run->id,
        ]);

        return $run;
    }

    /**
     * Get the current run from session if present.
     */
    public static function currentRun(): ?ScheckRun
    {
        $runId = session('scheck_run_id');

        return $runId ? ScheckRun::find($runId) : null;
    }

    /**
     * Ensure a run is available (create if missing).
     */
    public static function ensureRun(): ScheckRun
    {
        $run = self::currentRun();

        if ($run) {
            return $run;
        }

        return self::startNewRun();
    }

    /**
     * Retrieve setting model (unsaved instance if not present).
     */
    public static function settings(ScheckRun $run): ScheckSetting
    {
        return ScheckSetting::firstOrNew(['run_id' => $run->id]);
    }

    /**
     * Update settings for the run.
     */
    public static function updateSettings(ScheckRun $run, array $attributes): ScheckSetting
    {
        $settings = self::settings($run);
        $settings->fill($attributes);
        $settings->run_id = $run->id;
        $settings->save();

        return $settings;
    }

    /**
     * Retrieve site model.
     */
    public static function site(ScheckRun $run): ScheckSite
    {
        return ScheckSite::firstOrNew(['run_id' => $run->id]);
    }

    /**
     * Update site values.
     */
    public static function updateSite(ScheckRun $run, array $attributes): ScheckSite
    {
        $site = self::site($run);
        $site->fill($attributes);
        $site->run_id = $run->id;
        $site->save();

        return $site;
    }

    /**
     * Retrieve all general range records keyed by range code.
     */
    public static function generalRanges(ScheckRun $run): Collection
    {
        return ScheckGeneralRange::where('run_id', $run->id)->get()->keyBy('range_code');
    }

    /**
     * Update a single general range row.
     */
    public static function updateGeneralRange(ScheckRun $run, int $rangeCode, array $attributes): ScheckGeneralRange
    {
        return tap(ScheckGeneralRange::updateOrCreate(
            ['run_id' => $run->id, 'range_code' => $rangeCode],
            Arr::only($attributes, [
                'S', 'L', 'H', 'A', 'Pbtm', 'Vz', 'QzN', 'Wup', 'Wdn',
            ])
        ))->refresh();
    }

    /**
     * Remove general range row when all attributes are null.
     */
    public static function maybePruneGeneralRange(ScheckRun $run, int $rangeCode, array $attributes): void
    {
        if (collect($attributes)->filter(fn ($v) => !is_null($v))->isEmpty()) {
            ScheckGeneralRange::where('run_id', $run->id)
                ->where('range_code', $rangeCode)
                ->delete();
        }
    }

    /**
     * Retrieve all top range records keyed by range code.
     */
    public static function topRanges(ScheckRun $run): Collection
    {
        return ScheckTopRange::where('run_id', $run->id)->get()->keyBy('range_code');
    }

    /**
     * Update a top range entry.
     */
    public static function updateTopRange(ScheckRun $run, int $rangeCode, array $attributes): ScheckTopRange
    {
        return tap(ScheckTopRange::updateOrCreate(
            ['run_id' => $run->id, 'range_code' => $rangeCode],
            Arr::only($attributes, [
                'Ltop', 'Htopup', 'Htopdn', 'Ptop', 'Wup', 'Wdn',
            ])
        ))->refresh();
    }

    /**
     * Remove a top range row when attributes are all null.
     */
    public static function maybePruneTopRange(ScheckRun $run, int $rangeCode, array $attributes): void
    {
        if (collect($attributes)->filter(fn ($v) => !is_null($v))->isEmpty()) {
            ScheckTopRange::where('run_id', $run->id)
                ->where('range_code', $rangeCode)
                ->delete();
        }
    }

    /**
     * Retrieve result model.
     */
    public static function result(ScheckRun $run): ScheckResult
    {
        return ScheckResult::firstOrNew(['run_id' => $run->id]);
    }

    /**
     * Update aggregated result data.
     */
    public static function updateResult(ScheckRun $run, array $attributes): ScheckResult
    {
        $result = self::result($run);
        $result->fill($attributes);
        $result->run_id = $run->id;
        $result->save();

        return $result;
    }

    /**
     * Build context array used by multiple views.
     */
    public static function buildContext(ScheckRun $run): array
    {
        $settings = self::settings($run);
        $site = self::site($run);
        $generalRanges = self::generalRanges($run);
        $topRanges = self::topRanges($run);
        $result = self::result($run);

        return compact('settings', 'site', 'generalRanges', 'topRanges', 'result');
    }

    /**
     * Clear related data so the run can be reused from scratch.
     */
    public static function resetRunData(ScheckRun $run): void
    {
        ScheckGeneralRange::where('run_id', $run->id)->delete();
        ScheckTopRange::where('run_id', $run->id)->delete();
        ScheckSetting::where('run_id', $run->id)->delete();
        ScheckSite::where('run_id', $run->id)->delete();
        ScheckResult::where('run_id', $run->id)->delete();

        $run->status = 'draft';
        $run->completed_at = null;
        if (!$run->started_at) {
            $run->started_at = now();
        }
        $run->save();
    }
}
