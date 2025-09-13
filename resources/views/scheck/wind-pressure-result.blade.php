<x-layouts.app title="足場に作用する風圧力（計算結果）">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-7xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.input-parameters') }}'">
                        ← 前に戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        【突出部】足場に作用する風圧力Ｐ（kN）
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    風圧力計算の結果を表示しています。
                </p>
            </div>

            {{-- 風圧力計算結果テーブル --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
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
                                    $sValue = $param->{'S' . $heightKey} ?? '-';
                                    $width = $param->{'L' . $heightKey} ?? null;
                                    $height = $param->{'H' . $heightKey} ?? null;
                                    $area = $param->{'A' . $heightKey} ?? null;
                                    $load = $param->{'Pbtm' . $heightKey} ?? null;
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
                                    if ($load > 0 && $wallTieStress > 0) {
                                        $judgment = $load <= $wallTieStress ? 'OK' : 'NG';
                                        $judgmentClass = $judgment === 'OK' ? 'text-green-600' : 'text-red-600';
                                    }
                                @endphp

                                {{-- A行 --}}
                                <tr>
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
                                        {{ $width ? number_format($width, 1) : '-' }}
                                    </td>

                                    {{-- 設定高名 A --}}
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        A
                                    </td>

                                    {{-- 設定高(m) A --}}
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ $height ? number_format($height, 1) : '-' }}
                                    </td>

                                    {{-- 限界高（2行分のrowspan） --}}
                                    <td rowspan="2"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ $limitHeight ? number_format($limitHeight, 3) : '-' }}
                                    </td>

                                    {{-- 負荷荷重（2行分のrowspan） --}}
                                    <td rowspan="2"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ $load ? number_format($load, 2) : '-' }}
                                    </td>

                                    {{-- 壁繋ぎ許容応力（2行分のrowspan） --}}
                                    <td rowspan="2"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ $wallTieStress ? number_format($wallTieStress, 2) : '-' }}
                                    </td>

                                    {{-- 判定（2行分のrowspan） --}}
                                    <td rowspan="2"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold {{ $judgmentClass }}">
                                        {{ $judgment }}
                                    </td>
                                </tr>

                                {{-- B行 --}}
                                <tr>
                                    {{-- 設定高名 B --}}
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        B
                                    </td>

                                    {{-- 設定高(m) B --}}
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ $height ? number_format($height, 1) : '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8 mb-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.input-parameters') }}'">
                    戻る
                </button>

                <div class="space-x-4">
                    <button class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors"
                        onclick="window.location.href='{{ route('scheck.input-confirmation') }}'">
                        確認画面へ
                    </button>

                    <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                        onclick="window.print()">
                        印刷
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
            .bg-gray-800 {
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

            .bg-gray-100,
            .bg-gray-700 {
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
