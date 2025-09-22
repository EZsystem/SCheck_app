<?php

use App\Models\ScheckGeneralRange;
use App\Models\ScheckSite;
use App\Models\ScheckTopRange;
use App\Models\ScheckResult;
use App\Services\ScheckRunService;
use App\View\RunData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/scheck', function () {
    return view('scheck.index');
})->name('scheck.index');

Route::get('/scheck/environment', function () {
    $run = ScheckRunService::ensureRun();
    $param = RunData::for($run);

    return view('scheck.environment', compact('param'));
})->name('scheck.environment');

Route::post('/scheck/environment', function (Request $request) {
    $validated = $request->validate([
        'Vo' => ['required', 'integer', 'min:0', 'max:100'],
    ]);

    $run = ScheckRunService::ensureRun();
    ScheckRunService::resetRunData($run);
    ScheckRunService::updateSettings($run, ['Vo' => (int) $validated['Vo']]);

    session(['scheck_run_id' => $run->id]);

    return redirect()->route('scheck.s-coefficient');
})->name('scheck.environment.save');

Route::get('/scheck/s-coefficient', function () {
    $run = ScheckRunService::ensureRun();
    $param = RunData::for($run);

    $currentSValues = [];
    foreach (ScheckRunService::rangeCodes() as $code) {
        $currentSValues[$code] = $param->{"S{$code}"} ?? null;
    }

    return view('scheck.s-coefficient', [
        'param' => $param,
        'currentSValues' => $currentSValues,
    ]);
})->name('scheck.s-coefficient');

Route::post('/scheck/s-coefficient', function (Request $request) {
    $validated = $request->validate([
        'S10' => ['required', 'numeric'],
        'S20' => ['required', 'numeric'],
        'S35' => ['required', 'numeric'],
        'S40' => ['required', 'numeric'],
        'S50' => ['required', 'numeric'],
        'S55' => ['required', 'numeric'],
        'S70' => ['required', 'numeric'],
        'S100' => ['required', 'numeric'],
    ]);

    $run = ScheckRunService::ensureRun();

    foreach (ScheckRunService::rangeCodes() as $code) {
        $key = "S{$code}";
        ScheckRunService::updateGeneralRange($run, $code, ['S' => (float) $validated[$key]]);
    }

    session(['scheck_run_id' => $run->id]);

    return redirect()->route('scheck.ke-coefficient');
})->name('scheck.s-coefficient.save');

Route::get('/scheck/ke-coefficient', function () {
    $run = ScheckRunService::ensureRun();
    $param = RunData::for($run);

    return view('scheck.ke-coefficient', compact('param'));
})->name('scheck.ke-coefficient');

Route::post('/scheck/ke-coefficient', function (Request $request) {
    $validated = $request->validate([
        'Ke' => ['required', 'numeric', 'min:1.0', 'max:1.2'],
    ]);

    $run = ScheckRunService::ensureRun();
    ScheckRunService::updateSettings($run, ['Ke' => (float) $validated['Ke']]);

    session(['scheck_run_id' => $run->id]);

    return redirect()->route('scheck.eb-coefficient');
})->name('scheck.ke-coefficient.save');

Route::get('/scheck/eb-coefficient', function () {
    $run = ScheckRunService::ensureRun();
    $param = RunData::for($run);

    return view('scheck.eb-coefficient', compact('param'));
})->name('scheck.eb-coefficient');

Route::post('/scheck/eb-coefficient', function (Request $request) {
    $validated = $request->validate([
        'EB' => ['required', 'numeric', 'min:1.0', 'max:1.3'],
    ]);

    $run = ScheckRunService::ensureRun();
    ScheckRunService::updateSettings($run, ['EB' => (float) $validated['EB']]);

    session(['scheck_run_id' => $run->id]);

    return redirect()->route('scheck.eg-coefficient');
})->name('scheck.eb-coefficient.save');

