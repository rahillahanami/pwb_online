<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pendaftaran Mahasiswa Baru
        </h2>
    </x-slot>

    <div class="py-6 px-6 max-w-4xl mx-auto bg-white shadow rounded">
        <form action="{{ route('mahasiswa.registration.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nama Lengkap --}}
            <div class="mb-4">
                <label class="block font-semibold">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="mt-1 w-full border rounded px-3 py-2" required>
            </div>

            {{-- Alamat KTP --}}
            <div class="mb-4">
                <label class="block font-semibold">Alamat KTP</label>
                <textarea name="alamat_ktp" class="w-full border rounded px-3 py-2" required></textarea>
            </div>

            {{-- Alamat Sekarang --}}
            <div class="mb-4">
                <label class="block font-semibold">Alamat Sekarang</label>
                <textarea name="alamat_sekarang" class="w-full border rounded px-3 py-2" required></textarea>
            </div>

            {{-- Kecamatan --}}
            <div class="mb-4">
                <label class="block font-semibold">Kecamatan</label>
                <input type="text" name="kecamatan" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Provinsi & Kabupaten --}}
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Provinsi</label>
                    <select name="provinsi_id" class="w-full border rounded px-3 py-2" required>
                        @foreach ($provinsis as $provinsi)
                            <option value="{{ $provinsi['id'] }}">{{ $provinsi['nama'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold">Kabupaten</label>
                    <select name="kabupaten_id" class="w-full border rounded px-3 py-2" required>
                        @foreach ($kabupatens as $kabupaten)
                            <option value="{{ $kabupaten['id'] }}">{{ $kabupaten['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Telepon, HP, Email --}}
            <div class="mb-4 grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-semibold">Telepon</label>
                    <input type="text" name="telepon" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold">Nomor HP</label>
                    <input type="text" name="no_hp" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
                </div>
            </div>

            {{-- Kewarganegaraan --}}
            <div class="mb-4">
                <label class="block font-semibold">Kewarganegaraan</label>
                <select name="kewarganegaraan" class="w-full border rounded px-3 py-2" required>
                    <option value="WNI Asli">WNI Asli</option>
                    <option value="WNI Keturunan">WNI Keturunan</option>
                    <option value="WNA">WNA</option>
                </select>
                <input type="text" name="kewarganegaraan_negara" placeholder="Isi jika WNA"
                    class="w-full mt-2 border rounded px-3 py-2">
            </div>

            {{-- Tempat, Tanggal Lahir --}}
            <div class="mb-4">
                <label class="block font-semibold">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4 grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-semibold">Kota/Kabupaten Lahir</label>
                    <input type="text" name="kota_lahir" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold">Provinsi Lahir</label>
                    <select name="provinsi_lahir_id" class="w-full border rounded px-3 py-2" required>
                        @foreach ($provinsis as $provinsi)
                            <option value="{{ $provinsi['id'] }}">{{ $provinsi['nama'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold">Negara (jika luar negeri)</label>
                    <input type="text" name="negara_lahir" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Jenis Kelamin, Status Menikah, Agama --}}
            <div class="mb-4 grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border rounded px-3 py-2" required>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold">Status Menikah</label>
                    <select name="status_menikah" class="w-full border rounded px-3 py-2" required>
                        <option value="Belum menikah">Belum menikah</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold">Agama</label>
                    <select name="agama" class="w-full border rounded px-3 py-2" required>
                        <option value="Islam">Islam</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Upload Foto</label>
                    <input type="file" name="foto" accept="image/*" class="w-full mt-1">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Upload Video</label>
                    <input type="file" name="video" accept="video/*" class="w-full mt-1">
                </div>
            </div>

            {{-- Submit --}}
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan Pendaftaran
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
