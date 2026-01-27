<x-app-layout>
    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-800">
            {{ $errors->first() }}
        </div>
    @endif
    <!-- Hero Section - Super Readable -->
    <div class="relative min-h-screen bg-cover bg-center"
        style="background-image: url('https://images.unsplash.com/photo-1570545906975-08a05d3852da?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <!-- Overlay lebih gelap biar teks 100% kebaca -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/80 to-black/90"></div>

        <!-- Hero Content -->
        <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-6 text-center text-white">
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold tracking-tight mb-6 drop-shadow-2xl">
                SEWA ALAT BERAT <span class="text-yellow-400">TERPERCAYA</span>
            </h1>
            <p class="text-xl md:text-3xl lg:text-4xl font-semibold max-w-4xl mb-12 drop-shadow-lg">
                Dump Truck • Excavator • Unit Terbaru • Harga Bersaing • Siap Kerja 24 Jam di Proyek Anda
            </p>

            <div class="flex flex-col sm:flex-row gap-6">
                <a href="#alat"
                    class="inline-block bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-bold text-xl md:text-2xl px-10 md:px-16 py-5 md:py-6 rounded-full transition transform hover:scale-105 shadow-2xl">
                    LIHAT DAFTAR ALAT
                </a>
                <a href="#hubungi"
                    class="inline-block bg-transparent border-2 border-yellow-400 text-yellow-400 hover:bg-yellow-400 hover:text-gray-900 font-bold text-xl md:text-2xl px-10 md:px-16 py-5 md:py-6 rounded-full transition transform hover:scale-105">
                    HUBUNGI KAMI
                </a>
            </div>
        </div>
    </div>

    {{-- carousel mode --}}
    <div class="relative min-h-screen">
        <div class="swiper hero-swiper h-screen">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide relative">
                    <img src="https://images.unsplash.com/photo-1523660778745-247ed0bcce31?auto=format&fit=crop&w=1920&q=80"
                        class="w-full h-full object-cover" alt="Dump Truck">
                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                        <div class="text-center text-white px-6">
                            <h1 class="text-5xl md:text-7xl font-extrabold mb-6">SEWA DUMP TRUCK</h1>
                            <p class="text-2xl md:text-4xl">Kapasitas Besar • Harga Bersaing</p>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide relative">
                    <img src="https://images.unsplash.com/photo-1649807533255-bbc9c9fb7d77?auto=format&fit=crop&w=1920&q=80"
                        class="w-full h-full object-cover" alt="Excavator">
                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                        <div class="text-center text-white px-6">
                            <h1 class="text-5xl md:text-7xl font-extrabold mb-6">EXCAVATOR SIAP</h1>
                            <p class="text-2xl md:text-4xl">Unit Terbaru • Operator Profesional</p>
                        </div>
                    </div>
                </div>

                <!-- Tambah slide lain sesuai kebutuhan -->
            </div>
            <!-- Navigation -->
            <div class="swiper-button-next text-white"></div>
            <div class="swiper-button-prev text-white"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Daftar Alat Section -->
    <section id="alat" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Koleksi Alat Berat Terbaik
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Pilih unit yang sesuai kebutuhan proyek Anda. Semua alat terawat, siap operasi, dan harga
                    transparan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($alats as $alat)
                    <div
                        class="group bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4">
                        <!-- Foto + Badge -->
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ $alat->foto ? asset('storage/' . $alat->foto) : 'https://via.placeholder.com/600x400?text=' . $alat->merk }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                alt="{{ $alat->merk }}">

                            <!-- Badge Status -->
                            <div class="absolute top-4 right-4">
                                <span
                                    class="inline-flex items-center px-5 py-2 rounded-full text-sm font-bold bg-green-600 text-white shadow-lg">
                                    Tersedia
                                </span>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="p-8">
                            <h3 class="text-3xl font-bold text-gray-900 mb-2">
                                {{ $alat->merk }}
                            </h3>
                            <p class="text-gray-600 mb-4">
                                {{ ucwords(str_replace('_', ' ', $alat->tipe)) }} • {{ $alat->tahun }} •
                                {{ $alat->kapasitas }} ton
                            </p>
                            <div class="text-4xl font-extrabold text-yellow-600 mb-6">
                                Rp {{ number_format($alat->harga_sewa) }} <span class="text-xl font-normal">/
                                    hari</span>
                            </div>
                            <a href="{{ route('sewa.form', $alat) }}"
                                class="block w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-lg py-4 rounded-xl text-center transition transform hover:scale-105 shadow-md">
                                SEWA SEKARANG
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20 text-gray-600 text-2xl">
                        Belum ada alat yang tersedia saat ini.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="bg-gradient-to-r from-yellow-500 to-orange-600 py-20 text-white text-center">
        <div class="max-w-4xl mx-auto px-4">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Siap Kerja di Proyek Anda?
            </h2>
            <p class="text-xl md:text-2xl mb-10">
                Konsultasi gratis • Penawaran terbaik • Pelayanan 24 jam
            </p>
            <a href="#hubungi"
                class="inline-block bg-white text-yellow-600 font-bold text-xl md:text-2xl px-12 md:px-16 py-5 md:py-6 rounded-full shadow-2xl hover:bg-gray-100 transition transform hover:scale-105">
                HUBUNGI KAMI SEKARANG
            </a>
        </div>
    </section>

    <!-- Footer layout -->
    
</x-app-layout>

<style>
    .animate-fade-in-down {
        animation: fadeInDown 1s ease-out forwards;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>