<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-8">Daftar Pesanan Masuk</h1>

                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-800">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-800">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <form method="GET" action="{{ route('admin.pesanan.index') }}" class="mb-6 flex gap-4">
                        <select name="status" class="border rounded px-4 py-2">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="diterima" {{ request('status') === 'diterima' ? 'selected' : '' }}>Diterima
                            </option>
                            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>

                        <button type="submit" class="bg-blue-100 text-black px-4 py-2 rounded">
                            Search
                        </button>
                    </form>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Sewa
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Biaya
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($pesanans as $pesanan)
                                <tr class="hover:bg-gray-50 transition">
                                    {{-- No --}}
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $pesanans->firstItem() + $loop->index }}
                                    </td>

                                    {{-- Customer --}}
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">
                                            {{ $pesanan->nama_penyewa }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $pesanan->no_hp }}
                                        </div>
                                    </td>

                                    {{-- Alat --}}
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <div class="font-medium">
                                            {{ $pesanan->alat->merk }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ ucwords(str_replace('_', ' ', $pesanan->alat->tipe)) }}
                                        </div>
                                    </td>

                                    {{-- Tanggal --}}
                                    <td class="px-6 py-4 text-sm">
                                        <div class="text-gray-900">
                                            {{ $pesanan->tgl_mulai->format('d/m/Y') }}
                                            –
                                            {{ $pesanan->tgl_selesai->format('d/m/Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $pesanan->total_hari }} hari
                                        </div>
                                    </td>

                                    {{-- Total Biaya --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-bold text-gray-900 text-sm">
                                            Rp {{ number_format($pesanan->total_biaya) }}
                                        </div>
                                        {{-- badge pr --}}
                                        @if ($pesanan->status === 'pending' && $pesanan->is_high_value)
                                            <span title="Durasi ≥ 7 hari atau Total ≥ 50 juta"
                                                class="mt-1 inline-flex items-center gap-1
                       rounded-full bg-blue-600 px-2.5 py-0.5
                       text-[10px] font-bold tracking-wide text-white
                       hover:bg-blue-700 transition
                       cursor-help shadow-sm">
                                                💰 HIGH VALUE
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.pesanan.updateStatus', $pesanan) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <select name="status"
                                                onchange="if(confirm('Ubah status pesanan ini?')) this.form.submit(); else this.selectedIndex = this.defaultSelected;"
                                                class="rounded-full px-3 py-1 text-xs font-semibold focus:outline-none
                {{ match ($pesanan->status) {
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'diterima' => 'bg-blue-100 text-blue-800',
                    'selesai' => 'bg-green-100 text-green-800',
                } }}">
                                                <option value="pending"
                                                    {{ $pesanan->status === 'pending' ? 'selected' : '' }}>Pending
                                                </option>
                                                <option value="diterima"
                                                    {{ $pesanan->status === 'diterima' ? 'selected' : '' }}>Diterima
                                                </option>
                                                <option value="selesai"
                                                    {{ $pesanan->status === 'selesai' ? 'selected' : '' }}>Selesai
                                                </option>
                                            </select>
                                        </form>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4 text-right text-sm">
                                        <a href="{{ route('admin.pesanan.show', $pesanan) }}"
                                            class="font-medium text-indigo-600 hover:text-indigo-900">
                                            Detail →
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-6 text-center text-sm text-gray-500">
                                        Belum ada pesanan masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                    <div class="mt-6">
                        {{ $pesanans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
