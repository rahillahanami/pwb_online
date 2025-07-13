<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Daftar Pendaftar Mahasiswa
        </h2>
    </x-slot>

    <br><br>
    <div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">

        @if (session('success'))
            <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.pendaftaran.export') }}"
            class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            📥 Export Excel
        </a>

        <table class="w-full table-auto border border-gray-300 shadow-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">No HP</th>
                    <th class="p-2 border">Tanggal Lahir</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendaftar as $index => $data)
                    <tr class="text-sm">
                        <td class="p-2 border">{{ $index + 1 }}</td>
                        <td class="p-2 border">{{ $data->nama_lengkap }}</td>
                        <td class="p-2 border">{{ $data->email }}</td>
                        <td class="p-2 border">{{ $data->no_hp }}</td>
                        <td class="p-2 border">{{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</td>
                        <td class="p-2 border">
                            <form action="{{ route('admin.pendaftaran.delete', $data->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                                <a href="{{ route('admin.pendaftaran.edit', $data->id) }}"
                                    class="text-blue-600 hover:underline mr-2">Edit</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
