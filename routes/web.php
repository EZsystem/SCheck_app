<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 構造計算システム（テスト用：認証無効）
Route::get('/scheck', function () {
    return view('scheck.index');
})->name('scheck.index');

Route::get('/scheck/environment', function () {
    return view('scheck.environment');
})->name('scheck.environment');

// 環境画面: Vo 保存
Route::post('/scheck/environment', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'Vo' => ['required', 'integer', 'min:0', 'max:100'],
    ]);

    // 保存
    $param = new \App\Models\ScheckParam();
    $param->Vo = $validated['Vo'];
    $param->save();

    // セッションにIDを保持
    session(['scheck_param_id' => $param->id]);

    // 次画面へ
    return redirect()->route('scheck.s-coefficient');
})->name('scheck.environment.save');

// S係数保存
Route::post('/scheck/s-coefficient', function (\Illuminate\Http\Request $request) {
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

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        $param = new \App\Models\ScheckParam();
    }

    $param->fill($validated);
    $param->save();
    session(['scheck_param_id' => $param->id]);

    return redirect()->route('scheck.ke-coefficient');
})->name('scheck.s-coefficient.save');

Route::get('/scheck/s-coefficient', function () {
    return view('scheck.s-coefficient');
})->name('scheck.s-coefficient');

// Ke係数保存
Route::post('/scheck/ke-coefficient', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'Ke' => ['required', 'numeric', 'min:1.0', 'max:1.2'],
    ]);

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        $param = new \App\Models\ScheckParam();
    }

    $param->fill($validated);
    $param->save();
    session(['scheck_param_id' => $param->id]);

    return redirect()->route('scheck.eb-coefficient');
})->name('scheck.ke-coefficient.save');

Route::get('/scheck/ke-coefficient', function () {
    return view('scheck.ke-coefficient');
})->name('scheck.ke-coefficient');

// EB係数保存
Route::post('/scheck/eb-coefficient', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'EB' => ['required', 'numeric', 'min:1.0', 'max:1.3'],
    ]);

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        $param = new \App\Models\ScheckParam();
    }

    $param->fill($validated);
    $param->save();
    session(['scheck_param_id' => $param->id]);

    return redirect()->route('scheck.eg-coefficient');
})->name('scheck.eb-coefficient.save');

Route::get('/scheck/eb-coefficient', function () {
    return view('scheck.eb-coefficient');
})->name('scheck.eb-coefficient');

// Eg係数保存
Route::post('/scheck/eg-coefficient', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'Eg' => ['required', 'numeric', 'min:1.0', 'max:1.3'],
    ]);

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        $param = new \App\Models\ScheckParam();
    }

    $param->fill($validated);
    $param->save();
    session(['scheck_param_id' => $param->id]);

    return redirect()->route('scheck.co-coefficient');
})->name('scheck.eg-coefficient.save');

Route::get('/scheck/eg-coefficient', function () {
    return view('scheck.eg-coefficient');
})->name('scheck.eg-coefficient');

// Co係数保存
Route::post('/scheck/co-coefficient', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'Co' => ['required', 'numeric', 'min:0.1', 'max:2.5'],
        'phi' => ['required', 'numeric', 'min:0.1', 'max:1.5'],
    ]);

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        $param = new \App\Models\ScheckParam();
    }

    $param->fill($validated);
    $param->save();
    session(['scheck_param_id' => $param->id]);

    return redirect()->route('scheck.allowable-stress');
})->name('scheck.co-coefficient.save');

Route::get('/scheck/co-coefficient', function () {
    return view('scheck.co-coefficient');
})->name('scheck.co-coefficient');

// 許容応力保存
Route::post('/scheck/allowable-stress', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'wall_tie_stress' => ['required', 'numeric', 'min:0.1', 'max:10.0'],
        'War' => ['required', 'numeric', 'min:0.0', 'max:10.0'],
    ]);

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        $param = new \App\Models\ScheckParam();
    }

    $param->fill($validated);
    $param->save();
    session(['scheck_param_id' => $param->id]);

    return redirect()->route('scheck.site');
})->name('scheck.allowable-stress.save');

Route::get('/scheck/allowable-stress', function () {
    return view('scheck.allowable-stress');
})->name('scheck.allowable-stress');

