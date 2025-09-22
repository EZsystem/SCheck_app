<x-layouts.app title="Ke: 台風時地域係数">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-4xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                        onclick="window.location.href='{{ route('scheck.index') }}'">
                        🏠 トップ
                    </button>
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.s-coefficient') }}'">
                        ← 前に戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Ke: 台風時地域係数
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    該当する地域を選択してください。行をクリックして選択します。
                </p>
            </div>

            {{-- Ke係数選択テーブル --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        地域を選択してください
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        地方名
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        選択
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        割増係数
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                        県名
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 中国 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer ke-row"
                                    onclick="selectKe('中国', 1.1, '山口県')" id="row_chugoku">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white font-medium">
                                        中国
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.1
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        山口県
                                    </td>
                                </tr>

                                {{-- 九州 1.1 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer ke-row"
                                    onclick="selectKe('九州', 1.1, '福岡県・佐賀県・長崎県・熊本県・大分県・宮崎県')" id="row_kyushu_11">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white font-medium">
                                        九州
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.1
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        福岡県・佐賀県・長崎県・熊本県・大分県・宮崎県
                                    </td>
                                </tr>

                                {{-- 九州 1.2 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer ke-row"
                                    onclick="selectKe('九州', 1.2, '鹿児島県・沖縄県')" id="row_kyushu_12">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white font-medium">
                                        九州
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.2
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        鹿児島県・沖縄県
                                    </td>
                                </tr>

                                {{-- その他 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer ke-row"
                                    onclick="selectKe('その他', 1.0, 'その他の地域')" id="row_others">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white font-medium">
                                        その他
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 bg-blue-500 hover:bg-blue-600 transition-colors mx-auto flex items-center justify-center">
                                            <span class="text-white text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.0
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- 選択結果表示 --}}
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 mt-6" id="selection-result">
                <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-2">選択結果</h3>
                <p class="text-blue-800 dark:text-blue-200" id="selected-info">その他の地域</p>
                <p class="text-xl font-bold text-blue-900 dark:text-blue-100 mt-2">
                    Ke = <span id="selected-ke">1.0</span>
                </p>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8 mb-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.s-coefficient') }}'">
                    戻る
                </button>

                <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                    id="confirm-btn" onclick="confirmSelection()">
                    進む（値確定）
                </button>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        let selectedKe = @json($param->Ke ?? 1.0);
        let selectedRegion = 'その他';
        let selectedInfo = 'その他の地域';
        const initialKe = @json($param->Ke);

        function resetRows() {
            document.querySelectorAll('.ke-row').forEach(row => {
                row.classList.remove('bg-blue-100', 'dark:bg-blue-900');
            });

            document.querySelectorAll('.selection-mark').forEach(mark => {
                mark.classList.add('hidden');
                mark.classList.remove('text-white');
                mark.classList.add('text-blue-500');
            });

            document.querySelectorAll('.ke-row td:nth-child(2) div').forEach(btn => {
                btn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                btn.classList.add('border-2', 'border-blue-500', 'hover:bg-blue-100', 'dark:hover:bg-blue-900');
            });
        }

        function highlightRow(row) {
            if (!row) {
                return;
            }
            row.classList.add('bg-blue-100', 'dark:bg-blue-900');

            const mark = row.querySelector('.selection-mark');
            if (mark) {
                mark.classList.remove('hidden');
                mark.classList.add('text-white');
                mark.classList.remove('text-blue-500');
            }

            const btn = row.querySelector('td:nth-child(2) div');
            if (btn) {
                btn.classList.remove('border-2', 'border-blue-500', 'hover:bg-blue-100', 'dark:hover:bg-blue-900');
                btn.classList.add('bg-blue-500', 'hover:bg-blue-600');
            }
        }

        function selectKe(region, ke, description, rowElement = null) {
            resetRows();

            let selectedRow = rowElement;
            if (!selectedRow && typeof event !== 'undefined' && event.target) {
                selectedRow = event.target.closest('.ke-row');
            }
            highlightRow(selectedRow);

            selectedKe = parseFloat(ke);
            selectedRegion = region;
            selectedInfo = description;

            document.getElementById('selected-ke').textContent = selectedKe.toFixed(2).replace(/\.00$/, '');
            document.getElementById('selected-info').textContent = description ? `${region}: ${description}` : region || description || '';
            document.getElementById('selection-result').style.display = 'block';
            document.getElementById('confirm-btn').disabled = false;
        }

        function confirmSelection() {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('scheck.ke-coefficient.save') }}';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            const keInput = document.createElement('input');
            keInput.type = 'hidden';
            keInput.name = 'Ke';
            keInput.value = selectedKe;
            form.appendChild(keInput);

            document.body.appendChild(form);
            form.submit();
        }

        window.addEventListener('DOMContentLoaded', function() {
            const rows = Array.from(document.querySelectorAll('.ke-row'));
            rows.forEach(row => {
                const keText = row.querySelector('td:nth-child(3)')?.textContent?.trim();
                if (!keText) {
                    return;
                }
                row.dataset.ke = parseFloat(keText);
                row.dataset.region = row.querySelector('td:first-child')?.textContent?.trim() ?? '';
                row.dataset.description = row.querySelector('td:nth-child(4)')?.textContent?.trim() ?? '';
            });

            if (initialKe) {
                const matchedRow = rows.find(row => Math.abs((row.dataset.ke ?? NaN) - initialKe) < 0.001);
                if (matchedRow) {
                    selectKe(
                        matchedRow.dataset.region,
                        initialKe,
                        matchedRow.dataset.description,
                        matchedRow
                    );
                } else {
                    selectedKe = parseFloat(initialKe);
                    selectedRegion = '';
                    selectedInfo = `現在設定: Ke = ${initialKe}`;
                    document.getElementById('selected-ke').textContent = initialKe;
                    document.getElementById('selected-info').textContent = selectedInfo;
                    document.getElementById('selection-result').style.display = 'block';
                    document.getElementById('confirm-btn').disabled = false;
                }
            } else {
                const defaultRow = document.getElementById('row_others');
                if (defaultRow) {
                    selectKe(
                        defaultRow.dataset.region || 'その他',
                        parseFloat(defaultRow.dataset.ke ?? 1.0),
                        defaultRow.dataset.description || 'その他の地域',
                        defaultRow
                    );
                }
            }
        });
    </script>
</x-layouts.app>
