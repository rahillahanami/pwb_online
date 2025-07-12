<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <p>Halo, <strong>{{ Auth::user()->name }}</strong>! Kamu login sebagai <strong>Admin</strong>.</p>
    </div>
</x-app-layout>