// パラメータ入力保存
Route::post('/scheck/input-parameters', function (\Illuminate\Http\Request $request) {
    // 動的にバリデーションルールを作成
    $rules = [];
    $heightRanges = ['10', '20', '35', '40', '50', '55', '70', '100'];

    foreach ($heightRanges as $range) {
        $rules["L{$range}"] = ['nullable', 'numeric', 'min:0', 'max:100'];
        $rules["H{$range}"] = ['nullable', 'numeric', 'min:0', 'max:100'];
        $rules["A{$range}"] = ['nullable', 'numeric', 'min:0', 'max:10000'];
        $rules["Pbtm{$range}"] = ['nullable', 'numeric', 'min:0'];
    }

    $validated = $request->validate($rules);

    // デバッグ用：受信データをログ出力
    Log::info('Input Parameters Received:', $request->all());
    Log::info('Validated Data:', $validated);

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        $param = new \App\Models\ScheckParam();
    }

    $param->fill($validated);
    $param->save();
    session(['scheck_param_id' => $param->id]);

    // デバッグ用：保存後のデータをログ出力
    Log::info('Saved Param Data:', $param->toArray());

    return redirect()->route('scheck.wind-pressure-result');
})->name('scheck.input-parameters.save');

Route::get('/scheck/input-parameters', function () {
    // セッションからパラメータIDを取得
    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;

    return view('scheck.input-parameters', compact('param'));
})->name('scheck.input-parameters');

// input-parameters 最終値取得API
Route::get('/scheck/input-parameters/get-last-values', function () {
    // 現在のセッションのレコードIDを取得
    $currentId = session('scheck_param_id');

    // 現在のレコード以外で最新のレコードを取得（L系列またはH系列のいずれかが入力されているもの）
    $lastParam = \App\Models\ScheckParam::where(function ($query) {
        $query->whereNotNull('L10')->orWhereNotNull('L20')->orWhereNotNull('L35')->orWhereNotNull('L40')
            ->orWhereNotNull('L50')->orWhereNotNull('L55')->orWhereNotNull('L70')->orWhereNotNull('L100')
            ->orWhereNotNull('H10')->orWhereNotNull('H20')->orWhereNotNull('H35')->orWhereNotNull('H40')
            ->orWhereNotNull('H50')->orWhereNotNull('H55')->orWhereNotNull('H70')->orWhereNotNull('H100');
    })
        ->when($currentId, function ($query, $currentId) {
            return $query->where('id', '!=', $currentId);
        })
        ->orderBy('id', 'desc')
        ->first();

    if (!$lastParam) {
        return response()->json([
            'widths' => [],
            'heights' => [],
            'message' => '過去のデータが見つかりませんでした'
        ]);
    }

    // L系列（幅）の値を取得
    $widths = [];
    $heightRanges = ['10', '20', '35', '40', '50', '55', '70', '100'];

    foreach ($heightRanges as $range) {
        $lValue = $lastParam->{"L{$range}"};
        if ($lValue !== null) {
            $widths[$range] = $lValue;
        }
    }

    // H系列（高さ）の値を取得
    $heights = [];
    foreach ($heightRanges as $range) {
        $hValue = $lastParam->{"H{$range}"};
        if ($hValue !== null) {
            $heights[$range] = $hValue;
        }
    }

    return response()->json([
        'widths' => $widths,
        'heights' => $heights,
        'message' => '最終値を取得しました'
    ]);
})->name('scheck.input-parameters.get-last-values');

// リアルタイム面積計算保存
Route::post('/scheck/input-parameters/update-area', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'height_range' => ['required', 'string'],
        'width' => ['nullable', 'numeric', 'min:0', 'max:100'],
        'height' => ['nullable', 'numeric', 'min:0', 'max:100'],
    ]);

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        return response()->json(['error' => 'パラメータが見つかりません'], 404);
    }

    $heightRange = $validated['height_range'];
    $width = $validated['width'];
    $height = $validated['height'];

    // 面積計算とAカラムへの保存
    if ($width > 0 && $height > 0) {
        $area = $width * $height;
        $aColumn = "A{$heightRange}";
        $param->{$aColumn} = $area;
    } else {
        // どちらかが0または空の場合はAカラムをクリア
        $aColumn = "A{$heightRange}";
        $param->{$aColumn} = null;
    }

    $param->save();

    return response()->json(['success' => true, 'area' => $param->{$aColumn}]);
})->name('scheck.input-parameters.update-area');

Route::get('/scheck/input-confirmation', function () {
    // セッションからパラメータIDを取得
    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;

    return view('scheck.input-confirmation', compact('param'));
})->name('scheck.input-confirmation');