Route::get('/scheck/eg-coefficient', function () {
    $run = ScheckRunService::ensureRun();
    $param = RunData::for($run);

    return view('scheck.eg-coefficient', compact('param'));
})->name('scheck.eg-coefficient');

Route::post('/scheck/eg-coefficient', function (Request $request) {
    $validated = $request->validate([
        'Eg' => ['required', 'numeric', 'min:1.0', 'max:1.3'],
    ]);

    $run = ScheckRunService::ensureRun();
    ScheckRunService::updateSettings($run, ['Eg' => (float) $validated['Eg']]);

    session(['scheck_run_id' => $run->id]);

    return redirect()->route('scheck.co-coefficient');
})->name('scheck.eg-coefficient.save');

Route::get('/scheck/co-coefficient', function () {
    $run = ScheckRunService::ensureRun();
    $param = RunData::for($run);

    return view('scheck.co-coefficient', compact('param'));
})->name('scheck.co-coefficient');

Route::post('/scheck/co-coefficient', function (Request $request) {
    $validated = $request->validate([
        'Co' => ['required', 'numeric', 'min:0.1', 'max:2.5'],
        'phi' => ['required', 'numeric', 'min:0.1', 'max:1.5'],
    ]);

    $run = ScheckRunService::ensureRun();
    ScheckRunService::updateSettings($run, [
        'Co' => (float) $validated['Co'],
        'phi' => (float) $validated['phi'],
    ]);

    session(['scheck_run_id' => $run->id]);

    return redirect()->route('scheck.allowable-stress');
})->name('scheck.co-coefficient.save');

Route::get('/scheck/allowable-stress', function () {
    $run = ScheckRunService::ensureRun();
    $param = RunData::for($run);

    return view('scheck.allowable-stress', compact('param'));
})->name('scheck.allowable-stress');

Route::post('/scheck/allowable-stress', function (Request $request) {
    $validated = $request->validate([
        'wall_tie_stress' => ['required', 'numeric', 'min:0.1', 'max:10.0'],
        'War' => ['required', 'numeric', 'min:0.0', 'max:10.0'],
    ]);

    $run = ScheckRunService::ensureRun();

    $wallTie = (float) $validated['wall_tie_stress'];
    $war = (float) $validated['War'];
    $wallTie2 = ceil($wallTie * $war * 100) / 100;

    ScheckRunService::updateSettings($run, [
        'wall_tie_stress' => $wallTie,
        'War' => $war,
        'wall_tie_stress2' => $wallTie2,
    ]);

    session(['scheck_run_id' => $run->id]);

    return redirect()->route('scheck.site');
})->name('scheck.allowable-stress.save');

Route::get('/scheck/site', function () {
    $run = ScheckRunService::ensureRun();
    $site = ScheckRunService::site($run);

    $prefill = [
        'Lg' => $site->Lg,
        'Bg' => $site->Bg,
        'Ba' => $site->Ba,
        'Ha' => $site->Ha,
    ];

    return view('scheck.site', compact('prefill'));
})->name('scheck.site');

Route::post('/scheck/site', function (Request $request) {
    $request->merge(collect(['Lg', 'Bg', 'Ba', 'Ha'])->mapWithKeys(fn ($key) => [
        $key => $request->input($key) === '' ? null : $request->input($key),
    ])->toArray());

    $validated = $request->validate([
        'Lg' => ['nullable', 'numeric', 'min:0', 'max:100'],
        'Bg' => ['nullable', 'numeric', 'min:0', 'max:100'],
        'Ba' => ['nullable', 'numeric', 'min:0', 'max:100'],
        'Ha' => ['nullable', 'numeric', 'min:0', 'max:100'],
    ]);

    $run = ScheckRunService::ensureRun();
    $data = [];
    foreach (['Lg', 'Bg', 'Ba', 'Ha'] as $key) {
        $data[$key] = array_key_exists($key, $validated) && !is_null($validated[$key])
            ? (float) $validated[$key]
            : null;
    }

    ScheckRunService::updateSite($run, $data);

    session(['scheck_run_id' => $run->id]);

    return redirect()->route('scheck.input-confirmation');
})->name('scheck.site.save');

