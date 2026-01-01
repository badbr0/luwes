<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Alat Berat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

<div class="container mx-auto px-4 py-12">
    <h1 class="text-5xl font-bold text-center mb-4 text-gray-800">
        SEWA ALAT BERAT
    </h1>
    <p class="text-center text-gray-600 mb-12">Dump Truck • Excavator • Terpercaya • Harga Bersaing</p>

    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
        @foreach(\App\Models\Alat::all() as $alat)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-1">
                <img src="{{ $alat->foto ? asset('storage/'.$alat->foto) : 'https://via.placeholder.com/400x250/4B5565/FFFFFF?text='.$alat->merk }}" 
                     alt="{{ $alat->merk }}" class="w-full h-56 object-cover">

                <div class="p-6">
                    <div class="flex justify-between items-center mb-3">
                        <span class="px-4 py-1 rounded-full text-xs font-bold
                            {{ $alat->tipe == 'dump_truck' ? 'bg-orange-100 text-orange-700' : 'bg-indigo-100 text-indigo-700' }}">
                            {{ strtoupper(str_replace('_', ' ', $alat->tipe)) }}
                        </span>
                        <span class="text-green-600 font-bold text-sm">{{ ucfirst($alat->status) }}</span>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800">{{ $alat->merk }}</h3>
                    <p class="text-gray-600">Tahun {{ $alat->tahun }} • {{ $alat->kapasitas }} ton</p>

                    <p class="text-3xl font-bold text-yellow-600 mt-4">
                        Rp {{ number_format($alat->harga_sewa) }}
                        <span class="text-sm font-normal text-gray-600">/ hari</span>
                    </p>

                    <a href="/sewa/{{ $alat->id }}" 
                       class="block mt-5 text-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-lg transition">
                       SEWA SEKARANG
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    @if(\App\Models\Alat::count() == 0)
        <div class="text-center py-20">
            <p class="text-xl text-gray-500">Belum ada alat tersedia.</p>
        </div>
    @endif
</div>

</body>
</html>