// 計算実行
Route::post('/scheck/calculate', function (\Illuminate\Http\Request $request) {
    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;

    if (!$param) {
        return redirect()->route('scheck.environment')->with('error', 'パラメータが見つかりません。最初からやり直してください。');
    }

    // Vz系列の計算（Vz = Vo × Ke × S × EB × Eg）
    $vzValues = [];
    $qzValues = [];
    $fValues = [];

    $heightRanges = ['10', '20', '35', '40', '50', '55', '70', '100'];

    foreach ($heightRanges as $height) {
        $sKey = "S{$height}";
        $vzKey = "Vz{$height}";
        $qzKey = "QzN{$height}";

        // Vz計算: Vz = Vo × Ke × S × EB × Eg
        if ($param->Vo && $param->Ke && $param->{$sKey} && $param->EB && $param->Eg) {
            $vz = $param->Vo * $param->Ke * $param->{$sKey} * $param->EB * $param->Eg;
            // 小数点第3位を切り上げ（小数点第2位まで表示）
            $vzValues[$vzKey] = ceil($vz * 100) / 100;

            // QzN計算: Qz = (5/8 × Vz^2) / 1000
            $qz = (5 / 8) * pow($vz, 2);
            // 1000で割って、小数点第3位を切り上げ（小数点第2位まで表示）
            $qzFinal = $qz / 1000;
            $qzValues[$qzKey] = ceil($qzFinal * 100) / 100;
        }
    }

    // Fbtm と Ftop の計算
    if ($param->phi) {
        // Fbtm = (1.0 + 0.31 × phi)
        $fbtm = 1.0 + (0.31 * $param->phi);
        // 小数点第3位を切り上げ（小数点第2位まで表示）
        $fValues['Fbtm'] = ceil($fbtm * 100) / 100;

        // Ftop = 1
        $fValues['Ftop'] = 1.0;
    }

    // rの計算（r = 1 - phi）
    if ($param->phi) {
        $r = 1 - $param->phi;
        $fValues['r'] = ceil($r * 100) / 100;
    }

    // R値の計算
    $RValue = null;

    // 地上から建つ場合のR値計算
    if ($param->Lg && $param->Bg) {
        $ratio_LB = $param->Lg / $param->Bg;
        $rGround = 0.5813 + 0.013 * $ratio_LB - 0.0001 * pow($ratio_LB, 2);
        $RValue = $rGround;
    }

    // 空中にある場合のR値計算（地上の場合がない場合、または両方ある場合は空中を優先）
    if ($param->Ba && $param->Ha) {
        $ratio_H2B = ($param->Ha * 2) / $param->Ba;
        $rAerial = 0.5813 + 0.013 * $ratio_H2B - 0.001 * pow($ratio_H2B, 2);
        $RValue = $rAerial;
    }

    // C1とC2の計算（r、Co、R、Fbtm、Ftop が必要）
    if (isset($fValues['r']) && $param->Co && $RValue !== null && isset($fValues['Fbtm']) && isset($fValues['Ftop'])) {
        // C1 = (0.11 + 0.09 × r + 0.945 × Co × R) × Fbtm
        $baseValue = 0.11 + (0.09 * $fValues['r']) + (0.945 * $param->Co * $RValue);
        $c1Value = $baseValue * $fValues['Fbtm'];
        $fValues['C1'] = ceil($c1Value * 100) / 100;

        // C2 = (0.11 + 0.09 × r + 0.945 × Co × R) × Ftop
        $c2Value = $baseValue * $fValues['Ftop'];
        $fValues['C2'] = ceil($c2Value * 100) / 100;

        // 計算に使用したR値も保存
        $fValues['Rg'] = $param->Lg && $param->Bg ? ceil($rGround * 100) / 100 : null;
        $fValues['Ra'] = $param->Ba && $param->Ha ? ceil($rAerial * 100) / 100 : null;
    }

    // wall_tie_stress2の計算（wall_tie_stress2 = wall_tie_stress * War）
    $wallTieStress2Values = [];
    if ($param->wall_tie_stress && $param->War) {
        $wallTieStress2 = $param->wall_tie_stress * $param->War;
        // 小数点第3位を切り上げ（小数点第2位まで表示）
        $wallTieStress2Values['wall_tie_stress2'] = ceil($wallTieStress2 * 100) / 100;
    }

    // 計算結果をデータベースに保存
    $param->fill($vzValues);
    $param->fill($qzValues);
    $param->fill($fValues);
    $param->fill($wallTieStress2Values);
    $param->save();

    // 計算結果画面にリダイレクト
    return redirect()->route('scheck.calculation-result')->with('success', '計算が完了しました。');
})->name('scheck.calculate');

