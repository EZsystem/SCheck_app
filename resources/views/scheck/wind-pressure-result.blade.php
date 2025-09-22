@php
    $topRangeDefaults = isset($topRanges)
        ? collect([10, 20, 35, 40, 50, 55, 70, 100])->mapWithKeys(function ($code) use ($topRanges) {
            return [(string) $code => $topRanges->get($code)];
        })
        : collect();

    $topPrefillData = $topRangeDefaults->mapWithKeys(function ($record, $code) {
        if (!$record) {
            return [$code => null];
        }

        return [$code => [
            'Ltop' => $record->Ltop,
            'Htopup' => $record->Htopup,
            'Htopdn' => $record->Htopdn,
            'Ptop' => $record->Ptop,
            'Wup' => $record->Wup,
            'Wdn' => $record->Wdn,
        ]];
    })->toArray();
@endphp

<x-layouts.app title="足場に作用する風圧力（計算結果）">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-7xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                        onclick="window.location.href='{{ route('scheck.index') }}'">
                        🏠 トップ
                    </button>
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

            {{-- 最終値取得ボタン --}}
            <div class="mb-6">
                <button type="button"
                    class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors flex items-center space-x-2"
                    onclick="loadLastWindPressureValues()">
                    <span>📥</span>
                    <span>最終値を一括取得</span>
                </button>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                    過去に入力された幅・設定高さの値を一括で取得して入力フィールドに設定します
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
                                    class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white min-w-[100px]">
                                    W(KN)
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
                                    <td rowspan="2" class="border border-gray-300 dark:border-gray-600 px-2 py-1">
                                        <input type="number" id="width_{{ $heightKey }}" step="0.1"
                                            min="0" max="100"
                                            value="{{ optional($topRangeDefaults->get((string) $heightKey))->Ltop }}"
                                            class="w-full px-2 py-1 bg-yellow-100 border-0 text-center text-sm focus:ring-2 focus:ring-blue-500 focus:bg-yellow-50"
                                            oninput="calculateRow('{{ $heightKey }}')" />
                                    </td>

                                    {{-- 設定高名 A --}}
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        A
                                    </td>

                                    {{-- 設定高(m) A --}}
                                    <td class="border border-gray-300 dark:border-gray-600 px-2 py-1">
                                        <input type="number" id="height_a_{{ $heightKey }}" step="0.1"
                                            min="0" max="100"
                                            value="{{ optional($topRangeDefaults->get((string) $heightKey))->Htopup }}"
                                            class="w-full px-2 py-1 bg-yellow-100 border-0 text-center text-sm focus:ring-2 focus:ring-blue-500 focus:bg-yellow-50"
                                            oninput="calculateRow('{{ $heightKey }}')" />
                                    </td>

                                    {{-- 限界高 A（上半分：斜線、下半分：計算結果） --}}
                                    <td class="border border-gray-300 dark:border-gray-600 px-0 py-0 relative">
                                        <div class="h-full flex flex-col">
                                            {{-- 上半分：斜線 --}}
                                            <div class="flex-1 relative bg-gray-100 dark:bg-gray-700 diagonal-line">
                                            </div>
                                            {{-- 下半分：計算結果 --}}
                                            <div id="limit_height_a_{{ $heightKey }}"
                                                class="flex-1 flex items-center justify-center text-center text-gray-900 dark:text-white text-sm">
                                                -
                                            </div>
                                        </div>
                                    </td>

                                    {{-- W(KN) A --}}
                                    <td id="w_a_{{ $heightKey }}"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ optional($topRangeDefaults->get((string) $heightKey))->Wup !== null
                                            ? number_format($topRangeDefaults->get((string) $heightKey)->Wup, 3)
                                            : '-' }}
                                    </td>

                                    {{-- 負荷荷重（2行分のrowspan） --}}
                                    <td rowspan="2" id="load_{{ $heightKey }}"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ optional($topRangeDefaults->get((string) $heightKey))->Ptop !== null
                                            ? number_format($topRangeDefaults->get((string) $heightKey)->Ptop, 3)
                                            : '-' }}
                                    </td>

                                    {{-- 壁繋ぎ許容応力（2行分のrowspan） --}}
                                    <td rowspan="2" id="allowable_stress_{{ $heightKey }}"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        -
                                    </td>

                                    {{-- 判定（2行分のrowspan） --}}
                                    <td rowspan="2" id="judgment_{{ $heightKey }}"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-gray-600">
                                        -
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
                                    <td class="border border-gray-300 dark:border-gray-600 px-2 py-1">
                                        <input type="number" id="height_b_{{ $heightKey }}" step="0.1"
                                            min="0" max="100"
                                            value="{{ optional($topRangeDefaults->get((string) $heightKey))->Htopdn }}"
                                            class="w-full px-2 py-1 bg-yellow-100 border-0 text-center text-sm focus:ring-2 focus:ring-blue-500 focus:bg-yellow-50"
                                            oninput="calculateRow('{{ $heightKey }}')" />
                                    </td>

                                    {{-- 限界高 B（上半分：斜線、下半分：計算結果） --}}
                                    <td class="border border-gray-300 dark:border-gray-600 px-0 py-0 relative">
                                        <div class="h-full flex flex-col">
                                            {{-- 上半分：斜線 --}}
                                            <div class="flex-1 relative bg-gray-100 dark:bg-gray-700 diagonal-line">
                                            </div>
                                            {{-- 下半分：計算結果 --}}
                                            <div id="limit_height_b_{{ $heightKey }}"
                                                class="flex-1 flex items-center justify-center text-center text-gray-900 dark:text-white text-sm">
                                                -
                                            </div>
                                        </div>
                                    </td>

                                    {{-- W(KN) B --}}
                                    <td id="w_b_{{ $heightKey }}"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        {{ optional($topRangeDefaults->get((string) $heightKey))->Wdn !== null
                                            ? number_format($topRangeDefaults->get((string) $heightKey)->Wdn, 3)
                                            : '-' }}
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
                    <button id="finishCalculationBtn"
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors"
                        onclick="finishCalculation()">
                        計算終了
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

        /* 斜線のスタイル */
        .diagonal-line {
            position: relative;
            overflow: hidden;
        }

        .diagonal-line::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 48%, #9ca3af 48%, #9ca3af 52%, transparent 52%);
        }
    </style>

    <script>
        // パラメータをJavaScriptで利用可能にする
        const wallTieStress2 = {{ $param->wall_tie_stress2 ?? 0 }};
        const qzNValues = {
            '10': {{ $param->QzN10 ?? 0 }},
            '20': {{ $param->QzN20 ?? 0 }},
            '35': {{ $param->QzN35 ?? 0 }},
            '40': {{ $param->QzN40 ?? 0 }},
            '50': {{ $param->QzN50 ?? 0 }},
            '55': {{ $param->QzN55 ?? 0 }},
            '70': {{ $param->QzN70 ?? 0 }},
            '100': {{ $param->QzN100 ?? 0 }}
        };
        const c1Value = {{ $param->C1 ?? 0 }};
        const c2Value = {{ $param->C2 ?? 0 }};

        const heightRangeCodes = ['10', '20', '35', '40', '50', '55', '70', '100'];
        const topPrefilledData = Object.assign({}, @json($topPrefillData));
        let suppressAutoSave = false;

        // W上の値（データベースから取得）
        const wUpValues = {
            '10': {{ $param->Wup10 ?? 0 }},
            '20': {{ $param->Wup20 ?? 0 }},
            '35': {{ $param->Wup35 ?? 0 }},
            '40': {{ $param->Wup40 ?? 0 }},
            '50': {{ $param->Wup50 ?? 0 }},
            '55': {{ $param->Wup55 ?? 0 }},
            '70': {{ $param->Wup70 ?? 0 }},
            '100': {{ $param->Wup100 ?? 0 }}
        };

        // W下の値（データベースから取得）
        const wDnValues = {
            '10': {{ $param->Wdn10 ?? 0 }},
            '20': {{ $param->Wdn20 ?? 0 }},
            '35': {{ $param->Wdn35 ?? 0 }},
            '40': {{ $param->Wdn40 ?? 0 }},
            '50': {{ $param->Wdn50 ?? 0 }},
            '55': {{ $param->Wdn55 ?? 0 }},
            '70': {{ $param->Wdn70 ?? 0 }},
            '100': {{ $param->Wdn100 ?? 0 }}
        };

        // ページ読み込み時に初期計算を実行
        window.addEventListener('DOMContentLoaded', function() {
            suppressAutoSave = true;
            heightRangeCodes.forEach(range => {
                calculateRow(range);
            });
            suppressAutoSave = false;

            heightRangeCodes.forEach(range => {
                const record = topPrefilledData[range];
                if (!record) {
                    return;
                }

                const wUpCell = document.getElementById(`w_a_${range}`);
                const wDnCell = document.getElementById(`w_b_${range}`);
                const loadCell = document.getElementById(`load_${range}`);

                if (wUpCell) {
                    const wUpNum = Number(record.Wup);
                    wUpCell.textContent = Number.isFinite(wUpNum)
                        ? wUpNum.toFixed(3)
                        : '-';
                }

                if (wDnCell) {
                    const wDnNum = Number(record.Wdn);
                    wDnCell.textContent = Number.isFinite(wDnNum)
                        ? wDnNum.toFixed(3)
                        : '-';
                }

                if (loadCell) {
                    const loadNum = Number(record.Ptop);
                    if (Number.isFinite(loadNum)) {
                        loadCell.textContent = loadNum.toFixed(3);
                        updateJudgment(range, loadNum);
                    } else {
                        loadCell.textContent = '-';
                        updateJudgment(range, null);
                    }
                }
            });
        });

        function calculateRow(heightRange) {
            const widthInput = document.getElementById(`width_${heightRange}`);
            const heightAInput = document.getElementById(`height_a_${heightRange}`);
            const heightBInput = document.getElementById(`height_b_${heightRange}`);

            const widthRaw = widthInput ? widthInput.value.trim() : '';
            const heightARaw = heightAInput ? heightAInput.value.trim() : '';
            const heightBRaw = heightBInput ? heightBInput.value.trim() : '';

            const widthValue = widthRaw === '' ? null : Number.parseFloat(widthRaw);
            const heightAValue = heightARaw === '' ? null : Number.parseFloat(heightARaw);
            const heightBValue = heightBRaw === '' ? null : Number.parseFloat(heightBRaw);

            const width = Number.isFinite(widthValue) ? widthValue : 0;
            const heightA = Number.isFinite(heightAValue) ? heightAValue : 0;
            const heightB = Number.isFinite(heightBValue) ? heightBValue : 0;

            const qzN = qzNValues[heightRange] || 0;
            const c1 = c1Value || 0;
            const c2 = c2Value || 0;
            const wallTieStress = wallTieStress2 || 0;


            // 幅と設定高さA,Bとも値が0もしくは0.0以外のときに表示
            const shouldDisplay = width > 0 && heightA > 0 && heightB > 0;

            if (shouldDisplay) {
                // 限界高の計算: 限界高さ = 壁繋ぎ許容応力 / (QzN × C1 × 幅)
                let limitHeightA = '-';
                let limitHeightB = '-';
                if (qzN > 0 && c1 > 0 && width > 0 && wallTieStress > 0) {
                    const limitHeightValue = wallTieStress / (qzN * c1 * width);
                    // 小数点第3位で切り下げ
                    const limitHeightFormatted = Math.floor(limitHeightValue * 1000) / 1000;
                    const limitHeightText = limitHeightFormatted.toFixed(3);

                    // A行とB行で同じ値を表示
                    limitHeightA = limitHeightText;
                    limitHeightB = limitHeightText;
                }

                // W(KN)の計算
                // W上 = QzN × C2 × 幅 × 設定高さA
                // W下 = QzN × C2 × 幅 × 設定高さB
                let wA = '-';
                let wB = '-';

                if (qzN > 0 && c2 > 0 && width > 0 && heightA > 0) {
                    const wUpValue = qzN * c2 * width * heightA;
                    // 小数点第3位で切り上げ
                    wA = (Math.ceil(wUpValue * 1000) / 1000).toFixed(3);
                }

                if (qzN > 0 && c2 > 0 && width > 0 && heightB > 0) {
                    const wDnValue = qzN * c2 * width * heightB;
                    // 小数点第3位で切り上げ
                    wB = (Math.ceil(wDnValue * 1000) / 1000).toFixed(3);
                }

                // 負荷荷重の計算（修正版）
                // ROUNDUP((Wup*(設定高さA/2+設定高さB)+(Wdn*(設定高さB/2)))/設定高さB, 3)
                let load = '-';
                if (wA !== '-' && wB !== '-' && heightA > 0 && heightB > 0) {
                    const wUpValue = parseFloat(wA);
                    const wDnValue = parseFloat(wB);

                    // Wup*(設定高さA/2+設定高さB) = Wup * (heightA/2 + heightB)
                    const upperPart = wUpValue * (heightA / 2 + heightB);
                    // Wdn*(設定高さB/2) = Wdn * (heightB/2)
                    const lowerPart = wDnValue * (heightB / 2);

                    // (上部分 + 下部分) / 設定高さB
                    const loadValue = (upperPart + lowerPart) / heightB;
                    // 小数点第3位で切り上げ
                    load = Math.ceil(loadValue * 1000) / 1000;
                    load = load.toFixed(3);
                }

                // 壁繋ぎ許容応力
                const allowableStress = wallTieStress > 0 ? wallTieStress.toFixed(2) : '-';

                // 判定
                let judgment = '-';
                let judgmentClass =
                    'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-gray-600';
                if (load !== '-' && allowableStress !== '-') {
                    const loadNum = parseFloat(load);
                    const allowableNum = parseFloat(allowableStress);
                    if (loadNum <= allowableNum) {
                        judgment = 'OK';
                        judgmentClass =
                            'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-green-600';
                    } else {
                        judgment = 'NG';
                        judgmentClass =
                            'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-red-600';
                    }
                }

                // 結果を表示
                document.getElementById(`limit_height_a_${heightRange}`).textContent = limitHeightA;
                document.getElementById(`limit_height_b_${heightRange}`).textContent = limitHeightB;
                document.getElementById(`w_a_${heightRange}`).textContent = wA;
                document.getElementById(`w_b_${heightRange}`).textContent = wB;
                document.getElementById(`load_${heightRange}`).textContent = load;
                document.getElementById(`allowable_stress_${heightRange}`).textContent = allowableStress;

                const judgmentElement = document.getElementById(`judgment_${heightRange}`);
                judgmentElement.textContent = judgment;
                judgmentElement.className = judgmentClass;

                // W値をデータベースに保存
                if (!suppressAutoSave) {
                    saveWValues(heightRange, wA !== '-' ? parseFloat(wA) : null, wB !== '-' ? parseFloat(wB) : null);
                }
            } else {
                // 条件を満たさない場合は全て「-」を表示
                document.getElementById(`limit_height_a_${heightRange}`).textContent = '-';
                document.getElementById(`limit_height_b_${heightRange}`).textContent = '-';
                document.getElementById(`w_a_${heightRange}`).textContent = '-';
                document.getElementById(`w_b_${heightRange}`).textContent = '-';
                document.getElementById(`load_${heightRange}`).textContent = '-';
                document.getElementById(`allowable_stress_${heightRange}`).textContent = '-';

                const judgmentElement = document.getElementById(`judgment_${heightRange}`);
                judgmentElement.textContent = '-';
                judgmentElement.className =
                    'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-gray-600';

                // W値をnullで保存（値がクリアされた場合）
                if (!suppressAutoSave) {
                    saveWValues(heightRange, null, null);
                }
            }
        }

        // W値をデータベースに保存する関数
        function saveWValues(heightRange, wupValue, wdnValue) {
            if (suppressAutoSave) {
                return;
            }

            // CSRFトークンを取得
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            fetch('/scheck/wind-pressure-result/save-w-values', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        height_range: heightRange,
                        wup_value: wupValue,
                        wdn_value: wdnValue
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(`W値保存完了 - 高さ範囲: ${heightRange}, Wup: ${data.wup}, Wdn: ${data.wdn}`);
                    } else {
                        console.error('W値保存エラー:', data.error);
                    }
                })
                .catch(error => {
                    console.error('W値保存通信エラー:', error);
                });
        }

        // 計算終了ボタンの処理
        function finishCalculation() {
            // 全ての負荷荷重値と入力値を収集
            const loadValues = {};
            const widthValues = {};
            const heightAValues = {};
            const heightBValues = {};

            heightRangeCodes.forEach(range => {
                // 負荷荷重値を収集
                const loadElement = document.getElementById(`load_${range}`);
                const loadText = loadElement.textContent.trim();
                loadValues[range] = loadText !== '-' ? parseFloat(loadText) : null;

                // 幅の値を収集（Ltop系列用）
                const widthElement = document.getElementById(`width_${range}`);
                const widthValue = parseFloat(widthElement.value) || null;
                widthValues[range] = widthValue > 0 ? widthValue : null;

                // 設定高さAの値を収集（Htopup系列用）
                const heightAElement = document.getElementById(`height_a_${range}`);
                const heightAValue = parseFloat(heightAElement.value) || null;
                heightAValues[range] = heightAValue > 0 ? heightAValue : null;

                // 設定高さBの値を収集（Htopdn系列用）
                const heightBElement = document.getElementById(`height_b_${range}`);
                const heightBValue = parseFloat(heightBElement.value) || null;
                heightBValues[range] = heightBValue > 0 ? heightBValue : null;
            });

            // CSRFトークンを取得
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // ボタンを無効化
            const btn = document.getElementById('finishCalculationBtn');
            btn.disabled = true;
            btn.textContent = '計算結果';

            fetch('/scheck/wind-pressure-result/finish-calculation', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        load_values: loadValues,
                        width_values: widthValues,
                        height_a_values: heightAValues,
                        height_b_values: heightBValues
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('計算が完了しました。');
                        // 計算結果一覧画面へリダイレクト
                        window.location.href = '{{ route('scheck.calculation-summary') }}';
                    } else {
                        alert('エラーが発生しました: ' + data.error);
                        // ボタンを元に戻す
                        btn.disabled = false;
                        btn.textContent = '計算終了';
                    }
                })
                .catch(error => {
                    console.error('計算終了通信エラー:', error);
                    alert('通信エラーが発生しました。');
                    // ボタンを元に戻す
                    btn.disabled = false;
                    btn.textContent = '計算終了';
                });
        }

        // 最終値を取得する関数
        async function loadLastWindPressureValues() {
            try {
                const response = await fetch('/scheck/wind-pressure-result/get-last-values', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content')
                    }
                });

                if (!response.ok) {
                    throw new Error('データの取得に失敗しました');
                }

                const data = await response.json();
                let updatedCount = 0;
                suppressAutoSave = true;

                // 幅の値を設定（Ltop系列）
                heightRangeCodes.forEach(range => {
                    const widthInput = document.getElementById(`width_${range}`);
                    if (widthInput) {
                        const widthValue = data.widths[range];
                        if (widthValue !== null && widthValue !== undefined) {
                            widthInput.value = widthValue;
                            updatedCount++;
                        } else {
                            widthInput.value = '';
                        }
                    }
                });

                // 設定高さAの値を設定（Htopup系列）
                heightRangeCodes.forEach(range => {
                    const heightAInput = document.getElementById(`height_a_${range}`);
                    if (heightAInput) {
                        const heightAValue = data.heights_a[range];
                        if (heightAValue !== null && heightAValue !== undefined) {
                            heightAInput.value = heightAValue;
                            updatedCount++;
                        } else {
                            heightAInput.value = '';
                        }
                    }
                });

                // 設定高さBの値を設定（Htopdn系列）
                heightRangeCodes.forEach(range => {
                    const heightBInput = document.getElementById(`height_b_${range}`);
                    if (heightBInput) {
                        const heightBValue = data.heights_b[range];
                        if (heightBValue !== null && heightBValue !== undefined) {
                            heightBInput.value = heightBValue;
                            updatedCount++;
                        } else {
                            heightBInput.value = '';
                        }
                    }
                });

                // 値を設定後に各行の計算を実行
                heightRangeCodes.forEach(range => {
                    calculateRow(range);
                });

                // 取得したW値・負荷荷重値を反映
                heightRangeCodes.forEach(range => {
                    const wUpCell = document.getElementById(`w_a_${range}`);
                    const wDnCell = document.getElementById(`w_b_${range}`);
                    const loadCell = document.getElementById(`load_${range}`);

                    if (wUpCell) {
                        const value = data.wup?.[range];
                        const numeric = Number(value);
                        wUpCell.textContent = Number.isFinite(numeric) ? numeric.toFixed(3) : '-';
                    }

                    if (wDnCell) {
                        const value = data.wdn?.[range];
                        const numeric = Number(value);
                        wDnCell.textContent = Number.isFinite(numeric) ? numeric.toFixed(3) : '-';
                    }

                    if (loadCell) {
                        const value = data.loads?.[range];
                        const numeric = Number(value);
                        if (Number.isFinite(numeric)) {
                            loadCell.textContent = numeric.toFixed(3);
                            updateJudgment(range, numeric);
                        } else {
                            loadCell.textContent = '-';
                            updateJudgment(range, null);
                        }
                    }
                });

                suppressAutoSave = false;

                // 成功メッセージを表示
                showWindPressureMessage(`最終値を取得しました（${updatedCount}個のフィールドを更新）`, 'success');

            } catch (error) {
                console.error('Error:', error);
                showWindPressureMessage('最終値の取得に失敗しました: ' + error.message, 'error');
            } finally {
                suppressAutoSave = false;
            }
        }

        function updateJudgment(range, loadValue) {
            const judgmentElement = document.getElementById(`judgment_${range}`);
            if (!judgmentElement) {
                return;
            }

            const allowableCell = document.getElementById(`allowable_stress_${range}`);
            const allowableText = wallTieStress2 > 0 ? wallTieStress2.toFixed(2) : '-';
            if (allowableCell) {
                allowableCell.textContent = allowableText;
            }

            if (loadValue === null || loadValue === undefined || wallTieStress2 <= 0) {
                judgmentElement.textContent = '-';
                judgmentElement.className =
                    'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-gray-600';
                return;
            }

            const loadNum = Number(loadValue);
            if (Number.isNaN(loadNum)) {
                judgmentElement.textContent = '-';
                judgmentElement.className =
                    'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-gray-600';
                return;
            }

            if (loadNum <= wallTieStress2) {
                judgmentElement.textContent = 'OK';
                judgmentElement.className =
                    'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-green-600';
            } else {
                judgmentElement.textContent = 'NG';
                judgmentElement.className =
                    'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-red-600';
            }
        }

        // メッセージ表示関数
        function showWindPressureMessage(message, type) {
            // 既存のメッセージがあれば削除
            const existingMessage = document.querySelector('.wind-pressure-message-toast');
            if (existingMessage) {
                existingMessage.remove();
            }

            // メッセージ要素を作成
            const messageDiv = document.createElement('div');
            messageDiv.className = `wind-pressure-message-toast fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
                type === 'success' 
                    ? 'bg-green-600 text-white' 
                    : 'bg-red-600 text-white'
            }`;
            messageDiv.textContent = message;

            // ページに追加
            document.body.appendChild(messageDiv);

            // 4秒後に自動削除
            setTimeout(() => {
                if (messageDiv.parentNode) {
                    messageDiv.remove();
                }
            }, 4000);
        }
    </script>
</x-layouts.app>
