<x-layouts.app title="単つなぎ許容応力">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-6xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                        onclick="window.location.href='{{ route('scheck.index') }}'">
                        🏠 トップ
                    </button>
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.co-coefficient') }}'">
                        ← 前に戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        単つなぎ許容応力
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    該当する材料名を選択してください。行をクリックして選択します。
                </p>
            </div>

            {{-- 単つなぎ許容応力選択テーブル --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        材料名を選択してください
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                        材料名
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        選択
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                        規格
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        許容荷重入力kN
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        割増し
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        許容荷重
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 単つなぎ本体 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer stress-row"
                                    onclick="selectStress('単つなぎ本体', 'KS200 1000等', 4.41, 1.3, 5.733)"
                                    id="row_main_body">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        単つなぎ本体
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 bg-blue-500 hover:bg-blue-600 transition-colors mx-auto flex items-center justify-center">
                                            <span class="text-white text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        KS200 1000等
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        4.41
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.3
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        5.733
                                    </td>
                                </tr>

                                {{-- 鉄骨クランプ（H形鋼用） --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer stress-row"
                                    onclick="selectStress('鉄骨クランプ（H形鋼用）', '', 4.41, 1.3, 5.733)" id="row_steel_clamp">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        鉄骨クランプ（H形鋼用）
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">

                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        4.41
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.3
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        5.733
                                    </td>
                                </tr>

                                {{-- 鉄骨クランプ --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer stress-row"
                                    onclick="selectStress('鉄骨クランプ', '直交型引張', 3.1, 1.3, 4.030)"
                                    id="row_steel_clamp_tension">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        鉄骨クランプ
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        直交型引張
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        3.1
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.3
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        4.030
                                    </td>
                                </tr>

                                {{-- 鉄骨クランプ（直交型圧縮） --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer stress-row"
                                    onclick="selectStress('鉄骨クランプ', '直交型圧縮', 4.4, 1.3, 5.720)"
                                    id="row_steel_clamp_compression">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        鉄骨クランプ
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        直交型圧縮
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        4.4
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.3
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        5.720
                                    </td>
                                </tr>

                                {{-- 直交クランプ --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer stress-row"
                                    onclick="selectStress('直交クランプ', '', 4.9, 1.3, 6.370)" id="row_orthogonal_clamp">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        直交クランプ
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">

                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        4.9
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.3
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        6.370
                                    </td>
                                </tr>

                                {{-- 自在クランプ --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer stress-row"
                                    onclick="selectStress('自在クランプ', '', 3.43, 1.3, 4.459)" id="row_swivel_clamp">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        自在クランプ
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">

                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        3.43
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1.3
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        4.459
                                    </td>
                                </tr>

                                {{-- 金打ちアンカー --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer stress-row"
                                    onclick="selectStress('金打ちアンカー', 'W1/2 Rc=21 D=50', 3.75, 1, 3.750)"
                                    id="row_anchor">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        後打ちアンカー
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <div
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors mx-auto flex items-center justify-center">
                                            <span class="hidden text-blue-500 text-xs selection-mark">○</span>
                                        </div>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white">
                                        W1/2 Rc=21 D=50
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        3.75
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        1
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-gray-900 dark:text-white">
                                        3.750
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- 注意事項 --}}
                    <div
                        class="mt-4 p-3 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                        <p class="text-red-800 dark:text-red-200 text-sm font-medium">
                            ※ 既設工事会認定品を使用の場合は割増し
                        </p>
                    </div>
                </div>
            </div>

            {{-- 選択結果表示 --}}
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 mt-6" id="selection-result">
                <h3 class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-2">選択結果</h3>
                <p class="text-blue-800 dark:text-blue-200" id="selected-info">単つなぎ本体 (KS200 1000等)</p>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-3">
                    <div class="bg-white dark:bg-gray-700 p-3 rounded border">
                        <p class="text-sm text-gray-600 dark:text-gray-400">許容荷重入力</p>
                        <p class="text-lg font-bold text-blue-900 dark:text-blue-100">
                            <span id="selected-input-load">4.41</span> kN
                        </p>
                    </div>
                    <div class="bg-white dark:bg-gray-700 p-3 rounded border">
                        <p class="text-sm text-gray-600 dark:text-gray-400">割増し</p>
                        <p class="text-lg font-bold text-blue-900 dark:text-blue-100">
                            <span id="selected-multiplier">1.3</span>
                        </p>
                    </div>
                    <div class="bg-white dark:bg-gray-700 p-3 rounded border">
                        <p class="text-sm text-gray-600 dark:text-gray-400">許容荷重</p>
                        <p class="text-lg font-bold text-blue-900 dark:text-blue-100">
                            <span id="selected-allowable-load">5.733</span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- 壁繋ぎ許容割増値入力 --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg mt-6">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        壁繋ぎ許容割増値入力
                    </h2>

                    <div class="max-w-md">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            War (0.0 ～ 10.0)
                        </label>
                        <input type="number" id="war-input" step="0.1" min="0.0" max="10.0"
                            value="1.0" placeholder="1.0"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" />
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            壁繋ぎ許容割増値を0.0から10.0の範囲で入力してください
                        </p>
                    </div>
                </div>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8 mb-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.co-coefficient') }}'">
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
        let selectedMaterialName = '単つなぎ本体';
        let selectedSpecification = 'KS200 1000等';
        let selectedInputLoad = 4.41;
        let selectedMultiplier = 1.3;
        let selectedAllowableLoad = 5.733;

        function selectStress(materialName, specification, inputLoad, multiplier, allowableLoad) {
            // 全ての行のハイライトをリセット
            document.querySelectorAll('.stress-row').forEach(row => {
                row.classList.remove('bg-blue-100', 'dark:bg-blue-900');
            });

            // 全ての選択マークをリセット
            document.querySelectorAll('.selection-mark').forEach(mark => {
                mark.classList.add('hidden');
                mark.classList.remove('text-white');
                mark.classList.add('text-blue-500');
            });

            // 全ての選択ボタンをリセット
            document.querySelectorAll('.stress-row td:nth-child(2) div').forEach(btn => {
                btn.classList.remove('bg-blue-500', 'hover:bg-blue-600');
                btn.classList.add('border-2', 'border-blue-500', 'hover:bg-blue-100', 'dark:hover:bg-blue-900');
            });

            // 選択された行をハイライト
            const selectedRow = event.target.closest('.stress-row');
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
            selectedMaterialName = materialName;
            selectedSpecification = specification;
            selectedInputLoad = inputLoad;
            selectedMultiplier = multiplier;
            selectedAllowableLoad = allowableLoad;

            // 結果表示を更新
            const infoText = specification ? `${materialName} (${specification})` : materialName;
            document.getElementById('selected-info').textContent = infoText;
            document.getElementById('selected-input-load').textContent = inputLoad;
            document.getElementById('selected-multiplier').textContent = multiplier;
            document.getElementById('selected-allowable-load').textContent = allowableLoad;
        }

        function confirmSelection() {
            // War値を取得
            const warValue = parseFloat(document.getElementById('war-input').value);

            // バリデーション
            if (isNaN(warValue) || warValue < 0.0 || warValue > 10.0) {
                alert('War値は0.0から10.0の範囲で入力してください。');
                return;
            }

            // 許容荷重値とWar値をサーバーに送信するフォームを作成
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('scheck.allowable-stress.save') }}';

            // CSRFトークンを追加
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // wall_tie_stress値を追加（許容荷重を使用）
            const wallTieStressInput = document.createElement('input');
            wallTieStressInput.type = 'hidden';
            wallTieStressInput.name = 'wall_tie_stress';
            wallTieStressInput.value = selectedAllowableLoad;
            form.appendChild(wallTieStressInput);

            // War値を追加
            const warInput = document.createElement('input');
            warInput.type = 'hidden';
            warInput.name = 'War';
            warInput.value = warValue;
            form.appendChild(warInput);

            // フォームをページに追加して送信
            document.body.appendChild(form);
            form.submit();
        }

        // 初期状態で「単つなぎ本体」を選択状態にする
        window.addEventListener('DOMContentLoaded', function() {
            // 初期選択状態として最初の行を青色でハイライト
            document.getElementById('row_main_body').classList.add('bg-blue-100', 'dark:bg-blue-900');
        });
    </script>
</x-layouts.app>
