<?php

use Illuminate\Support\Facades\Route;
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
    $heightRanges = ['010', '1020', '2035', '3540', '4050', '5055', '5570', '70100'];

    foreach ($heightRanges as $range) {
        $rules["L{$range}"] = ['nullable', 'numeric', 'min:0', 'max:100'];
        $rules["H{$range}"] = ['nullable', 'numeric', 'min:0', 'max:100'];
        $rules["A{$range}"] = ['nullable', 'numeric', 'min:0', 'max:10000'];
    }

    $validated = $request->validate($rules);

    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;
    if (!$param) {
        $param = new \App\Models\ScheckParam();
    }

    $param->fill($validated);
    $param->save();
    session(['scheck_param_id' => $param->id]);

    return redirect()->route('scheck.input-confirmation');
})->name('scheck.input-parameters.save');

Route::get('/scheck/input-parameters', function () {
    return view('scheck.input-parameters');
})->name('scheck.input-parameters');

Route::get('/scheck/input-confirmation', function () {
    // セッションからパラメータIDを取得
    $id = session('scheck_param_id');
    $param = $id ? \App\Models\ScheckParam::find($id) : null;

    return view('scheck.input-confirmation', compact('param'));
})->name('scheck.input-confirmation');

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

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