Route::get('/scheck/site/get-last-values', function () {
    $lastSite = ScheckSite::where(function ($query) {
        $query->whereNotNull('Lg')
            ->orWhereNotNull('Bg')
            ->orWhereNotNull('Ba')
            ->orWhereNotNull('Ha');
    })->orderByDesc('updated_at')->first();

    if (!$lastSite) {
        return response()->json([
            'Lg' => null,
            'Bg' => null,
            'Ba' => null,
            'Ha' => null,
            'message' => '過去のデータが見つかりませんでした',
        ]);
    }

    return response()->json([
        'Lg' => $lastSite->Lg,
        'Bg' => $lastSite->Bg,
        'Ba' => $lastSite->Ba,
        'Ha' => $lastSite->Ha,
        'message' => '最終値を取得しました',
    ]);
})->name('scheck.site.get-last-values');

Route::post('/scheck/input-parameters', function (Request $request) {
    $heightRanges = ScheckRunService::rangeCodes();

    $rules = [];
    foreach ($heightRanges as $range) {
        $rules["L{$range}"] = ['nullable', 'numeric', 'min:0', 'max:100'];
        $rules["H{$range}"] = ['nullable', 'numeric', 'min:0', 'max:100'];
        $rules["A{$range}"] = ['nullable', 'numeric', 'min:0', 'max:10000'];
        $rules["Pbtm{$range}"] = ['nullable', 'numeric', 'min:0'];
    }

    $request->merge(collect(array_keys($rules))->mapWithKeys(fn ($key) => [
        $key => $request->input($key) === '' ? null : $request->input($key),
    ])->toArray());

    $validated = $request->validate($rules);

    $run = ScheckRunService::ensureRun();

    foreach ($heightRanges as $range) {
        $data = [
            'L' => array_key_exists("L{$range}", $validated) && !is_null($validated["L{$range}"])
                ? (float) $validated["L{$range}"]
                : null,
            'H' => array_key_exists("H{$range}", $validated) && !is_null($validated["H{$range}"])
                ? (float) $validated["H{$range}"]
                : null,
            'A' => array_key_exists("A{$range}", $validated) && !is_null($validated["A{$range}"])
                ? (float) $validated["A{$range}"]
                : null,
            'Pbtm' => array_key_exists("Pbtm{$range}", $validated) && !is_null($validated["Pbtm{$range}"])
                ? (float) $validated["Pbtm{$range}"]
                : null,
        ];

        $hasValue = collect($data)->contains(fn ($v) => !is_null($v));

        if ($hasValue) {
            ScheckRunService::updateGeneralRange($run, $range, array_filter($data, fn ($v) => !is_null($v)));
        } else {
            ScheckRunService::maybePruneGeneralRange($run, $range, $data);
        }
    }

    session(['scheck_run_id' => $run->id]);

    return redirect()->route('scheck.wind-pressure-result');
})->name('scheck.input-parameters.save');

Route::get('/scheck/input-parameters', function () {
    $run = ScheckRunService::ensureRun();
    $context = ScheckRunService::buildContext($run);
    $param = RunData::for($run);

    return view('scheck.input-parameters', [
        'param' => $param,
        'ranges' => $context['generalRanges'],
    ]);
})->name('scheck.input-parameters');

