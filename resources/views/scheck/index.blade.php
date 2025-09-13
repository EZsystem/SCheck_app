<x-layouts.app title="構造計算システム">
    <div
        class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-6">
        <div class="max-w-md w-full">
            {{-- メインカード --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl border-0">
                <div class="p-8 text-center">
                    {{-- アイコン --}}
                    <div
                        class="w-20 h-20 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>

                    {{-- タイトル --}}
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        構造計算システム
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">
                        建築構造の安全性を計算・判定
                    </p>

                    {{-- メインボタン --}}
                    <button
                        class="w-full py-4 px-6 bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold rounded-lg transition-colors duration-200 mb-4"
                        onclick="alert('計算開始機能は準備中です')">
                        計算を開始する
                    </button>

                    {{-- サブボタン --}}
                    <button
                        class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 text-sm transition-colors duration-200"
                        onclick="window.location.href='{{ route('dashboard') }}'">
                        ダッシュボードに戻る
                    </button>
                </div>
            </div>

            {{-- フロー説明カード --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg mt-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 text-center">
                        計算の流れ
                    </h3>
                    <div class="space-y-3">
                        {{-- ステップ1 --}}
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-600 dark:text-blue-400 text-sm font-bold">1</span>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <div class="font-medium">値入力：環境</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Vo, S, Ke, EB, Eg</div>
                            </div>
                        </div>

                        {{-- ステップ2 --}}
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-600 dark:text-blue-400 text-sm font-bold">2</span>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <div class="font-medium">値入力：現場</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">R, Co, War, A</div>
                            </div>
                        </div>

                        {{-- ステップ3 --}}
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-600 dark:text-blue-400 text-sm font-bold">3</span>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <div class="font-medium">計算内容</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">入力値の確認と計算式表示</div>
                            </div>
                        </div>

                        {{-- ステップ4 --}}
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-blue-600 dark:text-blue-400 text-sm font-bold">4</span>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <div class="font-medium">計算実行、判定</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">安全性の自動判定</div>
                            </div>
                        </div>

                        {{-- ステップ5 --}}
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-green-600 dark:text-green-400 text-sm font-bold">5</span>
                            </div>
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                <div class="font-medium">結果出力</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">PDF形式でダウンロード</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
