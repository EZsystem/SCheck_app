<x-layouts.app title="入力値確認">
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
                        onclick="window.location.href='{{ route('scheck.allowable-stress') }}'">
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

                    {{-- 環境設定 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Vo: 基本風速</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.environment') }}'">
                                変更
                            </button>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            Vo = {{ $param->Vo ?? '-' }} m/s
                        </p>
                    </div>

                    {{-- S係数 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">S: 地上又における瞬間風速分布係数</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.s-coefficient') }}'">
                                変更
                            </button>
                        </div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm space-y-1">
                            <p>S10 = {{ $param->S10 ?? '-' }}</p>
                            <p>S20 = {{ $param->S20 ?? '-' }}</p>
                            <p>S35 = {{ $param->S35 ?? '-' }}</p>
                            <p>S40 = {{ $param->S40 ?? '-' }}</p>
                            <p>S50 = {{ $param->S50 ?? '-' }}</p>
                            <p>S55 = {{ $param->S55 ?? '-' }}</p>
                            <p>S70 = {{ $param->S70 ?? '-' }}</p>
                            <p>S100 = {{ $param->S100 ?? '-' }}</p>
                        </div>
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
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            Ke = {{ $param->Ke ?? '-' }}
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
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            EB = {{ $param->EB ?? '-' }}
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
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            Eg = {{ $param->Eg ?? '-' }}
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
                        <div class="text-gray-600 dark:text-gray-400 text-sm space-y-1">
                            <p>φ (phi) = {{ $param->phi ?? '-' }}</p>
                            <p>Co = {{ $param->Co ?? '-' }}</p>
                        </div>
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
                        <div class="text-gray-600 dark:text-gray-400 text-sm space-y-1">
                            <p>壁繋ぎ許容応力 = {{ $param->wall_tie_stress ?? '-' }} kN</p>
                            <p>壁繋ぎ許容割増値 (War) = {{ $param->War ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- 現場パラメータ --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">現場パラメータ</h2>

                    {{-- R値計算結果 --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">R: 足場の形状、シート及びネット</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.site') }}'">
                                変更
                            </button>
                        </div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm space-y-2">
                            <div class="border-l-4 border-green-500 pl-3">
                                <p class="font-medium text-green-700 dark:text-green-400">地上から建つ場合</p>
                                <p>長さ (Lg) = {{ $param->Lg ?? '-' }} m</p>
                                <p>幅 (Bg) = {{ $param->Bg ?? '-' }} m</p>
                                @if ($param && $param->Lg && $param->Bg)
                                    @php
                                        $ratio_LB = $param->Lg / $param->Bg;
                                        $rGround =
                                            round((0.5813 + 0.013 * $ratio_LB - 0.0001 * pow($ratio_LB, 2)) * 10) / 10;
                                    @endphp
                                    <p class="font-medium">R値 = {{ number_format($rGround, 1) }}</p>
                                @endif
                            </div>
                            <div class="border-l-4 border-blue-500 pl-3">
                                <p class="font-medium text-blue-700 dark:text-blue-400">空中にある場合</p>
                                <p>幅 (Ba) = {{ $param->Ba ?? '-' }} m</p>
                                <p>高さ (Ha) = {{ $param->Ha ?? '-' }} m</p>
                                @if ($param && $param->Ba && $param->Ha)
                                    @php
                                        $ratio_H2B = ($param->Ha * 2) / $param->Ba;
                                        $rAerial =
                                            round((0.5813 + 0.013 * $ratio_H2B - 0.001 * pow($ratio_H2B, 2)) * 10) / 10;
                                    @endphp
                                    <p class="font-medium">R値 = {{ number_format($rAerial, 1) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- 風圧力計算パラメータ --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">風圧力計算パラメータ</h3>
                            <button class="text-blue-600 hover:text-blue-800 text-sm"
                                onclick="window.location.href='{{ route('scheck.input-parameters') }}'">
                                変更
                            </button>
                        </div>
                        <div class="text-gray-600 dark:text-gray-400 text-sm space-y-2">
                            @php
                                $heightRanges = [
                                    ['0～10m', 'L010', 'H010', 'A010'],
                                    ['10～20m', 'L1020', 'H1020', 'A1020'],
                                    ['20～35m', 'L2035', 'H2035', 'A2035'],
                                    ['35～40m', 'L3540', 'H3540', 'A3540'],
                                    ['40～50m', 'L4050', 'H4050', 'A4050'],
                                    ['50～55m', 'L5055', 'H5055', 'A5055'],
                                    ['55～70m', 'L5570', 'H5570', 'A5570'],
                                    ['70～100m', 'L70100', 'H70100', 'A70100'],
                                ];
                            @endphp
                            @foreach ($heightRanges as $range)
                                @if ($param && ($param->{$range[1]} || $param->{$range[2]}))
                                    <div class="border-l-2 border-gray-300 pl-2 mb-2">
                                        <p class="font-medium">{{ $range[0] }}</p>
                                        <p>幅: {{ $param->{$range[1]} ?? '-' }} m, 高さ: {{ $param->{$range[2]} ?? '-' }}
                                            m</p>
                                        @if ($param->{$range[3]})
                                            <p>面積: {{ $param->{$range[3]} }} m²</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- ボタン群 --}}
            <div class="flex justify-between mt-8 mb-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.allowable-stress') }}'">
                    許容応力に戻る
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
                                onclick="window.location.href='{{ route('scheck.environment') }}'">
                                Vo: 基本風速
                            </button>
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
                                onclick="window.location.href='{{ route('scheck.site') }}'">
                                現場パラメータ入力
                            </button>
                            <button
                                class="w-full text-left px-4 py-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded"
                                onclick="window.location.href='{{ route('scheck.input-parameters') }}'">
                                風圧力計算パラメータ
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
        function showQuickNavigation() {
            document.getElementById('quick-nav-modal').classList.remove('hidden');
        }

        function hideQuickNavigation() {
            document.getElementById('quick-nav-modal').classList.add('hidden');
        }

        function executeCalculation() {
            if (confirm('計算を実行しますか？')) {
                // フォームを作成してPOSTリクエストを送信
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('scheck.calculate') }}';

                // CSRFトークンを追加
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);

                document.body.appendChild(form);
                form.submit();
            }
        }

        // ESCキーでモーダルを閉じる
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                hideQuickNavigation();
            }
        });
    </script>
</x-layouts.app>