Route::get('/scheck/input-parameters/get-last-values', function () {
    $lastRange = ScheckGeneralRange::where(function ($query) {
        $query->whereNotNull('L')
            ->orWhereNotNull('H')
            ->orWhereNotNull('A')
            ->orWhereNotNull('Pbtm');
    })->orderByDesc('updated_at')->first();

    if (!$lastRange) {
        return response()->json([
            'widths' => [],
            'heights' => [],
            'areas' => [],
            'loads' => [],
            'message' => '過去のデータが見つかりませんでした',
        ]);
    }

    $runRanges = ScheckGeneralRange::where('run_id', $lastRange->run_id)->get();

    $widths = [];
    $heights = [];
    $areas = [];
    $loads = [];

    foreach (ScheckRunService::rangeCodes() as $range) {
        $record = $runRanges->firstWhere('range_code', $range);
        if ($record) {
            if (!is_null($record->L)) {
                $widths[$range] = $record->L;
            }
            if (!is_null($record->H)) {
                $heights[$range] = $record->H;
            }
            if (!is_null($record->A)) {
                $areas[$range] = $record->A;
            }
            if (!is_null($record->Pbtm)) {
                $loads[$range] = $record->Pbtm;
            }
        }
    }

    return response()->json([
        'widths' => $widths,
        'heights' => $heights,
        'areas' => $areas,
        'loads' => $loads,
        'message' => '最終値を取得しました',
    ]);
})->name('scheck.input-parameters.get-last-values');

Route::post('/scheck/input-parameters/update-area', function (Request $request) {
    $validated = $request->validate([
        'height_range' => ['required', 'numeric'],
        'width' => ['nullable', 'numeric', 'min:0', 'max:100'],
        'height' => ['nullable', 'numeric', 'min:0', 'max:100'],
    ]);

    $run = ScheckRunService::currentRun();
    if (!$run) {
        return response()->json(['error' => '計算対象が見つかりません'], 404);
    }

    $width = $validated['width'];
    $height = $validated['height'];
    $area = null;

    if (!is_null($width) && !is_null($height) && $width > 0 && $height > 0) {
        $area = $width * $height;
    }

    ScheckRunService::updateGeneralRange($run, (int) $validated['height_range'], ['A' => $area]);

    return response()->json(['success' => true, 'area' => $area]);
})->name('scheck.input-parameters.update-area');

Route::get('/scheck/input-confirmation', function () {
    $run = ScheckRunService::ensureRun();
    $context = ScheckRunService::buildContext($run);
    $param = RunData::for($run);

    return view('scheck.input-confirmation', [
        'param' => $param,
        'settings' => $context['settings'],
        'site' => $context['site'],
        'generalRanges' => $context['generalRanges'],
        'topRanges' => $context['topRanges'],
    ]);
})->name('scheck.input-confirmation');

