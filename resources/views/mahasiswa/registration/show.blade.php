<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Pendaftaran Mahasiswa
        </h2>
    </x-slot>

    <div class="py-6 px-6 max-w-4xl mx-auto bg-white shadow rounded">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            <div>
                <strong>Nama Lengkap:</strong><br>
                {{ $data->nama_lengkap }}
            </div>
            <div>
                <strong>Alamat KTP:</strong><br>
                {{ $data->alamat_ktp }}
            </div>
            <div>
                <strong>Alamat Sekarang:</strong><br>
                {{ $data->alamat_sekarang }}
            </div>
            <div>
                <strong>Kecamatan:</strong><br>
                {{ $data->kecamatan }}
            </div>
            <div>
                <strong>Kabupaten ID:</strong><br>
                {{ $data->kabupaten_id }}
            </div>
            <div>
                <strong>Provinsi ID:</strong><br>
                {{ $data->provinsi_id }}
            </div>
            <div>
                <strong>Telepon:</strong><br>
                {{ $data->telepon }}
            </div>
            <div>
                <strong>Nomor HP:</strong><br>
                {{ $data->no_hp }}
            </div>
            <div>
                <strong>Email:</strong><br>
                {{ $data->email }}
            </div>
            <div>
                <strong>Kewarganegaraan:</strong><br>
                {{ $data->kewarganegaraan }}
                {{ $data->kewarganegaraan_negara ? '(' . $data->kewarganegaraan_negara . ')' : '' }}
            </div>
            <div>
                <strong>Tempat Lahir:</strong><br>
                {{ $data->tempat_lahir }}
            </div>
            <div>
                <strong>Kota/Kab Lahir:</strong><br>
                {{ $data->kota_lahir }}
            </div>
            <div>
                <strong>Provinsi Lahir ID:</strong><br>
                {{ $data->provinsi_lahir_id }}
            </div>
            <div>
                <strong>Negara Lahir:</strong><br>
                {{ $data->negara_lahir }}
            </div>
            <div>
                <strong>Tanggal Lahir:</strong><br>
                {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}
            </div>
            <div>
                <strong>Jenis Kelamin:</strong><br>
                {{ $data->jenis_kelamin }}
            </div>
            <div>
                <strong>Status Menikah:</strong><br>
                {{ $data->status_menikah }}
            </div>
            <div>
                <strong>Agama:</strong><br>
                {{ $data->agama }}
            </div>

            @if ($data->foto)
                <div class="mt-6">
                    <strong>Foto:</strong><br>
                    <img src="{{ asset('storage/' . $data->foto) }}" class="max-w-xs rounded shadow">
                </div>
            @endif


            @if ($data->video)
                <div class="mt-6">
                    <strong>Video:</strong><br>
                    <video controls class="w-full max-w-md">
                        <source src="{{ asset('storage/' . $data->video) }}" type="video/mp4">
                        Browser tidak mendukung video.
                    </video>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
