<x-layouts.app title="Co: コンクリート等の充実率（φと基本風力係数）">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-4xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.eg-coefficient') }}'">
                        ← 前に戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Co: コンクリート等の充実率（φと基本風力係数）
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    該当する部材名を選択してください。行をクリックして選択します。
                </p>
            </div>

            {{-- Co係数選択テーブル --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        部材名を選択してください
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                        部材名
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        選択
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        φ
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        Co
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 防音パネル --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer co-row"
                                    onclick="selectCo('防音パネル', 1.00, 2.00)" id="row_soundproof_panel">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        防音パネル
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 bg-blue-500 hover:bg-blue-600 transition-colors mx-auto flex items-center justify-center">
                                            <span class="text-white text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.00
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        2.00
                                    </td>
                                </tr>

                                {{-- 防水シート --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer co-row"
                                    onclick="selectCo('防水シート', 1.00, 2.00)" id="row_waterproof_sheet">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        防水シート
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.00
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        2.00
                                    </td>
                                </tr>

                                {{-- 防音シート --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer co-row"
                                    onclick="selectCo('防音シート', 1.00, 2.00)" id="row_soundproof_sheet">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        防音シート
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.00
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        2.00
                                    </td>
                                </tr>

                                {{-- メッシュシート#1034 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer co-row"
                                    onclick="selectCo('メッシュシート#1034', 0.90, 1.87)" id="row_mesh_1034">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        メッシュシート#1034
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        0.90
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.87
                                    </td>
                                </tr>

                                {{-- メッシュシート#2054 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer co-row"
                                    onclick="selectCo('メッシュシート#2054', 0.71, 1.58)" id="row_mesh_2054">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        メッシュシート#2054
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        0.71
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.58
                                    </td>
                                </tr>

                                {{-- ネット@15mm --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer co-row"
                                    onclick="selectCo('ネット@15mm', 0.24, 0.39)" id="row_net_15mm">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        ネット@15mm
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        0.24
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        0.39
                                    </td>
                                </tr>

                                {{-- ネット@25mm --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer co-row"
                                    onclick="selectCo('ネット@25mm', 0.11, 0.16)" id="row_net_25mm">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        ネット@25mm
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        0.11
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        0.16
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
                <p class="text-blue-800 dark:text-blue-200" id="selected-info">防音パネル</p>
                <div class="grid grid-cols-2 gap-4 mt-3">
                    <p class="text-xl font-bold text-blue-900 dark:text-blue-100">
                        φ = <span id="selected-phi">1.00</span>
                    </p>
                    <p class="text-xl font-bold text-blue-900 dark:text-blue-100">
                        Co = <span id="selected-co">2.00</span>
                    </p>
                </div>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8 mb-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.eg-coefficient') }}'">
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
        let selectedPhi = 1.00;
        let selectedCo = 2.00;
        let selectedMaterial = '防音パネル';
        let selectedInfo = '防音パネル';

        function selectCo(material, phi, co) {
            // 全ての行のハイライトをリセット
            document.querySelectorAll('.co-row').forEach(row => {
                row.classList.remove('bg-blue-100', 'dark:bg-blue-900');
            });

            // 全ての選択マークをリセット
            document.querySelectorAll('.selection-mark').forEach(mark => {
                mark.classList.add('hidden');
                mark.classList.remove('text-white');
                mark.classList.add('text-blue-500');
            });

            // 全ての選択ボタンをリセット
            document.querySelectorAll('.co-row td:nth-child(2) div').forEach(btn => {
                btn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                btn.classList.add('border-2', 'border-blue-500', 'hover:bg-blue-100', 'dark:hover:bg-blue-900');
            });

            // 選択された行をハイライト
            const selectedRow = event.target.closest('.co-row');
            selectedRow.classList.add('bg-blue-100', 'dark:bg-blue-900');

            // 選択された行の選択マークを表示
            const selectedMark = selectedRow.querySelector('.selection-mark');
            selectedMark.classList.remove('hidden');

            // 選択された行のボタンをアクティブに
            const selectedBtn = selectedRow.querySelector('td:nth-child(2) div');
            selectedBtn.classList.add('bg-blue-500', 'hover:bg-blue-600');
            selectedBtn.classList.remove('hover:bg-blue-100', 'dark:hover:bg-blue-900');
            selectedMark.classList.add('text-white');
            selectedMark.classList.remove('text-blue-500');

            // 選択結果を保存
            selectedPhi = phi;
            selectedCo = co;
            selectedMaterial = material;
            selectedInfo = material;

            // 結果表示を更新
            document.getElementById('selected-phi').textContent = phi;
            document.getElementById('selected-co').textContent = co;
            document.getElementById('selected-info').textContent = material;
        }

        function confirmSelection() {
            alert(`${selectedMaterial} で確定しました。\nφ = ${selectedPhi}\nCo = ${selectedCo}\n\n次の画面（サイト情報入力）に進みます。`);
            // 次の画面に遷移
            window.location.href = '{{ route('scheck.site') }}';
        }

        // 初期状態で「防音パネル」を選択状態にする
        window.addEventListener('DOMContentLoaded', function() {
            // 初期選択状態として最初の行を青色でハイライト
            document.getElementById('row_soundproof_panel').classList.add('bg-blue-100', 'dark:bg-blue-900');
        });
    </script>
</x-layouts.app>
