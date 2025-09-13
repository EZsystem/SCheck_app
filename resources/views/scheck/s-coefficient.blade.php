<x-layouts.app title="S: 地上又における瞬間風速分布係数">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-6xl mx-auto">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.environment') }}'">
                        ← 前に戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        S: 地上又における瞬間風速分布係数
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    地域分類（I〜V）を選択してください。該当する列をクリックして選択します。
                </p>
            </div>

            {{-- S係数選択テーブル --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        地域分類を選択してください
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th rowspan="2"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        地上からの高さZ(m)
                                    </th>
                                    <th colspan="5"
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        地域分類
                                    </th>
                                </tr>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                        onclick="selectColumn('I', '海岸・海上')" id="col_I">
                                        I<br><span class="text-xs font-normal">海岸・海上</span>
                                    </th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                        onclick="selectColumn('II', '平坦・田園')" id="col_II">
                                        II<br><span class="text-xs font-normal">平坦・田園</span>
                                    </th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                        onclick="selectColumn('III', '郊外・森')" id="col_III">
                                        III<br><span class="text-xs font-normal">郊外・森</span>
                                    </th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                        onclick="selectColumn('IV', '一般市街地')" id="col_IV">
                                        IV<br><span class="text-xs font-normal">一般市街地</span>
                                    </th>
                                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white cursor-pointer hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                        onclick="selectColumn('V', '大都市市街地')" id="col_V">
                                        V<br><span class="text-xs font-normal">大都市市街地</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 0～10 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white font-medium">
                                        0～10
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="I">1.65</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="II">1.35</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value "
                                        data-column="III">1.35</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="IV">1.19</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="V">1.07</td>
                                </tr>
                                {{-- 10～20 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white font-medium">
                                        10～20
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="I">1.74</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="II">1.47</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value "
                                        data-column="III">1.47</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="IV">1.25</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="V">1.07</td>
                                </tr>
                                {{-- 20～35 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white font-medium">
                                        20～35
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="I">1.84</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="II">1.59</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value "
                                        data-column="III">1.59</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="IV">1.36</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="V">1.15</td>
                                </tr>
                                {{-- 35～40 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white font-medium">
                                        35～40
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="I">1.84</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="II">1.68</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value "
                                        data-column="III">1.68</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="IV">1.46</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="V">1.22</td>
                                </tr>
                                {{-- 40～50 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white font-medium">
                                        40～50
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="I">1.92</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="II">1.68</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value "
                                        data-column="III">1.68</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="IV">1.46</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="V">1.22</td>
                                </tr>
                                {{-- 50～55 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white font-medium">
                                        50～55
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="I">1.92</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="II">1.68</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value "
                                        data-column="III">1.68</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="IV">1.55</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="V">1.31</td>
                                </tr>
                                {{-- 55～70 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white font-medium">
                                        55～70
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="I">1.92</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="II">1.77</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value "
                                        data-column="III">1.77</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="IV">1.55</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="V">1.31</td>
                                </tr>
                                {{-- 70～100 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white font-medium">
                                        70～100
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="I">1.99</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="II">1.84</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value "
                                        data-column="III">1.84</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="IV">1.64</td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center text-gray-900 dark:text-white s-value"
                                        data-column="V">1.41</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- 選択結果表示 --}}
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 mt-6" id="selection-result"
                style="display: none;">
                <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-2">選択結果</h3>
                <p class="text-blue-800 dark:text-blue-200" id="selected-info"></p>
                <div class="mt-3">
                    <p class="text-sm text-blue-700 dark:text-blue-300 mb-2">各高さ区分のS値:</p>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-sm" id="s-values-display">
                        <!-- JavaScript で動的に生成 -->
                    </div>
                </div>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.environment') }}'">
                    戻る
                </button>

                <button
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed"
                    id="confirm-btn" disabled onclick="confirmSelection()">
                    進む（値確定）
                </button>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        let selectedColumn = null;
        let selectedInfo = '';
        let sValues = {};

        // S値のデータ
        const sData = {
            'I': {
                '0-10': 1.65,
                '10-20': 1.74,
                '20-35': 1.84,
                '35-40': 1.84,
                '40-50': 1.92,
                '50-55': 1.92,
                '55-70': 1.92,
                '70-100': 1.99
            },
            'II': {
                '0-10': 1.35,
                '10-20': 1.47,
                '20-35': 1.59,
                '35-40': 1.68,
                '40-50': 1.68,
                '50-55': 1.68,
                '55-70': 1.77,
                '70-100': 1.84
            },
            'III': {
                '0-10': 1.35,
                '10-20': 1.47,
                '20-35': 1.59,
                '35-40': 1.68,
                '40-50': 1.68,
                '50-55': 1.68,
                '55-70': 1.77,
                '70-100': 1.84
            },
            'IV': {
                '0-10': 1.19,
                '10-20': 1.25,
                '20-35': 1.36,
                '35-40': 1.46,
                '40-50': 1.46,
                '50-55': 1.55,
                '55-70': 1.55,
                '70-100': 1.64
            },
            'V': {
                '0-10': 1.07,
                '10-20': 1.07,
                '20-35': 1.15,
                '35-40': 1.22,
                '40-50': 1.22,
                '50-55': 1.31,
                '55-70': 1.31,
                '70-100': 1.41
            }
        };

        const regionNames = {
            'I': '海岸・海上',
            'II': '平坦・田園',
            'III': '郊外・森',
            'IV': '一般市街地',
            'V': '大都市市街地'
        };

        function selectColumn(column, description) {
            // 全ての列のハイライトをリセット
            document.querySelectorAll('th[id^="col_"]').forEach(col => {
                col.classList.remove('bg-blue-200', 'dark:bg-blue-800');
            });

            // 全ての値のハイライトをリセット
            document.querySelectorAll('.s-value').forEach(cell => {
                cell.classList.remove('bg-blue-100', 'dark:bg-blue-900');
            });

            // 選択された列をハイライト
            document.getElementById(`col_${column}`).classList.add('bg-blue-200', 'dark:bg-blue-800');

            // 選択された列の値をハイライト
            document.querySelectorAll(`.s-value[data-column="${column}"]`).forEach(cell => {
                cell.classList.add('bg-blue-100', 'dark:bg-blue-900');
            });

            // 選択結果を保存
            selectedColumn = column;
            selectedInfo = `地域分類 ${column}: ${description}`;
            sValues = sData[column];

            // 結果表示を更新
            document.getElementById('selected-info').textContent = selectedInfo;

            // S値一覧を表示
            const sValuesDisplay = document.getElementById('s-values-display');
            sValuesDisplay.innerHTML = '';

            Object.entries(sValues).forEach(([height, value]) => {
                const div = document.createElement('div');
                div.className = 'bg-white dark:bg-gray-700 p-2 rounded border';
                div.innerHTML = `<span class="font-medium">${height}m:</span> ${value}`;
                sValuesDisplay.appendChild(div);
            });

            document.getElementById('selection-result').style.display = 'block';

            // 確定ボタンを有効化
            document.getElementById('confirm-btn').disabled = false;
        }

        function confirmSelection() {
            if (selectedColumn) {
                alert(`地域分類 ${selectedColumn} (${regionNames[selectedColumn]}) で確定しました。\n\n次の画面（Ke係数入力）に進みます。`);
                // 次の画面に遷移
                window.location.href = '{{ route('scheck.ke-coefficient') }}';
            }
        }
    </script>
</x-layouts.app>
