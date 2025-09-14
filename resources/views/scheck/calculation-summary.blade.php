<x-layouts.app title="計算結果一覧（案）">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-7xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.wind-pressure-result') }}'">
                        ← 前に戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        計算結果一覧
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    入力値と計算結果を一覧で表示しています。
                </p>
            </div>

            {{-- 基本パラメータ表示 --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">基本パラメータ</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Vo</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $param->Vo ?? '-' }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Ke</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $param->Ke ?? '-' }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">EB</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $param->EB ?? '-' }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Eg</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $param->Eg ?? '-' }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Co</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $param->Co ?? '-' }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">phi</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $param->phi ?? '-' }}</div>
                    </div>
                </div>
            </div>

            {{-- L、H寸法表示 --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">L、H寸法</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Lg（地上建物長さ）</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $param->Lg ? number_format($param->Lg, 1) : '-' }} m</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Bg（地上建物幅）</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $param->Bg ? number_format($param->Bg, 1) : '-' }} m</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Ba（空中建物幅）</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $param->Ba ? number_format($param->Ba, 1) : '-' }} m</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">Ha（空中建物高さ）</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $param->Ha ? number_format($param->Ha, 1) : '-' }} m</div>
                    </div>
                </div>
            </div>

            {{-- 【一般部】足場に作用する風圧力Ｐ（kN） --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="p-6 pb-0">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">【一般部】足場に作用する風圧力Ｐ（kN）</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th rowspan="2"
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[120px]">
                                    位置高さ(m)
                                </th>
                                <th rowspan="2"
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[80px]">
                                    S
                                </th>
                                <th colspan="2"
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                    壁繋ぎ 自担数値
                                </th>
                                <th rowspan="2"
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[100px]">
                                    限界高(m)
                                </th>
                                <th rowspan="2"
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[120px]">
                                    負荷荷重(KN)
                                </th>
                                <th rowspan="2"
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[140px]">
                                    壁繋ぎ許容応力(KN)
                                </th>
                                <th rowspan="2"
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[80px]">
                                    判定
                                </th>
                            </tr>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[100px]">
                                    幅(m)
                                </th>
                                <th
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[100px]">
                                    高さ(m)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
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
                            @endphp
                            @foreach ($heightRanges as $range)
                                @php
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
                                        $limitHeight = floor($limitHeight * 1000) / 1000; // 小数点第3位で切り下げ
                                    }

                                    // 判定
                                    $judgment = '-';
                                    $judgmentClass = 'text-gray-600';
                                    if ($pbtmValue > 0 && $wallTieStress > 0) {
                                        $judgment = $pbtmValue <= $wallTieStress ? 'OK' : 'NG';
                                        $judgmentClass =
                                            $judgment === 'OK' ? 'text-green-600 font-bold' : 'text-red-600 font-bold';
                                    }
                                @endphp
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white font-medium">
                                        {{ $range[0] }}
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($sValue) ? number_format($sValue, 2) : '-' }}
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($width) ? number_format($width, 1) : '-' }}
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($height) ? number_format($height, 1) : '-' }}
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($limitHeight) ? number_format($limitHeight, 3) : '-' }}
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($pbtmValue) ? number_format($pbtmValue, 3) : '-' }}
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($wallTieStress) ? number_format($wallTieStress, 2) : '-' }}
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center {{ $judgmentClass }}">
                                        {{ $judgment }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- 【突出部】足場に作用する風圧力Ｐ（kN） --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-6">
                <div class="p-6 pb-0">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">【突出部】足場に作用する風圧力Ｐ（kN）</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-sm">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[120px]">
                                    位置高さ(m)
                                </th>
                                <th
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[80px]">
                                    S
                                </th>
                                <th
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[100px]">
                                    幅(m)
                                </th>
                                <th
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[80px]">
                                    設定高名
                                </th>
                                <th
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[100px]">
                                    設定高(m)
                                </th>
                                <th
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[100px]">
                                    限界高(m)
                                </th>
                                <th
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[120px]">
                                    負荷荷重(KN)
                                </th>
                                <th
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[140px]">
                                    壁繋ぎ許容応力(KN)
                                </th>
                                <th
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[80px]">
                                    判定
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($heightRanges as $range)
                                @php
                                    $heightKey = $range[1];
                                    $sValue = $param->{'S' . $heightKey} ?? null;
                                    $width = $param->{'Ltop' . $heightKey} ?? null;
                                    $heightA = $param->{'Htopup' . $heightKey} ?? null;
                                    $heightB = $param->{'Htopdn' . $heightKey} ?? null;
                                    $ptopValue = $param->{'Ptop' . $heightKey} ?? null;
                                    $wallTieStress = $param->wall_tie_stress2 ?? null;
                                    $qzN = $param->{'QzN' . $heightKey} ?? 0;
                                    $c1 = $param->C1 ?? 0;

                                    // 限界高の計算
                                    $limitHeight = null;
                                    if ($qzN > 0 && $c1 > 0 && $width > 0 && $wallTieStress > 0) {
                                        $limitHeight = $wallTieStress / ($qzN * $c1 * $width);
                                        $limitHeight = floor($limitHeight * 1000) / 1000; // 小数点第3位で切り下げ
                                    }

                                    // 判定
                                    $judgment = '-';
                                    $judgmentClass = 'text-gray-600';
                                    if ($ptopValue > 0 && $wallTieStress > 0) {
                                        $judgment = $ptopValue <= $wallTieStress ? 'OK' : 'NG';
                                        $judgmentClass =
                                            $judgment === 'OK' ? 'text-green-600 font-bold' : 'text-red-600 font-bold';
                                    }
                                @endphp

                                {{-- A行 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    {{-- 位置高さ（2行分のrowspan） --}}
                                    <td rowspan="2"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white font-medium">
                                        {{ $range[0] }}
                                    </td>

                                    {{-- S係数（2行分のrowspan） --}}
                                    <td rowspan="2"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($sValue) ? number_format($sValue, 2) : '-' }}
                                    </td>

                                    {{-- 幅（2行分のrowspan） --}}
                                    <td rowspan="2"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($width) ? number_format($width, 1) : '-' }}
                                    </td>

                                    {{-- 設定高名 A --}}
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        A
                                    </td>

                                    {{-- 設定高(m) A --}}
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($heightA) ? number_format($heightA, 1) : '-' }}
                                    </td>

                                    {{-- 限界高 A --}}
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($limitHeight) ? number_format($limitHeight, 3) : '-' }}
                                    </td>


                                    {{-- 負荷荷重（2行分のrowspan） --}}
                                    <td rowspan="2"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($ptopValue) ? number_format($ptopValue, 3) : '-' }}
                                    </td>

                                    {{-- 壁繋ぎ許容応力（2行分のrowspan） --}}
                                    <td rowspan="2"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($wallTieStress) ? number_format($wallTieStress, 2) : '-' }}
                                    </td>

                                    {{-- 判定（2行分のrowspan） --}}
                                    <td rowspan="2"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center {{ $judgmentClass }}">
                                        {{ $judgment }}
                                    </td>
                                </tr>

                                {{-- B行 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    {{-- 設定高名 B --}}
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        B
                                    </td>

                                    {{-- 設定高(m) B --}}
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($heightB) ? number_format($heightB, 1) : '-' }}
                                    </td>

                                    {{-- 限界高 B --}}
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ is_numeric($limitHeight) ? number_format($limitHeight, 3) : '-' }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- 計算に使用した係数表示 --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mt-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">計算係数</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">C1</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $param->C1 ? number_format($param->C1, 2) : '-' }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">C2</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $param->C2 ? number_format($param->C2, 2) : '-' }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">r</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $param->r ? number_format($param->r, 2) : '-' }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                        <div class="text-sm text-gray-600 dark:text-gray-400">壁繋ぎ許容応力</div>
                        <div class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $param->wall_tie_stress2 ? number_format($param->wall_tie_stress2, 2) : '-' }}</div>
                    </div>
                </div>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.wind-pressure-result') }}'">
                    戻る
                </button>

                <div class="space-x-4">
                    <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                        onclick="window.print()">
                        印刷
                    </button>
                    <button class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors"
                        onclick="window.location.href='{{ route('scheck.input-confirmation') }}'">
                        確認画面へ
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- 印刷用スタイル --}}
    <style>
        @media print {
            body {
                background: white !important;
            }

            .bg-gray-50,
            .bg-gray-900,
            .bg-white,
            .bg-gray-800,
            .bg-gray-700 {
                background: white !important;
            }

            .text-gray-900,
            .text-white,
            .text-gray-600,
            .text-gray-400 {
                color: black !important;
            }

            .text-green-600 {
                color: green !important;
            }

            .text-red-600 {
                color: red !important;
            }

            .border-gray-300,
            .border-gray-600 {
                border-color: black !important;
            }

            .bg-gray-100 {
                background: #f5f5f5 !important;
            }

            button {
                display: none !important;
            }

            .shadow-lg {
                box-shadow: none !important;
            }
        }
    </style>
</x-layouts.app>
