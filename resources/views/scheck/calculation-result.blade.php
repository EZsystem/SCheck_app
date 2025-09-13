<x-layouts.app title="計算結果">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
        <div class="max-w-6xl mx-auto pb-16">
            {{-- ヘッダー --}}
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <button
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        onclick="window.location.href='{{ route('scheck.input-confirmation') }}'">
                        ← 確認画面に戻る
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        計算結果
                    </h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400">
                    Vzシリーズ、QzNシリーズの計算結果を表示しています。
                </p>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-green-100 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                    <p class="text-green-700 dark:text-green-400">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Vz系列計算結果 --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Vz系列計算結果</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        計算式: Vz = Vo × Ke × S × EB × Eg
                    </p>

                    <div class="space-y-3">
                        @php
                            $heightRanges = [
                                ['10', '0～10m'],
                                ['20', '10～20m'],
                                ['35', '20～35m'],
                                ['40', '35～40m'],
                                ['50', '40～50m'],
                                ['55', '50～55m'],
                                ['70', '55～70m'],
                                ['100', '70～100m'],
                            ];
                        @endphp

                        @foreach ($heightRanges as [$height, $label])
                            @php $vzKey = "Vz{$height}"; @endphp
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                <span class="font-medium text-gray-900 dark:text-white">{{ $label }}</span>
                                <span class="text-lg font-bold text-blue-600 dark:text-blue-400">
                                    Vz{{ $height }} = {{ $param->{$vzKey} ?? '-' }}
                                    @if ($param->{$vzKey})
                                        m/s
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- QzN系列計算結果 --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">QzN系列計算結果</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        計算式: Qz = 5/8 × Vz²
                    </p>

                    <div class="space-y-3">
                        @foreach ($heightRanges as [$height, $label])
                            @php $qzKey = "QzN{$height}"; @endphp
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                <span class="font-medium text-gray-900 dark:text-white">{{ $label }}</span>
                                <span class="text-lg font-bold text-green-600 dark:text-green-400">
                                    QzN{{ $height }} = {{ $param->{$qzKey} ?? '-' }}
                                    @if ($param->{$qzKey})
                                        kN/m²
                                    @endif
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Fbtm・Ftop計算結果 --}}
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Fbtm・Ftop計算結果</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Fbtm (底部)</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                            計算式: Fbtm = (1.0 + 0.31 × φ)
                        </p>
                        <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">
                            {{ $param->Fbtm ?? '-' }}
                            @if ($param->Fbtm)
                                <span class="text-sm font-normal">係数</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Ftop (頂部)</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                            計算式: Ftop = 1
                        </p>
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                            {{ $param->Ftop ?? '-' }}
                            @if ($param->Ftop)
                                <span class="text-sm font-normal">係数</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- C1・C2・R値計算結果 --}}
            <div class="mt-6 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">C1・C2・R値計算結果</h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {{-- R値表示 --}}
                    <div class="space-y-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white">R値（足場の形状係数）</h3>

                        @if ($param->Rg)
                            <div
                                class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                                <h4 class="font-medium text-green-700 dark:text-green-400 mb-2">地上から建つ場合</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                                    計算式: R = 0.5813 + 0.013 × (Lg/Bg) - 0.0001 × (Lg/Bg)²
                                </p>
                                <div class="text-xl font-bold text-green-600 dark:text-green-400">
                                    Rg = {{ $param->Rg }}
                                </div>
                            </div>
                        @endif

                        @if ($param->Ra)
                            <div
                                class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                                <h4 class="font-medium text-blue-700 dark:text-blue-400 mb-2">空中にある場合</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                                    計算式: R = 0.5813 + 0.013 × (2Ha/Ba) - 0.001 × (2Ha/Ba)²
                                </p>
                                <div class="text-xl font-bold text-blue-600 dark:text-blue-400">
                                    Ra = {{ $param->Ra }}
                                </div>
                            </div>
                        @endif

                        @if (!$param->Rg && !$param->Ra)
                            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <p class="text-gray-500 dark:text-gray-400">R値の計算に必要なパラメータが不足しています</p>
                            </div>
                        @endif
                    </div>

                    {{-- C1・C2表示 --}}
                    <div class="space-y-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white">C1・C2係数</h3>
                        <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                            <p>C1 = (0.11 + 0.09 × r + 0.945 × Co × R) × Fbtm</p>
                            <p>C2 = (0.11 + 0.09 × r + 0.945 × Co × R) × Ftop</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">C1</h4>
                                <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                                    {{ $param->C1 ?? '-' }}
                                    @if ($param->C1)
                                        <span class="text-sm font-normal">係数</span>
                                    @endif
                                </div>
                            </div>

                            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <h4 class="font-medium text-gray-900 dark:text-white mb-2">C2</h4>
                                <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                                    {{ $param->C2 ?? '-' }}
                                    @if ($param->C2)
                                        <span class="text-sm font-normal">係数</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if (!$param->C1 || !$param->C2)
                            <div
                                class="p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded">
                                <p class="text-yellow-700 dark:text-yellow-400 text-sm">
                                    C1・C2の計算にはR値、Co値、Fbtm、Ftopが必要です
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- 計算に使用された係数一覧 --}}
            <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">計算に使用された係数</h2>

                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-sm">
                    <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <div class="font-semibold text-gray-900 dark:text-white">Vo</div>
                        <div class="text-lg text-blue-600 dark:text-blue-400">{{ $param->Vo ?? '-' }}</div>
                        <div class="text-xs text-gray-500">m/s</div>
                    </div>
                    <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <div class="font-semibold text-gray-900 dark:text-white">Ke</div>
                        <div class="text-lg text-blue-600 dark:text-blue-400">{{ $param->Ke ?? '-' }}</div>
                        <div class="text-xs text-gray-500">係数</div>
                    </div>
                    <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <div class="font-semibold text-gray-900 dark:text-white">EB</div>
                        <div class="text-lg text-blue-600 dark:text-blue-400">{{ $param->EB ?? '-' }}</div>
                        <div class="text-xs text-gray-500">係数</div>
                    </div>
                    <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <div class="font-semibold text-gray-900 dark:text-white">Eg</div>
                        <div class="text-lg text-blue-600 dark:text-blue-400">{{ $param->Eg ?? '-' }}</div>
                        <div class="text-xs text-gray-500">係数</div>
                    </div>
                    <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <div class="font-semibold text-gray-900 dark:text-white">φ (phi)</div>
                        <div class="text-lg text-blue-600 dark:text-blue-400">{{ $param->phi ?? '-' }}</div>
                        <div class="text-xs text-gray-500">係数</div>
                    </div>
                    <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                        <div class="font-semibold text-gray-900 dark:text-white">Co</div>
                        <div class="text-lg text-blue-600 dark:text-blue-400">{{ $param->Co ?? '-' }}</div>
                        <div class="text-xs text-gray-500">係数</div>
                    </div>
                </div>

                <div class="mt-4 text-center p-3 bg-gray-50 dark:bg-gray-700 rounded">
                    <div class="font-semibold text-gray-900 dark:text-white">S係数</div>
                    <div class="text-xs text-gray-500">高さ別設定済み（S10〜S100）</div>
                </div>
            </div>

            {{-- アクションボタン --}}
            <div class="flex justify-between mt-8">
                <button
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                    onclick="window.location.href='{{ route('scheck.input-confirmation') }}'">
                    ← 確認画面に戻る
                </button>

                <div class="flex space-x-4">
                    <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors"
                        onclick="window.print()">
                        印刷
                    </button>

                    <button class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors"
                        onclick="window.location.href='{{ route('scheck.index') }}'">
                        新しい計算を開始
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