Route::post('/scheck/calculate', function (Request $request) {
    $run = ScheckRunService::currentRun();

    if (!$run) {
        return redirect()->route('scheck.environment')->with('error', '計算対象が見つかりません。最初からやり直してください。');
    }

    $context = ScheckRunService::buildContext($run);
    $settings = $context['settings'];
    $site = $context['site'];
    $generalRanges = ScheckRunService::generalRanges($run);

    $vo = $settings->Vo;
    $ke = $settings->Ke;
    $eb = $settings->EB;
    $eg = $settings->Eg;

    $vzMeta = [];
    $qzMeta = [];

    foreach (ScheckRunService::rangeCodes() as $code) {
        $range = $generalRanges->get($code);
        $sValue = $range?->S;

        $computedVz = null;
        $computedQz = null;

        if (!is_null($vo) && !is_null($ke) && !is_null($eb) && !is_null($eg) && !is_null($sValue)) {
            $vz = $vo * $ke * $sValue * $eb * $eg;
            $computedVz = ceil($vz * 100) / 100;

            $qz = (5 / 8) * pow($vz, 2) / 1000;
            $computedQz = ceil($qz * 100) / 100;

            $vzMeta["Vz{$code}"] = $computedVz;
            $qzMeta["QzN{$code}"] = $computedQz;
        }

        ScheckRunService::updateGeneralRange($run, $code, [
            'Vz' => $computedVz,
            'QzN' => $computedQz,
        ]);
    }

    $phi = $settings->phi;
    $fValues = [];

    if (!is_null($phi)) {
        $fbtm = 1.0 + (0.31 * $phi);
        $fValues['Fbtm'] = ceil($fbtm * 100) / 100;
        $fValues['Ftop'] = 1.0;
        $fValues['r'] = ceil((1 - $phi) * 100) / 100;
    }

    $rg = null;
    if (!is_null($site->Lg) && !is_null($site->Bg) && $site->Bg != 0.0) {
        $ratioLB = $site->Lg / $site->Bg;
        $rGround = 0.5813 + 0.013 * $ratioLB - 0.0001 * pow($ratioLB, 2);
        $rg = ceil($rGround * 100) / 100;
    }

    $ra = null;
    if (!is_null($site->Ba) && !is_null($site->Ha) && $site->Ba != 0.0) {
        $ratioH2B = ($site->Ha * 2) / $site->Ba;
        $rAerial = 0.5813 + 0.013 * $ratioH2B - 0.001 * pow($ratioH2B, 2);
        $ra = ceil($rAerial * 100) / 100;
    }

    $fValues['Rg'] = $rg;
    $fValues['Ra'] = $ra;

    $rValue = $ra ?? $rg;
    $co = $settings->Co;

    if ($rValue !== null && $co !== null && isset($fValues['r'])) {
        $baseValue = 0.11 + (0.09 * $fValues['r']) + (0.945 * $co * $rValue);

        if (isset($fValues['Fbtm'])) {
            $fValues['C1'] = ceil($baseValue * $fValues['Fbtm'] * 100) / 100;
        }

        if (isset($fValues['Ftop'])) {
            $fValues['C2'] = ceil($baseValue * $fValues['Ftop'] * 100) / 100;
        }
    }

    $wallTie = $settings->wall_tie_stress;
    $war = $settings->War;
    $wallTie2 = null;
    if (!is_null($wallTie) && !is_null($war)) {
        $wallTie2 = ceil($wallTie * $war * 100) / 100;
        ScheckRunService::updateSettings($run, ['wall_tie_stress2' => $wallTie2]);
    }

    $resultPayload = [
        'r' => $fValues['r'] ?? null,
        'Fbtm' => $fValues['Fbtm'] ?? null,
        'Ftop' => $fValues['Ftop'] ?? null,
        'C1' => $fValues['C1'] ?? null,
        'C2' => $fValues['C2'] ?? null,
        'Rg' => $rg,
        'Ra' => $ra,
        'calculation_meta' => [
            'Vz' => $vzMeta,
            'QzN' => $qzMeta,
            'wall_tie_stress2' => $wallTie2,
            'R_value' => $rValue,
        ],
        'completed_at' => now(),
    ];

    ScheckRunService::updateResult($run, $resultPayload);

    $run->status = 'completed';
    $run->completed_at = now();
    if (!$run->started_at) {
        $run->started_at = now();
    }
    $run->save();

    session(['scheck_run_id' => $run->id]);

    return redirect()->route('scheck.calculation-result')->with('success', '計算が完了しました。');
})->name('scheck.calculate');

Route::get('/scheck/calculation-result', function () {
    $run = ScheckRunService::currentRun();

    if (!$run) {
        return redirect()->route('scheck.environment')->with('error', '計算が見つかりません。最初からやり直してください。');
    }

    $context = ScheckRunService::buildContext($run);
    $param = RunData::for($run);

    return view('scheck.calculation-result', [
        'param' => $param,
        'generalRanges' => $context['generalRanges'],
        'settings' => $context['settings'],
        'result' => $context['result'],
        'site' => $context['site'],
    ]);
})->name('scheck.calculation-result');

Route::get('/scheck/wind-pressure-result', function () {
    $run = ScheckRunService::ensureRun();
    $context = ScheckRunService::buildContext($run);
    $param = RunData::for($run);

    return view('scheck.wind-pressure-result', [
        'param' => $param,
        'topRanges' => $context['topRanges'],
        'generalRanges' => $context['generalRanges'],
        'settings' => $context['settings'],
        'result' => $context['result'],
    ]);
})->name('scheck.wind-pressure-result');

