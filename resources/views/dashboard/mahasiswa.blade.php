<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Mahasiswa
        </h2>
    </x-slot>
    <div class="flex justify-center mt-8">
        @if (Auth::user()->mahasiswaRegistration)
            <a href="{{ route('mahasiswa.registration.show') }}"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded shadow transition duration-200">
                📄 Lihat Pendaftaran
            </a>
        @else
            <a href="{{ route('mahasiswa.registration.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded shadow transition duration-200">
                📝 Pendaftaran Mahasiswa Baru
            </a>
        @endif
    </div>

</x-app-layout>
