<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa {{ $alat->merk }}</title> @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="grid md:grid-cols-3 gap-8"> <!-- dari cols-2 jadi cols-3 --> <!-- Kolom FOTO lebih kecil -->
        <div class="md:col-span-1"> <!-- kolom foto cuma 1/3 --> <img
                src="{{ $alat->foto ? asset('storage/' . $alat->foto) : 'https://via.placeholder.com/600x400?text=' . $alat->merk }}"
                class="w-full h-64 md:h-80 object-cover rounded-xl shadow-lg">
            <div class="mt-6 text-center">
                <p class="text-4xl font-bold text-yellow-600"> Rp {{ number_format($alat->harga_sewa) }} <span
                        class="text-lg font-normal text-gray-600">/ hari</span> </p>
            </div>
        </div> <!-- FORM -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <h2 class="text-2xl font-bold mb-6">Form Pemesanan</h2>
            <form action="{{ route('pesan.store') }}" method="POST" id="formSewa"> @csrf <input type="hidden"
                    name="alat_id" value="{{ $alat->id }}">
                <div class="space-y-5">
                    <div> <label class="block font-medium mb-1">Nama Lengkap</label> <input type="text"
                            name="nama" required
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-yellow-500"
                            placeholder="John Doe"> </div>
                    <div> <label class="block font-medium mb-1">No. HP / WhatsApp</label> <input type="text"
                            name="no_hp" required
                            class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-yellow-500"
                            placeholder="081234567890"> </div>
                    <div> <label class="block font-medium mb-1">Tanggal Mulai</label> <input type="date"
                            name="tgl_mulai" id="mulai" required min="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 border rounded-lg"> </div>
                    <div> <label class="block font-medium mb-1">Tanggal Selesai</label> <input type="date"
                            name="tgl_sewa" id="selesai" required class="w-full px-4 py-3 border rounded-lg"> </div>
                    <div class="p-5 bg-yellow-50 rounded-lg text-center">
                        <p class="text-3xl font-bold text-yellow-700" id="total">Rp 0</p>
                        <p class="text-sm text-gray-600 mt-2" id="info"></p>
                    </div> <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-xl py-4 rounded-lg transition">
                        PESAN SEKARANG </button>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center mt-8"> <a href="/" class="text-gray-600 hover:underline">← Kembali ke Beranda</a>
    </div>
    </div>
    <script>
        const harga = {{ $alat->harga_sewa }};
        document.getElementById('mulai').addEventListener('change', hitung);
        document.getElementById('selesai').addEventListener('change', hitung);

        function hitung() {
            const mulai = new Date(document.getElementById('mulai').value);
            const selesai = new Date(document.getElementById('selesai').value);
            if (!mulai || !selesai) return;
            const hari = Math.ceil((selesai - mulai) / (1000 * 60 * 60 * 24)) + 1;
            if (hari > 0) {
                const total = hari * harga;
                document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');
                document.getElementById('info').textContent = hari + ' hari × Rp ' + harga.toLocaleString('id-ID');
            }
        }
    </script>
</body>

</html>
