<x-layouts.app title="足場に作用する風圧力">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-7xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
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
                                        <input type="number" id="width_{{ $range[1] }}" step="0.1"
                                            min="0" max="100"
                                            class="w-full px-2 py-1 bg-yellow-100 border-0 text-center text-sm focus:ring-2 focus:ring-blue-500 focus:bg-yellow-50"
                                            placeholder="0.0" oninput="calculateRow('{{ $range[1] }}')" />
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-2 py-1">
                                        <input type="number" id="height_{{ $range[1] }}" step="0.1"
                                            min="0" max="100"
                                            class="w-full px-2 py-1 bg-yellow-100 border-0 text-center text-sm focus:ring-2 focus:ring-blue-500 focus:bg-yellow-50"
                                            placeholder="0.0" oninput="calculateRow('{{ $range[1] }}')" />
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white"
                                        id="limit_height_{{ $range[1] }}">
                                        -
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white"
                                        id="load_{{ $range[1] }}">
                                        -
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
                    進む（値確定）
                </button>
            </div>
        </div>
    </div>

    <script>
        // ページ読み込み時にS係数を表示
        window.addEventListener('DOMContentLoaded', function() {
            displaySCoefficients();
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

        function calculateRow(heightRange) {
            const width = parseFloat(document.getElementById(`width_${heightRange}`).value) || 0;
            const height = parseFloat(document.getElementById(`height_${heightRange}`).value) || 0;

            if (width > 0 && height > 0) {
                const area = width * height;
                const s = parseFloat(document.getElementById(`s_${heightRange}`).textContent) || 1.0;

                // 限界高の計算（仮）
                const limitHeight = Math.round(height * 1.2 * 10) / 10;
                document.getElementById(`limit_height_${heightRange}`).textContent = limitHeight.toFixed(1);

                // 負荷荷重の計算（仮）
                const load = Math.round(area * s * 0.5 * 100) / 100;
                document.getElementById(`load_${heightRange}`).textContent = load.toFixed(2);

                // 壁繋ぎ許容応力（仮の値）
                const allowableStress = 5.73;
                document.getElementById(`allowable_stress_${heightRange}`).textContent = allowableStress.toFixed(2);

                // 判定
                const judgment = load <= allowableStress ? 'OK' : 'NG';
                const judgmentCell = document.getElementById(`judgment_${heightRange}`);
                judgmentCell.textContent = judgment;
                judgmentCell.className = judgment === 'OK' ?
                    'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-green-600' :
                    'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold text-red-600';
            } else {
                // 入力がない場合はクリア
                document.getElementById(`limit_height_${heightRange}`).textContent = '-';
                document.getElementById(`load_${heightRange}`).textContent = '-';
                document.getElementById(`allowable_stress_${heightRange}`).textContent = '-';
                document.getElementById(`judgment_${heightRange}`).textContent = '-';
                document.getElementById(`judgment_${heightRange}`).className =
                    'border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-bold';
            }
        }

        function submitInputParameters() {
            // 入力値を収集
            const data = {};
            const heightRanges = ['0_10', '10_20', '20_35', '35_40', '40_50', '50_55', '55_70', '70_100'];

            heightRanges.forEach(range => {
                const width = parseFloat(document.getElementById(`width_${range}`).value) || null;
                const height = parseFloat(document.getElementById(`height_${range}`).value) || null;

                if (width !== null) {
                    data[`L${range.replace('_', '')}`] = width;
                }
                if (height !== null) {
                    data[`H${range.replace('_', '')}`] = height;
                }
                if (width !== null && height !== null) {
                    data[`A${range.replace('_', '')}`] = width * height;
                }
            });

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
                if (data[key] !== null) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = key;
                    input.value = data[key];
                    form.appendChild(input);
                }
            });

            // フォームをページに追加して送信
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</x-layouts.app>
