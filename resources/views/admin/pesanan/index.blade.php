<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-8">Daftar Pesanan Masuk</h1>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Sewa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Biaya</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pesanans as $index => $pesanan)
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium">{{ $pesanan->nama_penyewa }}</div>
                                        <div class="text-sm text-gray-500">{{ $pesanan->no_hp }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm">{{ $pesanan->alat->merk }} ({{ ucwords(str_replace('_', ' ', $pesanan->alat->tipe)) }})</td>
                                    <td class="px-6 py-4 text-sm">
                                        {{ $pesanan->tgl_mulai->format('d/m/Y') }} - {{ $pesanan->tgl_selesai->format('d/m/Y') }}
                                        <br><small class="text-gray-500">{{ $pesanan->total_hari }} hari</small>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold">
                                        Rp {{ number_format($pesanan->total_biaya) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.pesanan.updateStatus', $pesanan) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="px-3 py-1 rounded-full text-xs font-semibold
                                                {{ $pesanan->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $pesanan->status == 'diterima' ? 'bg-blue-100 text-blue-800' : '' }}
                                                {{ $pesanan->status == 'selesai' ? 'bg-green-100 text-green-800' : '' }}">
                                                <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="diterima" {{ $pesanan->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                                <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm">
                                        <a href="{{ route('admin.pesanan.show', $pesanan) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada pesanan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>