Route::get('/scheck/wind-pressure-result/get-last-values', function () {
    $lastTopRange = ScheckTopRange::where(function ($query) {
        $query->whereNotNull('Ltop')
            ->orWhereNotNull('Htopup')
            ->orWhereNotNull('Htopdn')
            ->orWhereNotNull('Ptop')
            ->orWhereNotNull('Wup')
            ->orWhereNotNull('Wdn');
    })->orderByDesc('updated_at')->first();

    if (!$lastTopRange) {
        $codes = ScheckRunService::rangeCodes();

        return response()->json([
            'widths' => array_fill_keys($codes, null),
            'heights_a' => array_fill_keys($codes, null),
            'heights_b' => array_fill_keys($codes, null),
            'loads' => array_fill_keys($codes, null),
            'wup' => array_fill_keys($codes, null),
            'wdn' => array_fill_keys($codes, null),
            'message' => '過去のデータが見つかりませんでした',
        ]);
    }

    $runRanges = ScheckTopRange::where('run_id', $lastTopRange->run_id)->get();

    $widths = [];
    $heightsA = [];
    $heightsB = [];
    $loads = [];
    $wupValues = [];
    $wdnValues = [];

    foreach (ScheckRunService::rangeCodes() as $range) {
        $record = $runRanges->firstWhere('range_code', $range);
        if ($record) {
            $widths[$range] = $record->Ltop;
            $heightsA[$range] = $record->Htopup;
            $heightsB[$range] = $record->Htopdn;
            $loads[$range] = $record->Ptop;
            $wupValues[$range] = $record->Wup;
            $wdnValues[$range] = $record->Wdn;
        } else {
            $widths[$range] = null;
            $heightsA[$range] = null;
            $heightsB[$range] = null;
            $loads[$range] = null;
            $wupValues[$range] = null;
            $wdnValues[$range] = null;
        }
    }

    return response()->json([
        'widths' => $widths,
        'heights_a' => $heightsA,
        'heights_b' => $heightsB,
        'loads' => $loads,
        'wup' => $wupValues,
        'wdn' => $wdnValues,
        'message' => '最終値を取得しました',
    ]);
})->name('scheck.wind-pressure-result.get-last-values');

Route::post('/scheck/wind-pressure-result/save-w-values', function (Request $request) {
    $validated = $request->validate([
        'height_range' => ['required', 'numeric'],
        'wup_value' => ['nullable', 'numeric'],
        'wdn_value' => ['nullable', 'numeric'],
    ]);

    $run = ScheckRunService::ensureRun();

    ScheckRunService::updateTopRange($run, (int) $validated['height_range'], [
        'Wup' => isset($validated['wup_value']) ? (float) $validated['wup_value'] : null,
        'Wdn' => isset($validated['wdn_value']) ? (float) $validated['wdn_value'] : null,
    ]);

    return response()->json([
        'success' => true,
        'wup' => $validated['wup_value'],
        'wdn' => $validated['wdn_value'],
    ]);
})->name('scheck.wind-pressure-result.save-w-values');

Route::post('/scheck/wind-pressure-result/finish-calculation', function (Request $request) {
    $validated = $request->validate([
        'load_values' => ['required', 'array'],
        'load_values.*' => ['nullable', 'numeric'],
        'width_values' => ['required', 'array'],
        'width_values.*' => ['nullable', 'numeric'],
        'height_a_values' => ['required', 'array'],
        'height_a_values.*' => ['nullable', 'numeric'],
        'height_b_values' => ['required', 'array'],
        'height_b_values.*' => ['nullable', 'numeric'],
    ]);

    $run = ScheckRunService::currentRun();
    if (!$run) {
        return response()->json(['error' => '計算対象が見つかりません'], 404);
    }

    foreach (ScheckRunService::rangeCodes() as $range) {
        $attributes = [
            'Ltop' => $validated['width_values'][$range] ?? null,
            'Htopup' => $validated['height_a_values'][$range] ?? null,
            'Htopdn' => $validated['height_b_values'][$range] ?? null,
            'Ptop' => $validated['load_values'][$range] ?? null,
        ];

        $filtered = collect($attributes)->filter(fn ($v) => !is_null($v));

        if ($filtered->isEmpty()) {
            ScheckRunService::maybePruneTopRange($run, $range, $attributes);
        } else {
            $floatAttributes = $filtered->map(fn ($v) => (float) $v)->all();
            ScheckRunService::updateTopRange($run, $range, $floatAttributes);
        }
    }

    session(['scheck_run_id' => $run->id]);

    return response()->json(['success' => true, 'message' => '計算が完了しました']);
})->name('scheck.wind-pressure-result.finish-calculation');