// 計算結果画面
Route::get('/scheck/calculation-result', function () {
    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;

    if (!$param) {
        return redirect()->route('scheck.environment')->with('error', 'パラメータが見つかりません。最初からやり直してください。');
    }

    return view('scheck.calculation-result', compact('param'));
})->name('scheck.calculation-result');

// 現場条件保存
Route::post('/scheck/site', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'Lg' => ['nullable', 'numeric', 'min:0', 'max:100'],
        'Bg' => ['nullable', 'numeric', 'min:0', 'max:100'],
        'Ba' => ['nullable', 'numeric', 'min:0', 'max:100'],
        'Ha' => ['nullable', 'numeric', 'min:0', 'max:100'],
    ]);

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        $param = new \App\Models\ScheckParam();
    }

    $param->fill($validated);
    $param->save();
    session(['scheck_param_id' => $param->id]);

    return redirect()->route('scheck.input-confirmation');
})->name('scheck.site.save');

Route::get('/scheck/site', function () {
    return view('scheck.site');
})->name('scheck.site');

// 最終値取得API
Route::get('/scheck/site/get-last-values', function () {
    // 現在のセッションのレコードIDを取得
    $currentId = session('scheck_param_id');

    // 現在のレコード以外で最新のレコードを取得（Lg, Bg, Ba, Haのいずれかが入力されているもの）
    $lastParam = \App\Models\ScheckParam::where(function ($query) {
        $query->whereNotNull('Lg')
            ->orWhereNotNull('Bg')
            ->orWhereNotNull('Ba')
            ->orWhereNotNull('Ha');
    })
        ->when($currentId, function ($query, $currentId) {
            return $query->where('id', '!=', $currentId);
        })
        ->orderBy('id', 'desc')
        ->first();

    if (!$lastParam) {
        return response()->json([
            'Lg' => null,
            'Bg' => null,
            'Ba' => null,
            'Ha' => null,
            'message' => '過去のデータが見つかりませんでした'
        ]);
    }

    return response()->json([
        'Lg' => $lastParam->Lg,
        'Bg' => $lastParam->Bg,
        'Ba' => $lastParam->Ba,
        'Ha' => $lastParam->Ha,
        'message' => '最終値を取得しました'
    ]);
})->name('scheck.site.get-last-values');

// 風圧力計算結果表示ページ
Route::get('/scheck/wind-pressure-result', function () {
    // セッションからパラメータIDを取得
    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;

    if (!$param) {
        return redirect()->route('scheck.environment')->with('error', 'パラメータが見つかりません。最初からやり直してください。');
    }

    return view('scheck.wind-pressure-result', compact('param'));
})->name('scheck.wind-pressure-result');

// W値保存用エンドポイント
Route::post('/scheck/wind-pressure-result/save-w-values', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'height_range' => ['required', 'string'],
        'wup_value' => ['nullable', 'numeric'],
        'wdn_value' => ['nullable', 'numeric'],
    ]);

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        return response()->json(['error' => 'パラメータが見つかりません'], 404);
    }

    $heightRange = $validated['height_range'];
    $wupValue = $validated['wup_value'];
    $wdnValue = $validated['wdn_value'];

    // WupとWdnカラムに保存
    $wupColumn = "Wup{$heightRange}";
    $wdnColumn = "Wdn{$heightRange}";

    $param->{$wupColumn} = $wupValue;
    $param->{$wdnColumn} = $wdnValue;
    $param->save();

    return response()->json([
        'success' => true,
        'wup' => $param->{$wupColumn},
        'wdn' => $param->{$wdnColumn}
    ]);
})->name('scheck.wind-pressure-result.save-w-values');

