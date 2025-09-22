<?php

namespace App\View;

use App\Models\ScheckGeneralRange;
use App\Models\ScheckResult;
use App\Models\ScheckRun;
use App\Models\ScheckSetting;
use App\Models\ScheckSite;
use App\Models\ScheckTopRange;
use App\Services\ScheckRunService;
use Illuminate\Support\Collection;

class RunData
{
    public function __construct(
        public ScheckRun $run,
        public ScheckSetting $settings,
        public ScheckSite $site,
        /** @var Collection<int,ScheckGeneralRange> */
        public Collection $generalRanges,
        /** @var Collection<int,ScheckTopRange> */
        public Collection $topRanges,
        public ScheckResult $result,
    ) {}

    public static function for(ScheckRun $run): self
    {
        $context = ScheckRunService::buildContext($run);

        return new self(
            $run,
            $context['settings'],
            $context['site'],
            $context['generalRanges'],
            $context['topRanges'],
            $context['result'],
        );
    }

    public function __get(string $name)
    {
        // Settings mapping
        if (in_array($name, ['Vo', 'Ke', 'EB', 'Eg', 'Co', 'phi', 'wall_tie_stress', 'wall_tie_stress2', 'War'], true)) {
            return $this->settings->{$name} ?? null;
        }

        // Site mapping
        if (in_array($name, ['Lg', 'Bg', 'Ba', 'Ha'], true)) {
            return $this->site->{$name} ?? null;
        }

        // Result mapping
        if (in_array($name, ['r', 'Fbtm', 'Ftop', 'C1', 'C2', 'Rg', 'Ra'], true)) {
            return $this->result->{$name} ?? null;
        }

        if ($name === 'calculation_meta') {
            return $this->result->calculation_meta ?? [];
        }

        if ($name === 'completed_at') {
            return $this->result->completed_at;
        }

        // General range mapping (S/L/H/A/Pbtm/Vz/QzN/Wup/Wdn)
        if (preg_match('/^(S|L|H|A|Pbtm|Vz|QzN|Wup|Wdn)(\d+)$/', $name, $matches)) {
            [$full, $column, $code] = $matches;
            $range = $this->generalRanges->get((int) $code);

            if (!$range) {
                $range = null;
            }

            $column = match ($column) {
                'S' => 'S',
                'L' => 'L',
                'H' => 'H',
                'A' => 'A',
                'Pbtm' => 'Pbtm',
                'Vz' => 'Vz',
                'QzN' => 'QzN',
                'Wup' => 'Wup',
                'Wdn' => 'Wdn',
                default => null,
            };

            $value = $column && $range ? $range->{$column} : null;

            if (in_array($column, ['Wup', 'Wdn'], true) && (is_null($value) || $value === '')) {
                $topRange = $this->topRanges->get((int) $code);
                if ($topRange) {
                    $value = $topRange->{$column} ?? null;
                }
            }

            return $value;
        }

        // Top range mapping (Ltop/Htopup/Htopdn/Ptop/Wup/Wdn)
        if (preg_match('/^(Ltop|Htopup|Htopdn|Ptop|TopWup|TopWdn)(\d+)$/', $name, $matches)) {
            [$full, $column, $code] = $matches;
            $range = $this->topRanges->get((int) $code);

            if (!$range) {
                return null;
            }

            $column = match ($column) {
                'Ltop' => 'Ltop',
                'Htopup' => 'Htopup',
                'Htopdn' => 'Htopdn',
                'Ptop' => 'Ptop',
                'TopWup' => 'Wup',
                'TopWdn' => 'Wdn',
                default => null,
            };

            return $column ? $range->{$column} : null;
        }

        return null;
    }
}
