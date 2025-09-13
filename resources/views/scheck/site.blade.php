<x-layouts.app title="現場条件入力">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-4xl mx-auto">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.allowable-stress') }}'">
                        ← 戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        値入力：現場
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    Rの値を計算するための寸法を入力してください
                </p>
            </div>

            {{-- 入力フォーム --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                        R値計算用の寸法入力
                    </h2>

                    <form class="space-y-6">
                        {{-- R: 足場の形状、シート及びネット（自動計算） --}}
                        <div class="col-span-full">
                            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-6 mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                                    R: 足場の形状、シート及びネット（自動計算）
                                </h3>

                                {{-- 地上と空中の入力を分離 --}}
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    {{-- 地上から建つ場合 --}}
                                    <div
                                        class="bg-white dark:bg-gray-800 rounded-lg p-5 border border-gray-200 dark:border-gray-600">
                                        <h4
                                            class="text-lg font-medium text-green-700 dark:text-green-400 mb-4 flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                            </svg>
                                            地上から建つ場合
                                        </h4>

                                        <div class="grid grid-cols-2 gap-3 mb-4">
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    L: 長さ (m)
                                                </label>
                                                <input type="number" id="ground_length" step="0.1" min="0"
                                                    placeholder="10.0"
                                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white"
                                                    oninput="calculateR()" />
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    B: 幅 (m)
                                                </label>
                                                <input type="number" id="ground_width" step="0.1" min="0"
                                                    placeholder="5.0"
                                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white"
                                                    oninput="calculateR()" />
                                            </div>
                                        </div>

                                        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
                                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">計算結果</div>
                                            <div class="text-3xl font-bold text-green-600 dark:text-green-400"
                                                id="r_ground">
                                                -
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                                計算式: 0.5813 + 0.013×(L/B) - 0.0001×(L/B)²
                                            </div>
                                        </div>
                                    </div>

                                    {{-- 空中にある場合 --}}
                                    <div
                                        class="bg-white dark:bg-gray-800 rounded-lg p-5 border border-gray-200 dark:border-gray-600">
                                        <h4
                                            class="text-lg font-medium text-blue-700 dark:text-blue-400 mb-4 flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                                            </svg>
                                            空中にある場合
                                        </h4>

                                        <div class="grid grid-cols-2 gap-3 mb-4">
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    B: 幅 (m)
                                                </label>
                                                <input type="number" id="aerial_width" step="0.1" min="0"
                                                    placeholder="5.0"
                                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                    oninput="calculateR()" />
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                    H: 高さ (m)
                                                </label>
                                                <input type="number" id="aerial_height" step="0.1" min="0"
                                                    placeholder="3.0"
                                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"
                                                    oninput="calculateR()" />
                                            </div>
                                        </div>

                                        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                                            <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">計算結果</div>
                                            <div class="text-3xl font-bold text-blue-600 dark:text-blue-400"
                                                id="r_aerial">
                                                -
                                            </div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                                計算式: 0.5813 + 0.013×(H×2/B) - 0.001×(H×2/B)²
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.allowable-stress') }}'">
                    戻る
                </button>

                <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                    onclick="window.location.href='{{ route('scheck.input-parameters') }}'">
                    進む（値確定）
                </button>
            </div>
        </div>
    </div>

    <script>
        function calculateR() {
            // 地上から建つ場合の入力値
            const groundL = parseFloat(document.getElementById('ground_length').value) || 0;
            const groundB = parseFloat(document.getElementById('ground_width').value) || 0;

            // 空中にある場合の入力値
            const aerialB = parseFloat(document.getElementById('aerial_width').value) || 0;
            const aerialH = parseFloat(document.getElementById('aerial_height').value) || 0;

            const rAerialElement = document.getElementById('r_aerial');
            const rGroundElement = document.getElementById('r_ground');

            // 地上から建つ場合の計算: R = ROUND(0.5813 + 0.013*(L/B) - 0.0001*(L/B)^2, 1)
            if (groundL > 0 && groundB > 0) {
                const ratio_LB = groundL / groundB;
                const rGround = Math.round((0.5813 + 0.013 * ratio_LB - 0.0001 * Math.pow(ratio_LB, 2)) * 10) / 10;
                rGroundElement.textContent = rGround.toFixed(1);
            } else {
                rGroundElement.textContent = '-';
            }

            // 空中にある場合の計算: R = ROUND(0.5813 + 0.013*(H*2/B) - 0.001*(H*2/B)^2, 1)
            if (aerialB > 0 && aerialH > 0) {
                const ratio_H2B = (aerialH * 2) / aerialB;
                const rAerial = Math.round((0.5813 + 0.013 * ratio_H2B - 0.001 * Math.pow(ratio_H2B, 2)) * 10) / 10;
                rAerialElement.textContent = rAerial.toFixed(1);
            } else {
                rAerialElement.textContent = '-';
            }
        }

        // ページ読み込み時に初期計算を実行
        document.addEventListener('DOMContentLoaded', function() {
            calculateR();
        });
    </script>
</x-layouts.app>
