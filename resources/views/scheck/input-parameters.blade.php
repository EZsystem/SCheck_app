@php
    $rangeDefaults = isset($ranges)
        ? collect([10, 20, 35, 40, 50, 55, 70, 100])->mapWithKeys(function ($code) use ($ranges) {
            return [(string) $code => $ranges->get($code)];
        })
        : collect();

    $prefilledRangeData = $rangeDefaults->mapWithKeys(function ($record, $code) {
        if (!$record) {
            return [$code => null];
        }

        return [$code => [
            'L' => $record->L,
            'H' => $record->H,
            'A' => $record->A,
            'Pbtm' => $record->Pbtm,
        ]];
    })->toArray();

    $rangeMap = [
        '0_10' => 10,
        '10_20' => 20,
        '20_35' => 35,
        '35_40' => 40,
        '40_50' => 50,
        '50_55' => 55,
        '55_70' => 70,
        '70_100' => 100,
    ];
@endphp

<x-layouts.app title="足場に作用する風圧力">
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
                        onclick="window.location.href='{{ route('scheck.site') }}'">
                        ← 前に戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        【一般部】足場に作用する風圧力（kN）
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    黄色のセルに値を入力してください。
                </p>
            </div>

            {{-- 最終値取得ボタン --}}
            <div class="mb-6">
                <button type="button"
                    class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors flex items-center space-x-2"
                    onclick="loadLastInputValues()">
                    <span>📥</span>
                    <span>最終値を一括取得</span>
                </button>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                    過去に入力された幅・高さの値を一括で取得して入力フィールドに設定します
                </p>
            </div>

            {{-- 風圧力計算テーブル --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
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
                            {{-- データ行のテンプレート --}}
                            @php
                                $heightRanges = [
                                    ['0～10', '0_10'],
                                    ['10～20', '10_20'],
                                    ['20～35', '20_35'],
                                    ['35～40', '35_40'],
                                    ['40～50', '40_50'],
                                    ['50～55', '50_55'],
                                    ['55～70', '55_70'],
                                    ['70～100', '70_100'],
                                ];
                            @endphp

                            @foreach ($heightRanges as $range)
                                <tr>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white font-medium">
                                        {{ $range[0] }}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white"
                                        id="s_{{ $range[1] }}">
                                        -
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-2 py-1">
                                        @php $code = $rangeMap[$range[1]] ?? null; @endphp
                                        <input type="number" id="width_{{ $range[1] }}" step="0.1"
                                            min="0" max="100"
                                            class="w-full px-2 py-1 bg-yellow-100 border-0 text-center text-sm focus:ring-2 focus:ring-blue-500 focus:bg-yellow-50"
                                            placeholder="0.0" oninput="calculateRow('{{ $range[1] }}')"
                                            value="{{ optional($rangeDefaults->get((string) $code))->L }}" />
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-2 py-1">
                                        <input type="number" id="height_{{ $range[1] }}" step="0.1"
                                            min="0" max="100"
                                            class="w-full px-2 py-1 bg-yellow-100 border-0 text-center text-sm focus:ring-2 focus:ring-blue-500 focus:bg-yellow-50"
                                            placeholder="0.0" oninput="calculateRow('{{ $range[1] }}')"
                                            value="{{ optional($rangeDefaults->get((string) $code))->H }}" />
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white"
                                        id="limit_height_{{ $range[1] }}">
                                        -
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white"
                                        id="load_{{ $range[1] }}">
                                        {{ optional($rangeDefaults->get((string) $code))->Pbtm ?? '-' }}
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white"
                                        id="allowable_stress_{{ $range[1] }}">
                                        -
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold"
                                        id="judgment_{{ $range[1] }}">
                                        -
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
                    onclick="window.location.href='{{ route('scheck.site') }}'">
                    戻る
                </button>

                <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                    onclick="submitInputParameters()">
                    計算結果を表示
                </button>
            </div>
        </div>
    </div>

    <script>
        const rangeMappingDbToScreen = {
            '10': '0_10',
            '20': '10_20',
            '35': '20_35',
            '40': '35_40',
            '50': '40_50',
            '55': '50_55',
            '70': '55_70',
            '100': '70_100'
        };

        const rangeMappingScreenToDb = Object.fromEntries(
            Object.entries(rangeMappingDbToScreen).map(([db, screen]) => [screen, db])
        );

        const prefilledRanges = Object.assign({}, @json($prefilledRangeData));

        // wall_tie_stress2の値をJavaScriptで利用可能にする
        const wallTieStress2 = {{ $param->wall_tie_stress2 ?? 0 }};

        // QzN値をJavaScriptで利用可能にする
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

        // C1値をJavaScriptで利用可能にする
        const c1Value = {{ $param->C1 ?? 0 }};

        // ページ読み込み時にS係数と壁繋ぎ許容応力を表示
        let suppressAutoSave = false;

        window.addEventListener('DOMContentLoaded', function() {
            displaySCoefficients();
            initializeAllowableStress();
            applyPrefilledValues();
        });

        function displaySCoefficients() {
            // 仮のS係数値を表示（実際は保存されたデータから取得）
            const sValues = {
                '0_10': '0.85',
                '10_20': '0.90',
                '20_35': '0.95',
                '35_40': '1.00',
                '40_50': '1.05',
                '50_55': '1.10',
                '55_70': '1.15',
                '70_100': '1.20'
            };

            Object.keys(sValues).forEach(key => {
                const element = document.getElementById(`s_${key}`);
                if (element) {
                    element.textContent = sValues[key];
                }
            });
        }

        function initializeAllowableStress() {
            // 初期表示では壁繋ぎ許容応力は空にする（入力時のみ表示）
            const heightRanges = ['0_10', '10_20', '20_35', '35_40', '40_50', '50_55', '55_70', '70_100'];

            heightRanges.forEach(range => {
                const element = document.getElementById(`allowable_stress_${range}`);
                if (element) {
                    element.textContent = '-';
                }
            });
        }

        function calculateRow(heightRange) {
            const widthInput = document.getElementById(`width_${heightRange}`);
            const heightInput = document.getElementById(`height_${heightRange}`);
            const widthRaw = widthInput ? widthInput.value.trim() : '';
            const heightRaw = heightInput ? heightInput.value.trim() : '';

            const width = widthRaw === '' ? null : Number.parseFloat(widthRaw);
            const height = heightRaw === '' ? null : Number.parseFloat(heightRaw);

            const widthValue = Number.isFinite(width) ? width : 0;
            const heightValue = Number.isFinite(height) ? height : 0;
            const hasWidth = Number.isFinite(width) && width > 0;
            const hasHeight = Number.isFinite(height) && height > 0;

            if (!suppressAutoSave) {
                saveAreaToDatabase(heightRange, widthValue, heightValue);
            }

            const limitElement = document.getElementById(`limit_height_${heightRange}`);
            const loadElement = document.getElementById(`load_${heightRange}`);
            const allowableElement = document.getElementById(`allowable_stress_${heightRange}`);
            const judgmentElement = document.getElementById(`judgment_${heightRange}`);

            if (!hasWidth && !hasHeight) {
                if (limitElement) limitElement.textContent = '-';
                if (loadElement) loadElement.textContent = '-';
                if (allowableElement) allowableElement.textContent = '-';
                if (judgmentElement) {
                    judgmentElement.textContent = '-';
                    judgmentElement.className = 'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold';
                }
                return;
            }

            const dbHeightRange = rangeMappingScreenToDb[heightRange];
            const qzN = dbHeightRange ? (qzNValues[dbHeightRange] || 0) : 0;
            const c1 = c1Value || 0;
            const allowableStress = wallTieStress2 || 0;

            let computedLoad = null;

            if (hasWidth && hasHeight) {
                const area = widthValue * heightValue;

                if (qzN > 0 && c1 > 0 && widthValue > 0 && allowableStress > 0 && limitElement) {
                    const limitHeight = allowableStress / (qzN * c1 * widthValue);
                    const limitHeightRounded = Math.floor(limitHeight * 1000) / 1000;
                    limitElement.textContent = limitHeightRounded.toFixed(3);
                } else if (limitElement) {
                    limitElement.textContent = '-';
                }

                if (qzN > 0 && c1 > 0 && area > 0) {
                    computedLoad = qzN * c1 * area;
                    if (loadElement) {
                        loadElement.textContent = computedLoad.toFixed(2);
                    }
                } else if (loadElement) {
                    loadElement.textContent = '-';
                }
            } else {
                if (hasWidth && qzN > 0 && c1 > 0 && allowableStress > 0 && limitElement) {
                    const limitHeight = allowableStress / (qzN * c1 * widthValue);
                    const limitHeightRounded = Math.floor(limitHeight * 1000) / 1000;
                    limitElement.textContent = limitHeightRounded.toFixed(3);
                } else if (limitElement) {
                    limitElement.textContent = '-';
                }

                if (loadElement) {
                    loadElement.textContent = '-';
                }
                computedLoad = null;
            }

            if (allowableElement) {
                allowableElement.textContent = wallTieStress2 > 0 ? wallTieStress2.toFixed(2) : '-';
            }

            if (judgmentElement) {
                if (computedLoad !== null && allowableStress > 0) {
                    const judgment = computedLoad <= allowableStress ? 'OK' : 'NG';
                    judgmentElement.textContent = judgment;
                    judgmentElement.className = judgment === 'OK'
                        ? 'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-green-600'
                        : 'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-red-600';
                } else {
                    judgmentElement.textContent = '-';
                    judgmentElement.className = 'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold';
                }
            }
        }

        function saveAreaToDatabase(heightRange, width, height) {
            const dbHeightRange = rangeMappingScreenToDb[heightRange];
            if (!dbHeightRange) {
                console.error('Invalid height range:', heightRange);
                return;
            }

            // AJAX でサーバーに送信
            fetch('{{ route('scheck.input-parameters.update-area') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        height_range: dbHeightRange,
                        width: width > 0 ? width : null,
                        height: height > 0 ? height : null
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(`面積が保存されました: A${dbHeightRange} = ${data.area}`);
                    } else {
                        console.error('面積の保存に失敗しました:', data.error);
                    }
                })
                .catch(error => {
                    console.error('通信エラー:', error);
                });
        }

        function submitInputParameters() {
            // 入力値を収集
            const data = {};
            const heightRanges = ['0_10', '10_20', '20_35', '35_40', '40_50', '50_55', '55_70', '70_100'];

            heightRanges.forEach(range => {
                const widthInput = document.getElementById(`width_${range}`);
                const heightInput = document.getElementById(`height_${range}`);
                const widthRaw = widthInput ? widthInput.value.trim() : '';
                const heightRaw = heightInput ? heightInput.value.trim() : '';

                const width = widthRaw === '' ? null : Number.parseFloat(widthRaw);
                const height = heightRaw === '' ? null : Number.parseFloat(heightRaw);

                const dbRange = rangeMappingScreenToDb[range];
                if (!dbRange) {
                    return;
                }

                data[`L${dbRange}`] = Number.isFinite(width) ? width : null;
                data[`H${dbRange}`] = Number.isFinite(height) ? height : null;
                data[`A${dbRange}`] = (Number.isFinite(width) && Number.isFinite(height)) ? width * height : null;

                const loadElement = document.getElementById(`load_${range}`);
                let loadValue = null;
                if (loadElement) {
                    const loadText = loadElement.textContent.trim();
                    if (loadText !== '-' && loadText !== '') {
                        const parsed = Number.parseFloat(loadText);
                        if (!Number.isNaN(parsed)) {
                            loadValue = parsed;
                        }
                    }
                }

                data[`Pbtm${dbRange}`] = loadValue;
            });

            // デバッグ用：送信データをコンソールに出力
            // フォームを作成して送信
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('scheck.input-parameters.save') }}';

            // CSRFトークンを追加
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // データを追加
            Object.keys(data).forEach(key => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = data[key] ?? '';
                form.appendChild(input);
            });

            // フォームをページに追加して送信
            document.body.appendChild(form);
            form.submit();
        }

        // 最終値を取得する関数
        async function loadLastInputValues() {
            try {
                const response = await fetch('/scheck/input-parameters/get-last-values', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                if (!response.ok) {
                    throw new Error('データの取得に失敗しました');
                }

                const data = await response.json();

                // 高さ範囲のマッピング（データベース → 画面表示）
                let updatedCount = 0;
                suppressAutoSave = true;

                // L系列（幅）の値を設定
                Object.keys(data.widths || {}).forEach(dbRange => {
                    const screenRange = rangeMappingDbToScreen[dbRange];
                    if (screenRange && data.widths[dbRange] !== null) {
                        const widthInput = document.getElementById(`width_${screenRange}`);
                        if (widthInput) {
                            widthInput.value = data.widths[dbRange];
                            updatedCount++;
                        }
                    }
                });

                // H系列（高さ）の値を設定
                Object.keys(data.heights || {}).forEach(dbRange => {
                    const screenRange = rangeMappingDbToScreen[dbRange];
                    if (screenRange && data.heights[dbRange] !== null) {
                        const heightInput = document.getElementById(`height_${screenRange}`);
                        if (heightInput) {
                            heightInput.value = data.heights[dbRange];
                            updatedCount++;
                        }
                    }
                });

                // 値を設定後に各行の計算を実行
                Object.values(rangeMappingDbToScreen).forEach(screenRange => {
                    calculateRow(screenRange);
                });

                Object.keys(data.loads || {}).forEach(dbRange => {
                    const screenRange = rangeMappingDbToScreen[dbRange];
                    if (screenRange) {
                        const loadElement = document.getElementById(`load_${screenRange}`);
                        const judgmentElement = document.getElementById(`judgment_${screenRange}`);
                        if (loadElement) {
                            const loadValue = data.loads[dbRange];
                            loadElement.textContent = loadValue;

                            if (judgmentElement && wallTieStress2 > 0) {
                                const parsedLoad = Number.parseFloat(loadValue);
                                if (!Number.isNaN(parsedLoad)) {
                                    const judgment = parsedLoad <= wallTieStress2 ? 'OK' : 'NG';
                                    judgmentElement.textContent = judgment;
                                    judgmentElement.className = judgment === 'OK'
                                        ? 'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-green-600'
                                        : 'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-red-600';
                                }
                            }
                        }
                    }
                });

                // 成功メッセージを表示
                showInputMessage(`最終値を取得しました（${updatedCount}個のフィールドを更新）`, 'success');

            } catch (error) {
                console.error('Error:', error);
                showInputMessage('最終値の取得に失敗しました: ' + error.message, 'error');
            } finally {
                suppressAutoSave = false;
            }
        }

        function applyPrefilledValues() {
            suppressAutoSave = true;

            Object.entries(rangeMappingDbToScreen).forEach(([dbRange, screenRange]) => {
                const record = prefilledRanges[dbRange];
                if (!record) {
                    return;
                }

                const loadElement = document.getElementById(`load_${screenRange}`);
                const judgmentElement = document.getElementById(`judgment_${screenRange}`);
                if (loadElement) {
                    loadElement.textContent = record.Pbtm ?? '-';
                }

                calculateRow(screenRange);

                if (record.Pbtm !== null && loadElement) {
                    loadElement.textContent = record.Pbtm;
                    if (judgmentElement && wallTieStress2 > 0) {
                        const parsedPrefill = Number.parseFloat(record.Pbtm);
                        if (!Number.isNaN(parsedPrefill)) {
                            const judgment = parsedPrefill <= wallTieStress2 ? 'OK' : 'NG';
                            judgmentElement.textContent = judgment;
                            judgmentElement.className = judgment === 'OK'
                                ? 'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-green-600'
                                : 'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-red-600';
                        }
                    }
                }
            });

            suppressAutoSave = false;
        }

        // メッセージ表示関数
        function showInputMessage(message, type) {
            // 既存のメッセージがあれば削除
            const existingMessage = document.querySelector('.input-message-toast');
            if (existingMessage) {
                existingMessage.remove();
            }

            // メッセージ要素を作成
            const messageDiv = document.createElement('div');
            messageDiv.className = `input-message-toast fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
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