// 計算終了（負荷荷重値をPtopシリーズに保存、入力値をLtop、Htopup、Htopdn系列に保存）
Route::post('/scheck/wind-pressure-result/finish-calculation', function (\Illuminate\Http\Request $request) {
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

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        return response()->json(['error' => 'パラメータが見つかりません'], 404);
    }

    $loadValues = $validated['load_values'];
    $widthValues = $validated['width_values'];
    $heightAValues = $validated['height_a_values'];
    $heightBValues = $validated['height_b_values'];
    $heightRanges = ['10', '20', '35', '40', '50', '55', '70', '100'];

    // 各高さ範囲の値を保存
    foreach ($heightRanges as $range) {
        // 負荷荷重値をPtopシリーズに保存
        $ptopColumn = "Ptop{$range}";
        $loadValue = $loadValues[$range] ?? null;
        $param->{$ptopColumn} = $loadValue;

        // 幅の値をLtopシリーズに保存
        $ltopColumn = "Ltop{$range}";
        $widthValue = $widthValues[$range] ?? null;
        $param->{$ltopColumn} = $widthValue;

        // 設定高さAの値をHtopupシリーズに保存
        $htopupColumn = "Htopup{$range}";
        $heightAValue = $heightAValues[$range] ?? null;
        $param->{$htopupColumn} = $heightAValue;

        // 設定高さBの値をHtopdnシリーズに保存
        $htopdnColumn = "Htopdn{$range}";
        $heightBValue = $heightBValues[$range] ?? null;
        $param->{$htopdnColumn} = $heightBValue;
    }

    $param->save();

    return response()->json(['success' => true, 'message' => '計算が完了しました']);
})->name('scheck.wind-pressure-result.finish-calculation');

// 計算結果一覧画面（案）
Route::get('/scheck/calculation-summary', function () {
    // セッションからパラメータIDを取得
    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;

    if (!$param) {
        return redirect()->route('scheck.environment')->with('error', 'パラメータが見つかりません。最初からやり直してください。');
    }

    return view('scheck.calculation-summary', compact('param'));
})->name('scheck.calculation-summary');