Route::get('/scheck/calculation-summary', function () {
    $run = ScheckRunService::currentRun();

    if (!$run) {
        return redirect()->route('scheck.environment')->with('error', '計算が見つかりません。最初からやり直してください。');
    }

    $context = ScheckRunService::buildContext($run);
    $param = RunData::for($run);

    return view('scheck.calculation-summary', [
        'param' => $param,
        'settings' => $context['settings'],
        'site' => $context['site'],
        'generalRanges' => $context['generalRanges'],
        'topRanges' => $context['topRanges'],
        'result' => $context['result'],
    ]);
})->name('scheck.calculation-summary');

Route::get('/scheck/calculation-summary/export-csv', function () {
    $run = ScheckRunService::currentRun();

    if (!$run) {
        return redirect()->route('scheck.environment')->with('error', '計算が見つかりません。最初からやり直してください。');
    }

    $context = ScheckRunService::buildContext($run);
    $param = RunData::for($run);

    $csvData = [];
    $csvData[] = ['計算結果一覧', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['出力日時', now()->format('Y-m-d H:i:s'), '', '', '', '', '', '', '', ''];
    $csvData[] = ['', '', '', '', '', '', '', '', '', ''];

    $settings = $context['settings'];
    $site = $context['site'];
    $generalRanges = $context['generalRanges'];
    $topRanges = $context['topRanges'];
    $result = $context['result'];

    $csvData[] = ['基本パラメータ', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['Vo', $settings->Vo ?? '-', 'Ke', $settings->Ke ?? '-', 'EB', $settings->EB ?? '-', 'Eg', $settings->Eg ?? '-', 'Co', $settings->Co ?? '-'];
    $csvData[] = ['phi', $settings->phi ?? '-', 'War', $settings->War ?? '-', 'wall_tie_stress', $settings->wall_tie_stress ?? '-', 'wall_tie_stress2', $settings->wall_tie_stress2 ?? '-', ''];
    $csvData[] = ['', '', '', '', '', '', '', '', '', ''];

    $csvData[] = ['L、H寸法', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['Lg（地上建物長さ）', $site->Lg ? number_format($site->Lg, 1) . 'm' : '-', 'Bg（地上建物幅）', $site->Bg ? number_format($site->Bg, 1) . 'm' : '-', '', '', '', '', '', ''];
    $csvData[] = ['Ba（空中建物幅）', $site->Ba ? number_format($site->Ba, 1) . 'm' : '-', 'Ha（空中建物高さ）', $site->Ha ? number_format($site->Ha, 1) . 'm' : '-', '', '', '', '', '', ''];
    $csvData[] = ['', '', '', '', '', '', '', '', '', ''];

    $csvData[] = ['【一般部】足場に作用する風圧力Ｐ（kN）', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['位置高さ(m)', 'S', '壁繋ぎ自担数値_幅(m)', '壁繋ぎ自担数値_高さ(m)', '限界高(m)', '負荷荷重(KN)', '壁繋ぎ許容応力(KN)', '判定', '', ''];

    foreach (ScheckRunService::rangeCodes() as $code) {
        $range = $generalRanges->get($code);
        $label = match ($code) {
            10 => '0～10',
            20 => '10～20',
            35 => '20～35',
            40 => '35～40',
            50 => '40～50',
            55 => '50～55',
            70 => '55～70',
            100 => '70～100',
            default => (string) $code,
        };

        $sValue = $range?->S;
        $width = $range?->L;
        $height = $range?->H;
        $pbtm = $range?->Pbtm;
        $wallTie = $settings->wall_tie_stress2;
        $qzN = $range?->QzN;
        $c1 = $result->C1;

        $limitHeight = null;
        if ($qzN && $c1 && $width && $wallTie) {
            $limitHeight = floor(($wallTie / ($qzN * $c1 * $width)) * 1000) / 1000;
        }

        $judgment = '-';
        if ($pbtm && $wallTie) {
            $judgment = $pbtm <= $wallTie ? 'OK' : 'NG';
        }

        $csvData[] = [
            $label,
            $sValue !== null ? number_format($sValue, 2) : '-',
            $width !== null ? number_format($width, 1) : '-',
            $height !== null ? number_format($height, 1) : '-',
            $limitHeight !== null ? number_format($limitHeight, 3) : '-',
            $pbtm !== null ? number_format($pbtm, 3) : '-',
            $wallTie !== null ? number_format($wallTie, 2) : '-',
            $judgment,
            '',
            '',
        ];
    }

    $csvData[] = ['', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['【突出部】足場に作用する風圧力Ｐ（kN）', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['位置高さ(m)', 'S', '幅(m)', '設定高名', '設定高(m)', '限界高(m)', '負荷荷重(KN)', '壁繋ぎ許容応力(KN)', '判定', ''];

    foreach (ScheckRunService::rangeCodes() as $code) {
        $label = match ($code) {
            10 => '0～10',
            20 => '10～20',
            35 => '20～35',
            40 => '35～40',
            50 => '40～50',
            55 => '50～55',
            70 => '55～70',
            100 => '70～100',
            default => (string) $code,
        };

        $general = $generalRanges->get($code);
        $top = $topRanges->get($code);

        $sValue = $general?->S;
        $width = $top?->Ltop;
        $heightA = $top?->Htopup;
        $heightB = $top?->Htopdn;
        $pTop = $top?->Ptop;
        $wallTie = $settings->wall_tie_stress2;
        $qzN = $general?->QzN;
        $c1 = $result->C1;

        $limitHeight = null;
        if ($qzN && $c1 && $width && $wallTie) {
            $limitHeight = floor(($wallTie / ($qzN * $c1 * $width)) * 1000) / 1000;
        }

        $judgment = '-';
        if ($pTop && $wallTie) {
            $judgment = $pTop <= $wallTie ? 'OK' : 'NG';
        }

        $csvData[] = [
            $label,
            $sValue !== null ? number_format($sValue, 2) : '-',
            $width !== null ? number_format($width, 1) : '-',
            'A',
            $heightA !== null ? number_format($heightA, 1) : '-',
            $limitHeight !== null ? number_format($limitHeight, 3) : '-',
            $pTop !== null ? number_format($pTop, 3) : '-',
            $wallTie !== null ? number_format($wallTie, 2) : '-',
            $judgment,
            '',
        ];

        $csvData[] = [
            '',
            '',
            '',
            'B',
            $heightB !== null ? number_format($heightB, 1) : '-',
            $limitHeight !== null ? number_format($limitHeight, 3) : '-',
            '',
            '',
            '',
            '',
        ];
    }

    $csvData[] = ['', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['計算係数', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['C1', $result->C1 ? number_format($result->C1, 2) : '-', 'C2', $result->C2 ? number_format($result->C2, 2) : '-', '', '', '', '', '', ''];
    $csvData[] = ['r', $result->r ? number_format($result->r, 2) : '-', '壁繋ぎ許容応力', $settings->wall_tie_stress2 ? number_format($settings->wall_tie_stress2, 2) : '-', '', '', '', '', '', ''];

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="計算結果一覧_' . now()->format('Y-m-d_H-i-s') . '.csv"',
    ];

    $callback = function () use ($csvData) {
        $handle = fopen('php://output', 'w');
        fwrite($handle, "\xEF\xBB\xBF");
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
    };

    return response()->stream($callback, 200, $headers);
})->name('scheck.calculation-summary.export-csv');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
