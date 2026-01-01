<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-8">Admin Panel - Sewa Alat Berat</h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-100 p-6 rounded-lg text-center">
                        <p class="text-4xl font-bold text-blue-700">{{ \App\Models\Alat::count() }}</p>
                        <p class="text-gray-700">Total Alat</p>
                    </div>
                    <div class="bg-green-100 p-6 rounded-lg text-center">
                        <p class="text-4xl font-bold text-green-700">{{ \App\Models\Pesanan::count() }}</p>
                        <p class="text-gray-700">Total Pesanan</p>
                    </div>
                    <div class="bg-yellow-100 p-6 rounded-lg text-center">
                        <p class="text-4xl font-bold text-yellow-700">{{ \App\Models\Pesanan::where('status','pending')->count() }}</p>
                        <p class="text-gray-700">Pesanan Pending</p>
                    </div>
                </div>

                <a href="{{route('admin.alat.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg">
                    Kelola Alat
                </a>
<br><br>
                <a href="{{ route('admin.pesanan.index') }}" class="bg-yellow-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg">
                    Lihat Pesanan Masuk
                </a>
            </div>
        </div>
    </div>
</x-app-layout>