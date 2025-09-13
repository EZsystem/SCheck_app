<x-layouts.app title="現場パラメータ入力">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-4xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.allowable-stress') }}'">
                        ← 前に戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        現場パラメータ入力
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    負担面積と壁繋ぎ許容応力割増値を入力してください。
                </p>
            </div>

            {{-- 入力フォーム --}}
            <div class="space-y-6">
                {{-- 一般負担面積 --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        一般負担面積
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="l1"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                長さ L1 (m)
                            </label>
                            <input type="number" id="l1" name="l1"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                min="0.001" max="99" step="0.001" placeholder="0.001 - 99"
                                oninput="calculateA1()">
                        </div>

                        <div>
                            <label for="h1"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                高さ H1 (m)
                            </label>
                            <input type="number" id="h1" name="h1"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                min="0.001" max="99" step="0.001" placeholder="0.001 - 99"
                                oninput="calculateA1()">
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <p class="text-sm text-gray-600 dark:text-gray-400">計算結果: (小数点第2位まで切り上げ)</p>
                        <p class="text-lg font-bold text-blue-900 dark:text-blue-100">
                            L1 × H1 = A1 = <span id="a1-result">0.00</span> m²
                        </p>
                    </div>
                </div>

                {{-- 突出部負担面積 --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        突出部負担面積
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="l2"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                長さ L2 (m)
                            </label>
                            <input type="number" id="l2" name="l2"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                min="0.001" max="99" step="0.001" placeholder="0.001 - 99"
                                oninput="calculateA2()">
                        </div>

                        <div>
                            <label for="h2_upper"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                高さ上 h1 (m)
                            </label>
                            <input type="number" id="h2_upper" name="h2_upper"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                min="0.001" max="99" step="0.001" placeholder="0.001 - 99"
                                oninput="calculateA2()">
                        </div>

                        <div>
                            <label for="h2_lower"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                高さ下 h2 (m)
                            </label>
                            <input type="number" id="h2_lower" name="h2_lower"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                min="0.001" max="99" step="0.001" placeholder="0.001 - 99"
                                oninput="calculateA2()">
                        </div>
                    </div>

                    <div class="mt-4 space-y-2">
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <p class="text-sm text-gray-600 dark:text-gray-400">計算結果: (小数点第2位まで切り上げ)</p>
                            <p class="text-lg font-bold text-blue-900 dark:text-blue-100">
                                L2 × h1 = a1 = <span id="a2-upper-result">0.00</span> m²
                            </p>
                        </div>
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <p class="text-lg font-bold text-blue-900 dark:text-blue-100">
                                L2 × h2 = a2 = <span id="a2-lower-result">0.00</span> m²
                            </p>
                        </div>
                    </div>
                </div>

                {{-- 壁繋ぎ許容応力割増値 --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        壁繋ぎ許容応力割増値
                    </h2>

                    <div class="max-w-md">
                        <label for="war" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            War (単位なし)
                        </label>
                        <input type="number" id="war" name="war"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                            min="0.1" max="10" step="0.1" placeholder="0.1 - 10">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            範囲: 0.1 ～ 10
                        </p>
                    </div>
                </div>

                {{-- 入力値確認 --}}
                <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-6" id="summary" style="display: none;">
                    <h2 class="text-lg font-semibold text-green-900 dark:text-green-100 mb-4">
                        入力値確認
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <h3 class="font-medium text-green-800 dark:text-green-200 mb-2">一般負担面積</h3>
                            <p>L1: <span id="summary-l1">-</span> m</p>
                            <p>H1: <span id="summary-h1">-</span> m</p>
                            <p class="font-bold">A1: <span id="summary-a1">-</span> m²</p>
                        </div>
                        <div>
                            <h3 class="font-medium text-green-800 dark:text-green-200 mb-2">突出部負担面積</h3>
                            <p>L2: <span id="summary-l2">-</span> m</p>
                            <p>h1: <span id="summary-h2-upper">-</span> m</p>
                            <p>h2: <span id="summary-h2-lower">-</span> m</p>
                            <p class="font-bold">a1: <span id="summary-a2-upper">-</span> m²</p>
                            <p class="font-bold">a2: <span id="summary-a2-lower">-</span> m²</p>
                        </div>
                        <div class="md:col-span-2">
                            <h3 class="font-medium text-green-800 dark:text-green-200 mb-2">壁繋ぎ許容応力割増値</h3>
                            <p class="font-bold">War: <span id="summary-war">-</span></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8 mb-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.allowable-stress') }}'">
                    戻る
                </button>

                <button
                    class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed"
                    id="confirm-btn" disabled onclick="confirmInput()">
                    入力値確認
                </button>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        // 入力値を保存する変数
        let inputValues = {
            l1: null,
            h1: null,
            l2: null,
            h2_upper: null,
            h2_lower: null,
            war: null,
            a1: null,
            a2_upper: null,
            a2_lower: null
        };

        // A1の計算（切り上げ）
        function calculateA1() {
            const l1 = parseFloat(document.getElementById('l1').value) || 0;
            const h1 = parseFloat(document.getElementById('h1').value) || 0;
            const a1 = l1 * h1;

            // 小数点第2位まで切り上げ
            const a1Rounded = Math.ceil(a1 * 100) / 100;

            document.getElementById('a1-result').textContent = a1Rounded.toFixed(2);
            inputValues.l1 = l1 > 0 ? l1 : null;
            inputValues.h1 = h1 > 0 ? h1 : null;
            inputValues.a1 = a1Rounded;

            updateSummary();
            checkFormCompletion();
        }

        // a1, a2の計算（切り上げ）
        function calculateA2() {
            const l2 = parseFloat(document.getElementById('l2').value) || 0;
            const h2_upper = parseFloat(document.getElementById('h2_upper').value) || 0;
            const h2_lower = parseFloat(document.getElementById('h2_lower').value) || 0;

            const a2_upper = l2 * h2_upper;
            const a2_lower = l2 * h2_lower;

            // 小数点第2位まで切り上げ
            const a2_upperRounded = Math.ceil(a2_upper * 100) / 100;
            const a2_lowerRounded = Math.ceil(a2_lower * 100) / 100;

            document.getElementById('a2-upper-result').textContent = a2_upperRounded.toFixed(2);
            document.getElementById('a2-lower-result').textContent = a2_lowerRounded.toFixed(2);

            inputValues.l2 = l2 > 0 ? l2 : null;
            inputValues.h2_upper = h2_upper > 0 ? h2_upper : null;
            inputValues.h2_lower = h2_lower > 0 ? h2_lower : null;
            inputValues.a2_upper = a2_upperRounded;
            inputValues.a2_lower = a2_lowerRounded;

            updateSummary();
            checkFormCompletion();
        }

        // War入力の監視
        document.getElementById('war').addEventListener('input', function() {
            const war = parseFloat(this.value) || null;
            inputValues.war = war;
            updateSummary();
            checkFormCompletion();
        });

        // サマリー更新
        function updateSummary() {
            document.getElementById('summary-l1').textContent = inputValues.l1 || '-';
            document.getElementById('summary-h1').textContent = inputValues.h1 || '-';
            document.getElementById('summary-a1').textContent = inputValues.a1 ? inputValues.a1.toFixed(2) : '-';

            document.getElementById('summary-l2').textContent = inputValues.l2 || '-';
            document.getElementById('summary-h2-upper').textContent = inputValues.h2_upper || '-';
            document.getElementById('summary-h2-lower').textContent = inputValues.h2_lower || '-';
            document.getElementById('summary-a2-upper').textContent = inputValues.a2_upper ? inputValues.a2_upper.toFixed(
                2) : '-';
            document.getElementById('summary-a2-lower').textContent = inputValues.a2_lower ? inputValues.a2_lower.toFixed(
                2) : '-';

            document.getElementById('summary-war').textContent = inputValues.war || '-';
        }

        // フォーム完了チェック
        function checkFormCompletion() {
            const isComplete = inputValues.l1 && inputValues.h1 &&
                inputValues.l2 && inputValues.h2_upper && inputValues.h2_lower &&
                inputValues.war;

            document.getElementById('confirm-btn').disabled = !isComplete;
            document.getElementById('summary').style.display = isComplete ? 'block' : 'none';
        }

        // バリデーション
        function validateInput(input, min, max) {
            const value = parseFloat(input.value);
            if (value < min || value > max) {
                input.setCustomValidity(`値は${min}から${max}の範囲で入力してください`);
                return false;
            } else {
                input.setCustomValidity('');
                return true;
            }
        }

        // 入力フィールドにバリデーションを追加
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.id === 'war') {
                    validateInput(this, 0.1, 10);
                } else {
                    validateInput(this, 0.001, 99);
                }
            });
        });

        function confirmInput() {
            // バリデーションチェック
            let isValid = true;
            document.querySelectorAll('input[type="number"]').forEach(input => {
                if (input.value) {
                    if (input.id === 'war') {
                        if (!validateInput(input, 0.1, 10)) isValid = false;
                    } else {
                        if (!validateInput(input, 0.001, 99)) isValid = false;
                    }
                }
            });

            if (!isValid) {
                alert('入力値に誤りがあります。範囲を確認してください。');
                return;
            }

            const summary = `入力値を確認します。\n\n` +
                `一般負担面積:\n` +
                `L1 = ${inputValues.l1} m\n` +
                `H1 = ${inputValues.h1} m\n` +
                `A1 = ${inputValues.a1.toFixed(2)} m² (切り上げ)\n\n` +
                `突出部負担面積:\n` +
                `L2 = ${inputValues.l2} m\n` +
                `h1 = ${inputValues.h2_upper} m\n` +
                `h2 = ${inputValues.h2_lower} m\n` +
                `a1 = ${inputValues.a2_upper.toFixed(2)} m² (切り上げ)\n` +
                `a2 = ${inputValues.a2_lower.toFixed(2)} m² (切り上げ)\n\n` +
                `壁繋ぎ許容応力割増値:\n` +
                `War = ${inputValues.war}\n\n` +
                `入力値確認画面に進みます。`;

            alert(summary);

            // 次の画面に遷移（サイト情報画面）
            window.location.href = '{{ route('scheck.site') }}';
        }
    </script>
</x-layouts.app>
