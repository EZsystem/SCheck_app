<x-layouts.app title="現場条件入力">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-4xl mx-auto">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.environment') }}'">
                        ← 戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        値入力：現場
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    現場条件の値を入力してください（R, Co, War, A）
                </p>
            </div>

            {{-- 入力フォーム --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">
                        現場条件入力
                    </h2>

                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- R: 足場の形状、シート及びネット --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    R: 足場の形状、シート及びネット
                                </label>
                                <input type="number" step="0.1" placeholder="例: 1.0"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    LB内での計算値とBH値から立つ値
                                </p>
                            </div>

                            {{-- Co: 使用シート等の風力定数 --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Co: 使用シート等の風力定数
                                </label>
                                <input type="number" step="0.1" placeholder="例: 1.0"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    範囲: 0.8-1.2
                                </p>
                            </div>

                            {{-- War: 合成構造係数 --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    War: 合成構造係数
                                </label>
                                <input type="number" step="0.1" placeholder="例: 1.0"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    範囲: 0.8-1.2
                                </p>
                            </div>

                            {{-- A: 合成面積 --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    A: 合成面積
                                </label>
                                <input type="number" step="0.1" placeholder="例: 100.0"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white" />
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    単位: m² (例: 100.0)
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.environment') }}'">
                    戻る
                </button>

                <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                    onclick="alert('次の画面への遷移は準備中です')">
                    進む（値確定）
                </button>
            </div>
        </div>
    </div>
</x-layouts.app>
