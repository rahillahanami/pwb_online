<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Dashboard Admin</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 bg-white p-6 rounded shadow space-y-6">

        <p class="text-gray-700">Selamat datang, <strong>{{ Auth::user()->name }}</strong>. Silakan pilih menu:</p>

        <div class="space-y-4">
            <a href="{{ route('admin.users') }}"
                class="block w-full bg-blue-600 text-white text-center py-3 rounded hover:bg-blue-700 transition">
                👥 Daftar Pengguna
            </a>

            <a href="{{ route('admin.pendaftaran') }}"
                class="block w-full bg-green-600 text-white text-center py-3 rounded hover:bg-green-700 transition">
                🎓 Daftar Pendaftar Mahasiswa
            </a>
        </div>
    </div>
</x-app-layout>
