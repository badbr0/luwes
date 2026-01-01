<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-8">Detail Pesanan #{{ $pesanan->id }}</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Informasi Customer</h2>
                        <p><strong>Nama:</strong> {{ $pesanan->nama_penyewa }}</p>
                        <p><strong>No. HP:</strong> {{ $pesanan->no_hp }}</p>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Alat yang Disewa</h2>
                        <p><strong>Merk:</strong> {{ $pesanan->alat->merk }}</p>
                        <p><strong>Tipe:</strong> {{ ucwords(str_replace('_', ' ', $pesanan->alat->tipe)) }}</p>
                        <p><strong>Harga / hari:</strong> Rp {{ number_format($pesanan->alat->harga_sewa) }}</p>
                    </div>
                </div>

                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Jadwal & Biaya</h2>
                    <p><strong>Tanggal Mulai:</strong> {{ $pesanan->tgl_mulai->format('d F Y') }}</p>
                    <p><strong>Tanggal Selesai:</strong> {{ $pesanan->tgl_selesai->format('d F Y') }}</p>
                    <p><strong>Durasi:</strong> {{ $pesanan->total_hari }} hari</p>
                    <p class="text-2xl font-bold text-yellow-600 mt-4">
                        Total Biaya: Rp {{ number_format($pesanan->total_biaya) }}
                    </p>
                </div>

                <div class="mt-8">
                    <a href="{{ route('admin.pesanan.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg">
                        ← Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>