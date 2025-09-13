<x-layouts.app title="Vo: 基準風速">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-4xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.index') }}'">
                        ← トップに戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Vo: 基準風速
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    表示: ランダムボタンで選択<br>
                    ボタン構成: トップに戻る、進む（値確定）、戻る<br>
                    値: Vo
                </p>
            </div>

            {{-- 基準風速選択テーブル --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        地方・地域を選択してください
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                        地方
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        基準風速<br>
                                        <span class="text-xs font-normal">m/s</span>
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">
                                        選択
                                    </th>
                                    <th
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">
                                        地域（県北限定）
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 東北 16 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white font-medium">
                                        東北
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                                        16
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <button
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                            onclick="selectVo(16, '東北', '福島県（白河市、須賀川市、岩瀬郡、西白河郡）')" id="btn_16_1">
                                            <span class="hidden text-blue-500 text-xs">○</span>
                                        </button>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        福島県（白河市、須賀川市、岩瀬郡、西白河郡）
                                    </td>
                                </tr>

                                {{-- 18 青森県全域 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white font-medium">

                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                                        18
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <button
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                            onclick="selectVo(18, '', '青森県全域')" id="btn_18_1">
                                            <span class="hidden text-blue-500 text-xs">○</span>
                                        </button>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        青森県全域
                                    </td>
                                </tr>

                                {{-- 18 秋田県 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white font-medium">

                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                                        18
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <button
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                            onclick="selectVo(18, '', '秋田県（20m/s地域を除く全域）')" id="btn_18_2">
                                            <span class="hidden text-blue-500 text-xs">○</span>
                                        </button>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        秋田県（20m/s地域を除く全域）
                                    </td>
                                </tr>

                                {{-- 18 岩手県全域 --}}
                                <tr
                                    class="bg-yellow-100 dark:bg-yellow-900/20 hover:bg-yellow-200 dark:hover:bg-yellow-900/30">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white font-medium">

                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                                        18
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <button
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 bg-blue-500 hover:bg-blue-600 transition-colors"
                                            onclick="selectVo(18, '', '岩手県全域')" id="btn_18_3">
                                            <span class="text-white text-xs">○</span>
                                        </button>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        岩手県全域
                                    </td>
                                </tr>

                                {{-- その他の行も同様に追加 --}}
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white font-medium">

                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                                        18
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <button
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                            onclick="selectVo(18, '', '山形県（酒田市、鶴岡市、飽海郡、東田川郡、西田川郡）')" id="btn_18_4">
                                            <span class="hidden text-blue-500 text-xs">○</span>
                                        </button>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        山形県（酒田市、鶴岡市、飽海郡、東田川郡、西田川郡）
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white font-medium">

                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                                        18
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <button
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                            onclick="selectVo(18, '', '宮城県全域')" id="btn_18_5">
                                            <span class="hidden text-blue-500 text-xs">○</span>
                                        </button>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        宮城県全域
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white font-medium">

                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                                        20
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <button
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                            onclick="selectVo(20, '', '秋田県（秋田市、本庄市、由利郡）')" id="btn_20_1">
                                            <span class="hidden text-blue-500 text-xs">○</span>
                                        </button>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        秋田県（秋田市、本庄市、由利郡）
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-900 dark:text-white font-medium">

                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center text-sm text-gray-900 dark:text-white">
                                        14
                                    </td>
                                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center">
                                        <button
                                            class="w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors"
                                            onclick="selectVo(14, '', '上記以外')" id="btn_14_1">
                                            <span class="hidden text-blue-500 text-xs">○</span>
                                        </button>
                                    </td>
                                    <td
                                        class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                        上記以外
                                    </td>
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
                <p class="text-xl font-bold text-blue-900 dark:text-blue-100 mt-2">
                    Vo = <span id="selected-vo">-</span> m/s
                </p>
            </div>

            {{-- 保存フォーム（非表示） --}}
            <form id="vo-save-form" action="{{ route('scheck.environment.save') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="Vo" id="input-vo" value="">
            </form>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8 mb-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.index') }}'">
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
        let selectedVo = null;
        let selectedInfo = '';

        function selectVo(vo, region, area) {
            // 全てのボタンをリセット
            document.querySelectorAll('button[id^="btn_"]').forEach(btn => {
                btn.className =
                    'w-8 h-8 rounded-full border-2 border-blue-500 hover:bg-blue-100 dark:hover:bg-blue-900 transition-colors';
                btn.querySelector('span').className = 'hidden text-blue-500 text-xs';
                btn.querySelector('span').textContent = '○';
            });

            // 選択されたボタンをアクティブに
            const selectedBtn = event.target.closest('button');
            selectedBtn.className =
                'w-8 h-8 rounded-full border-2 border-blue-500 bg-blue-500 hover:bg-blue-600 transition-colors';
            selectedBtn.querySelector('span').className = 'text-white text-xs';

            // 選択結果を保存
            selectedVo = vo;
            selectedInfo = region ? `${region} - ${area}` : area;

            // 結果表示を更新
            document.getElementById('selected-vo').textContent = vo;
            document.getElementById('selected-info').textContent = selectedInfo;
            document.getElementById('selection-result').style.display = 'block';

            // 確定ボタンを有効化
            document.getElementById('confirm-btn').disabled = false;
        }

        function confirmSelection() {
            if (selectedVo) {
                // フォームに値をセットして送信（保存後にサーバでリダイレクト）
                document.getElementById('input-vo').value = selectedVo;
                document.getElementById('vo-save-form').submit();
            }
        }
    </script>
</x-layouts.app>
