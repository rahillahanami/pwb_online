<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Mahasiswa
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <p>Halo, <strong>{{ Auth::user()->name }}</strong>! Kamu login sebagai <strong>Mahasiswa</strong>.</p>
    </div>
    <div class="py-6 px-6 max-w-4xl mx-auto bg-white shadow rounded">
        <p>Silakan lengkapi pendaftaran kamu di bawah ini:</p>
        <a href="{{ route('mahasiswa.registration.create') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Pendaftaran Mahasiswa Baru
        </a>
</x-app-layout>