// CSV出力
Route::get('/scheck/calculation-summary/export-csv', function () {
    // セッションからパラメータIDを取得
    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;

    if (!$param) {
        return redirect()->route('scheck.environment')->with('error', 'パラメータが見つかりません。最初からやり直してください。');
    }

    // CSVデータを生成
    $csvData = [];

    // ヘッダー情報
    $csvData[] = ['計算結果一覧', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['出力日時', date('Y-m-d H:i:s'), '', '', '', '', '', '', '', ''];
    $csvData[] = ['', '', '', '', '', '', '', '', '', ''];

    // 基本パラメータ
    $csvData[] = ['基本パラメータ', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['Vo', $param->Vo ?? '-', 'Ke', $param->Ke ?? '-', 'EB', $param->EB ?? '-', 'Eg', $param->Eg ?? '-', 'Co', $param->Co ?? '-'];
    $csvData[] = ['phi', $param->phi ?? '-', '', '', '', '', '', '', '', ''];
    $csvData[] = ['', '', '', '', '', '', '', '', '', ''];

    // L、H寸法
    $csvData[] = ['L、H寸法', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['Lg（地上建物長さ）', $param->Lg ? number_format($param->Lg, 1) . 'm' : '-', 'Bg（地上建物幅）', $param->Bg ? number_format($param->Bg, 1) . 'm' : '-', '', '', '', '', '', ''];
    $csvData[] = ['Ba（空中建物幅）', $param->Ba ? number_format($param->Ba, 1) . 'm' : '-', 'Ha（空中建物高さ）', $param->Ha ? number_format($param->Ha, 1) . 'm' : '-', '', '', '', '', '', ''];
    $csvData[] = ['', '', '', '', '', '', '', '', '', ''];

    // 【一般部】足場に作用する風圧力Ｐ（kN）
    $csvData[] = ['【一般部】足場に作用する風圧力Ｐ（kN）', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['位置高さ(m)', 'S', '壁繋ぎ自担数値_幅(m)', '壁繋ぎ自担数値_高さ(m)', '限界高(m)', '負荷荷重(KN)', '壁繋ぎ許容応力(KN)', '判定', '', ''];

    $heightRanges = [
        ['0～10', '10'],
        ['10～20', '20'],
        ['20～35', '35'],
        ['35～40', '40'],
        ['40～50', '50'],
        ['50～55', '55'],
        ['55～70', '70'],
        ['70～100', '100'],
    ];

    foreach ($heightRanges as $range) {
        $heightKey = $range[1];
        $sValue = $param->{'S' . $heightKey} ?? null;
        $width = $param->{'L' . $heightKey} ?? null;
        $height = $param->{'H' . $heightKey} ?? null;
        $pbtmValue = $param->{'Pbtm' . $heightKey} ?? null;
        $wallTieStress = $param->wall_tie_stress2 ?? null;
        $qzN = $param->{'QzN' . $heightKey} ?? 0;
        $c1 = $param->C1 ?? 0;

        // 限界高の計算
        $limitHeight = null;
        if ($qzN > 0 && $c1 > 0 && $width > 0 && $wallTieStress > 0) {
            $limitHeight = $wallTieStress / ($qzN * $c1 * $width);
            $limitHeight = floor($limitHeight * 1000) / 1000;
        }

        // 判定
        $judgment = '-';
        if ($pbtmValue > 0 && $wallTieStress > 0) {
            $judgment = $pbtmValue <= $wallTieStress ? 'OK' : 'NG';
        }

        $csvData[] = [
            $range[0],
            is_numeric($sValue) ? number_format($sValue, 2) : '-',
            is_numeric($width) ? number_format($width, 1) : '-',
            is_numeric($height) ? number_format($height, 1) : '-',
            is_numeric($limitHeight) ? number_format($limitHeight, 3) : '-',
            is_numeric($pbtmValue) ? number_format($pbtmValue, 3) : '-',
            is_numeric($wallTieStress) ? number_format($wallTieStress, 2) : '-',
            $judgment,
            '',
            ''
        ];
    }

    $csvData[] = ['', '', '', '', '', '', '', '', '', ''];

    // 【突出部】足場に作用する風圧力Ｐ（kN）
    $csvData[] = ['【突出部】足場に作用する風圧力Ｐ（kN）', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['位置高さ(m)', 'S', '幅(m)', '設定高名', '設定高(m)', '限界高(m)', '負荷荷重(KN)', '壁繋ぎ許容応力(KN)', '判定', ''];

    foreach ($heightRanges as $range) {
        $heightKey = $range[1];
        $sValue = $param->{'S' . $heightKey} ?? null;
        $width = $param->{'Ltop'} ?? null;
        $heightA = $param->{'atop1'} ?? null;
        $heightB = $param->{'atop2'} ?? null;
        $ptopValue = $param->{'Ptop' . $heightKey} ?? null;
        $wallTieStress = $param->wall_tie_stress2 ?? null;
        $qzN = $param->{'QzN' . $heightKey} ?? 0;
        $c1 = $param->C1 ?? 0;

        // 限界高の計算
        $limitHeight = null;
        if ($qzN > 0 && $c1 > 0 && $width > 0 && $wallTieStress > 0) {
            $limitHeight = $wallTieStress / ($qzN * $c1 * $width);
            $limitHeight = floor($limitHeight * 1000) / 1000;
        }

        // 判定
        $judgment = '-';
        if ($ptopValue > 0 && $wallTieStress > 0) {
            $judgment = $ptopValue <= $wallTieStress ? 'OK' : 'NG';
        }

        // A行
        $csvData[] = [
            $range[0],
            is_numeric($sValue) ? number_format($sValue, 2) : '-',
            is_numeric($width) ? number_format($width, 1) : '-',
            'A',
            is_numeric($heightA) ? number_format($heightA, 1) : '-',
            is_numeric($limitHeight) ? number_format($limitHeight, 3) : '-',
            is_numeric($ptopValue) ? number_format($ptopValue, 3) : '-',
            is_numeric($wallTieStress) ? number_format($wallTieStress, 2) : '-',
            $judgment,
            ''
        ];

        // B行
        $csvData[] = [
            '',
            '',
            '',
            'B',
            is_numeric($heightB) ? number_format($heightB, 1) : '-',
            is_numeric($limitHeight) ? number_format($limitHeight, 3) : '-',
            '',
            '',
            '',
            ''
        ];
    }

    $csvData[] = ['', '', '', '', '', '', '', '', '', ''];

    // 計算係数
    $csvData[] = ['計算係数', '', '', '', '', '', '', '', '', ''];
    $csvData[] = ['C1', $param->C1 ? number_format($param->C1, 2) : '-', 'C2', $param->C2 ? number_format($param->C2, 2) : '-', '', '', '', '', '', ''];
    $csvData[] = ['r', $param->r ? number_format($param->r, 2) : '-', '壁繋ぎ許容応力', $param->wall_tie_stress2 ? number_format($param->wall_tie_stress2, 2) : '-', '', '', '', '', '', ''];

    // CSVファイルを生成
    $filename = '計算結果一覧_' . date('Y-m-d_H-i-s') . '.csv';

    $headers = [
        'Content-Type' => 'text/csv; charset=UTF-8',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    $callback = function () use ($csvData) {
        $file = fopen('php://output', 'w');

        // BOMを追加（Excelで正しく表示するため）
        fwrite($file, "\xEF\xBB\xBF");

        foreach ($csvData as $row) {
            fputcsv($file, $row);
        }

        fclose($file);
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
