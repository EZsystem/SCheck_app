<x-layouts.app title="Eg: 庇上や障斜地に設ける場合の小地形による影響">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-5xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.eb-coefficient') }}'">
                        ← 前に戻る
                    </button>
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">
                        Eg: 庇上や障斜地に設ける場合の地表面からの高さZにおける小地形による影響
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    該当する地形条件を選択してください。行をクリックして選択します。
                </p>
            </div>

            {{-- Eg係数選択テーブル --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        地形条件を選択してください
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                        地形条件
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        選択
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        Eg
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 平坦・非傾斜地 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer eg-row"
                                    onclick="selectEG('平坦・非傾斜地', 1.0)" id="row_flat">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        平坦・非傾斜地
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
                                </tr>

                                {{-- 軽度の傾斜地 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer eg-row"
                                    onclick="selectEG('軽度の傾斜地（例：傾斜角15°程度）', 1.1)" id="row_light">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        軽度の傾斜地（例：傾斜角15°程度）
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
                                </tr>

                                {{-- 中程度以上の傾斜地・尾根地形 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer eg-row"
                                    onclick="selectEG('中程度以上の傾斜地・尾根地形', 1.2)" id="row_moderate">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        中程度以上の傾斜地・尾根地形
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
                                </tr>

                                {{-- 断崖や小地形の複合地形 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer eg-row"
                                    onclick="selectEG('断崖や小地形の複合地形（尾根＋斜面）', 1.3)" id="row_complex">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        断崖や小地形の複合地形（尾根＋斜面）
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.3
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
                <p class="text-blue-800 dark:text-blue-200" id="selected-info">平坦・非傾斜地</p>
                <p class="text-xl font-bold text-blue-900 dark:text-blue-100 mt-2">
                    Eg = <span id="selected-eg">1.0</span>
                </p>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8 mb-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.eb-coefficient') }}'">
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
        let selectedEG = 1.0;
        let selectedType = '平坦・非傾斜地';
        let selectedInfo = '平坦・非傾斜地';

        function selectEG(type, eg) {
            // 全ての行のハイライトをリセット
            document.querySelectorAll('.eg-row').forEach(row => {
                row.classList.remove('bg-blue-100', 'dark:bg-blue-900');
            });

            // 全ての選択マークをリセット
            document.querySelectorAll('.selection-mark').forEach(mark => {
                mark.classList.add('hidden');
                mark.classList.remove('text-white');
                mark.classList.add('text-blue-500');
            });

            // 全ての選択ボタンをリセット
            document.querySelectorAll('.eg-row td:nth-child(2) div').forEach(btn => {
                btn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                btn.classList.add('border-2', 'border-blue-500', 'hover:bg-blue-100', 'dark:hover:bg-blue-900');
            });

            // 選択された行をハイライト
            const selectedRow = event.target.closest('.eg-row');
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
            selectedEG = eg;
            selectedType = type;
            selectedInfo = type;

            // 結果表示を更新
            document.getElementById('selected-eg').textContent = eg;
            document.getElementById('selected-info').textContent = type;
        }

        function confirmSelection() {
            // Eg値をサーバーに送信するフォームを作成
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('scheck.eg-coefficient.save') }}';

            // CSRFトークンを追加
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // Eg値を追加
            const egInput = document.createElement('input');
            egInput.type = 'hidden';
            egInput.name = 'Eg';
            egInput.value = selectedEG;
            form.appendChild(egInput);

            // フォームをページに追加して送信
            document.body.appendChild(form);
            form.submit();
        }

        // 初期状態で「平坦・非傾斜地」を選択状態にする
        window.addEventListener('DOMContentLoaded', function() {
            // 初期選択状態として最初の行を青色でハイライト
            document.getElementById('row_flat').classList.add('bg-blue-100', 'dark:bg-blue-900');
        });
    </script>
</x-layouts.app>
