<x-app-layout>
    <div class="min-h-screen bg-gray-100">
        <!-- HERO SECTION -->
        <div class="text-center py-12">
            <h1 class="text-5xl font-bold text-gray-800 mb-4">SEWA ALAT BERAT</h1>
            <p class="text-xl text-gray-600">Dump Truck • Excavator • Terpercaya • Harga Bersaing</p>
        </div>

        <!-- NOTIF SUCCESS -->
        @if(session('success'))
            <div class="max-w-4xl mx-auto mb-8 px-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg text-center text-lg font-semibold">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- GRID ALAT -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($alats as $alat)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2">
                        <img src="{{ $alat->foto ? asset('storage/'.$alat->foto) : 'https://via.placeholder.com/600x400?text='.$alat->merk }}"
                             class="w-full h-64 object-cover">

                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <span class="px-4 py-1 rounded-full text-xs font-bold
                                    {{ $alat->tipe == 'dump_truck' ? 'bg-orange-100 text-orange-700' : 'bg-indigo-100 text-indigo-700' }}">
                                    {{ strtoupper(str_replace('_', ' ', $alat->tipe)) }}
                                </span>
                                <span class="text-green-600 font-bold text-sm">{{ ucfirst($alat->status) }}</span>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $alat->merk }}</h3>
                            <p class="text-gray-600 mb-4">
                                Tahun {{ $alat->tahun }} • {{ $alat->kapasitas }} ton
                            </p>

                            <p class="text-3xl font-bold text-yellow-600 mb-6">
                                Rp {{ number_format($alat->harga_sewa) }}
                                <span class="text-lg font-normal text-gray-600">/ hari</span>
                            </p>

                            <a href="{{ route('sewa.form', $alat) }}"
                               class="block text-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-lg transition">
                                SEWA SEKARANG
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>