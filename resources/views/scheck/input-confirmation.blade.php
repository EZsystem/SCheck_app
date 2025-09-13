<x-layouts.app title="入力値確認">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-6xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.input-parameters') }}'">
                        ← 前に戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        入力値確認
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    入力された全ての値を確認してください。修正が必要な場合は各画面に戻って変更できます。
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- 係数選択結果 --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">係数選択結果</h2>

                    {{-- S係数 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">S: 地上又における瞬間風速分布係数</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.s-coefficient') }}'">
                                変更
                            </button>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm" id="s-coefficient-info">
                            選択された地域分類と対応するS値が表示されます
                        </p>
                    </div>

                    {{-- Ke係数 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Ke: 台風時地域係数</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.ke-coefficient') }}'">
                                変更
                            </button>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm" id="ke-coefficient-info">
                            選択された地域: その他 (Ke = 1.0)
                        </p>
                    </div>

                    {{-- EB係数 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">EB: 近接高層建築物による影響</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.eb-coefficient') }}'">
                                変更
                            </button>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm" id="eb-coefficient-info">
                            選択された建築物: 近隣高層建築物無し (EB = 1.0)
                        </p>
                    </div>

                    {{-- Eg係数 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Eg: 地表面粗度による影響</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.eg-coefficient') }}'">
                                変更
                            </button>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm" id="eg-coefficient-info">
                            選択された地形: 平坦・非傾斜地 (Eg = 1.0)
                        </p>
                    </div>

                    {{-- Co係数 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Co: コンクリート等の充実率</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.co-coefficient') }}'">
                                変更
                            </button>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm" id="co-coefficient-info">
                            選択された部材: 防音パネル (φ = 1.00, Co = 2.00)
                        </p>
                    </div>

                    {{-- 単つなぎ許容応力 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">単つなぎ許容応力</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.allowable-stress') }}'">
                                変更
                            </button>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm" id="allowable-stress-info">
                            選択された材料: 単つなぎ本体 (KS200 1000等)<br>
                            許容荷重入力: 4.41 kN, 割増し: 1.3, 許容荷重: 5.733
                        </p>
                    </div>
                </div>

                {{-- 現場パラメータ --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">現場パラメータ</h2>

                    {{-- 一般負担面積 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">一般負担面積</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.input-parameters') }}'">
                                変更
                            </button>
                        </div>
                        <div class="space-y-1 text-sm">
                            <p class="text-gray-600 dark:text-gray-400">
                                長さ L1: <span id="param-l1" class="font-medium text-gray-900 dark:text-white">-</span> m
                            </p>
                            <p class="text-gray-600 dark:text-gray-400">
                                高さ H1: <span id="param-h1" class="font-medium text-gray-900 dark:text-white">-</span> m
                            </p>
                            <p class="text-gray-900 dark:text-white font-semibold">
                                面積 A1: <span id="param-a1" class="text-blue-600">-</span> m² (切り上げ)
                            </p>
                        </div>
                    </div>

                    {{-- 突出部負担面積 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">突出部負担面積</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.input-parameters') }}'">
                                変更
                            </button>
                        </div>
                        <div class="space-y-1 text-sm">
                            <p class="text-gray-600 dark:text-gray-400">
                                長さ L2: <span id="param-l2" class="font-medium text-gray-900 dark:text-white">-</span> m
                            </p>
                            <p class="text-gray-600 dark:text-gray-400">
                                高さ上 h1: <span id="param-h2-upper"
                                    class="font-medium text-gray-900 dark:text-white">-</span> m
                            </p>
                            <p class="text-gray-600 dark:text-gray-400">
                                高さ下 h2: <span id="param-h2-lower"
                                    class="font-medium text-gray-900 dark:text-white">-</span> m
                            </p>
                            <p class="text-gray-900 dark:text-white font-semibold">
                                面積 a1: <span id="param-a2-upper" class="text-blue-600">-</span> m² (切り上げ)
                            </p>
                            <p class="text-gray-900 dark:text-white font-semibold">
                                面積 a2: <span id="param-a2-lower" class="text-blue-600">-</span> m² (切り上げ)
                            </p>
                        </div>
                    </div>

                    {{-- 壁繋ぎ許容応力割増値 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">壁繋ぎ許容応力割増値</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.input-parameters') }}'">
                                変更
                            </button>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            War: <span id="param-war" class="font-medium text-gray-900 dark:text-white text-lg">-</span>
                        </p>
                    </div>

                    {{-- 入力完了状況 --}}
                    <div
                        class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 border border-green-200 dark:border-green-800">
                        <h3 class="font-semibold text-green-900 dark:text-green-100 mb-2">入力完了状況</h3>
                        <div class="space-y-1 text-sm">
                            <p class="text-green-800 dark:text-green-200">
                                ✓ 係数選択: <span id="coefficient-status">6項目</span>
                            </p>
                            <p class="text-green-800 dark:text-green-200">
                                ✓ 現場パラメータ: <span id="parameter-status">8項目</span>
                            </p>
                            <p class="font-semibold text-green-900 dark:text-green-100 mt-2">
                                全ての入力が完了しています
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8 mb-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.input-parameters') }}'">
                    現場パラメータに戻る
                </button>

                <div class="flex space-x-4">
                    <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                        onclick="showQuickNavigation()">
                        各画面に戻る
                    </button>

                    <button
                        class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors font-semibold"
                        onclick="executeCalculation()">
                        計算実行
                    </button>
                </div>
            </div>

            {{-- クイックナビゲーション（モーダル） --}}
            <div id="quick-nav-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50"
                onclick="hideQuickNavigation()">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full"
                        onclick="event.stopPropagation()">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">各入力画面に移動</h3>
                        <div class="space-y-2">
                            <button
                                class="w-full text-left px-4 py-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded"
                                onclick="window.location.href='{{ route('scheck.s-coefficient') }}'">
                                S: 地上又における瞬間風速分布係数
                            </button>
                            <button
                                class="w-full text-left px-4 py-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded"
                                onclick="window.location.href='{{ route('scheck.ke-coefficient') }}'">
                                Ke: 台風時地域係数
                            </button>
                            <button
                                class="w-full text-left px-4 py-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded"
                                onclick="window.location.href='{{ route('scheck.eb-coefficient') }}'">
                                EB: 近接高層建築物による影響
                            </button>
                            <button
                                class="w-full text-left px-4 py-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded"
                                onclick="window.location.href='{{ route('scheck.eg-coefficient') }}'">
                                Eg: 地表面粗度による影響
                            </button>
                            <button
                                class="w-full text-left px-4 py-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded"
                                onclick="window.location.href='{{ route('scheck.co-coefficient') }}'">
                                Co: コンクリート等の充実率
                            </button>
                            <button
                                class="w-full text-left px-4 py-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded"
                                onclick="window.location.href='{{ route('scheck.allowable-stress') }}'">
                                単つなぎ許容応力
                            </button>
                            <button
                                class="w-full text-left px-4 py-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded"
                                onclick="window.location.href='{{ route('scheck.input-parameters') }}'">
                                現場パラメータ入力
                            </button>
                        </div>
                        <button
                            class="w-full mt-4 px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded hover:bg-gray-300 dark:hover:bg-gray-500"
                            onclick="hideQuickNavigation()">
                            閉じる
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        // URLパラメータから値を取得
        function loadInputValues() {
            // URLパラメータを取得
            const urlParams = new URLSearchParams(window.location.search);

            // 現場パラメータの取得
            const params = {
                l1: urlParams.get('l1') || '-',
                h1: urlParams.get('h1') || '-',
                a1: urlParams.get('a1') || '-',
                l2: urlParams.get('l2') || '-',
                h2_upper: urlParams.get('h2_upper') || '-',
                h2_lower: urlParams.get('h2_lower') || '-',
                a2_upper: urlParams.get('a2_upper') || '-',
                a2_lower: urlParams.get('a2_lower') || '-',
                war: urlParams.get('war') || '-'
            };

            // パラメータ表示を更新
            Object.keys(params).forEach(key => {
                const element = document.getElementById(`param-${key.replace('_', '-')}`);
                if (element) {
                    element.textContent = params[key];
                }
            });

            // 入力完了状況を更新
            updateCompletionStatus(params);
        }

        // 入力完了状況を更新
        function updateCompletionStatus(params) {
            const parameterCount = Object.values(params).filter(value => value !== '-').length;
            const coefficientCount = 6; // 固定（係数選択は6項目）

            document.getElementById('parameter-status').textContent = `${parameterCount}/9項目`;

            // 全て入力されている場合の表示更新
            const statusElement = document.querySelector('.bg-green-50 p');
            if (parameterCount === 9) {
                statusElement.innerHTML =
                    '<span class="font-semibold text-green-900 dark:text-green-100">全ての入力が完了しています</span>';
            } else {
                statusElement.innerHTML =
                    '<span class="font-semibold text-orange-900 dark:text-orange-100">現場パラメータの入力が不完全です</span>';
                statusElement.parentElement.className =
                    'bg-orange-50 dark:bg-orange-900/20 rounded-lg p-4 border border-orange-200 dark:border-orange-800';
            }
        }

        // クイックナビゲーション表示
        function showQuickNavigation() {
            document.getElementById('quick-nav-modal').classList.remove('hidden');
        }

        // クイックナビゲーション非表示
        function hideQuickNavigation() {
            document.getElementById('quick-nav-modal').classList.add('hidden');
        }

        // 計算実行
        function executeCalculation() {
            const confirmed = confirm('入力された値で計算を実行しますか？\n\n計算実行後は値の変更ができなくなります。');

            if (confirmed) {
                alert('計算を実行します。\n\n※計算結果画面はまだ実装されていません。\n現在はサイト情報画面に遷移します。');
                // 計算結果画面が実装されるまでの仮の遷移先
                window.location.href = '{{ route('scheck.site') }}';
            }
        }

        // ページ読み込み時に値を表示
        window.addEventListener('DOMContentLoaded', function() {
            loadInputValues();
        });
    </script>
</x-layouts.app>
