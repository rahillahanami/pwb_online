<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Mahasiswa
        </h2>
    </x-slot>

    <br><br>

    <div class="py-6 px-6 max-w-5xl mx-auto bg-white shadow rounded">

        <p class="mb-4">Halo, <strong>{{ Auth::user()->name }}</strong>! Kamu login sebagai <strong>Mahasiswa</strong>.</p>

        @php
            $data = Auth::user()->mahasiswaRegistration;
        @endphp

        @if ($data)
            {{-- Alert --}}
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 flex items-center gap-4">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 13l4 4L19 7"/>
                </svg>
                <p class="text-sm font-medium">
                    Kamu sudah melakukan pendaftaran. Data kamu ditampilkan di bawah ini.
                </p>
            </div>

            {{-- Preview Section --}}
            <div class="grid md:grid-cols-2 gap-8 items-start">
                {{-- Foto --}}
                <div class="text-center">
                    <h3 class="font-semibold text-gray-700 mb-2">Foto Mahasiswa</h3>
                    @if ($data->foto)
                        <img src="{{ asset('storage/' . $data->foto) }}"
                             alt="Foto Mahasiswa"
                             class="mx-auto w-48 h-48 object-cover border rounded-lg shadow hover:scale-105 transition duration-300">
                    @else
                        <p class="text-gray-400 italic">Belum ada foto.</p>
                    @endif
                </div>

                {{-- Video --}}
                <div class="text-center">
                    <h3 class="font-semibold text-gray-700 mb-2">Video Mahasiswa</h3>
                    @if ($data->video)
                        <video controls class="w-full max-w-md mx-auto border rounded shadow">
                            <source src="{{ asset('storage/' . $data->video) }}" type="video/mp4">
                            Browser tidak mendukung video.
                        </video>
                    @else
                        <p class="text-gray-400 italic">Belum ada video.</p>
                    @endif
                </div>
            </div>

            {{-- Tombol Lihat Detail --}}
            <div class="mt-8 text-center">
                <a href="{{ route('mahasiswa.registration.show') }}"
                   class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    📄 Lihat Detail Pendaftaran
                </a>
            </div>
        @else
            {{-- Belum daftar --}}
            <div class="text-center mt-10">
                <p class="text-gray-600 text-lg mb-4">Kamu belum melakukan pendaftaran.</p>
                <a href="{{ route('mahasiswa.registration.create') }}"
                   class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    📝 Pendaftaran Mahasiswa Baru
                </a>
            </div>
        @endif

    </div>
</x-app-layout>
