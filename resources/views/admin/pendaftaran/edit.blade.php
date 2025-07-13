<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Edit Data Pendaftaran Mahasiswa
        </h2>
    </x-slot>

    <br><br>

    <div class="py-6 px-6 max-w-4xl mx-auto bg-white shadow rounded">
        <form action="{{ route('admin.pendaftaran.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama Lengkap --}}
            <div class="mb-4">
                <label class="block font-semibold">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $data->nama_lengkap) }}" class="mt-1 w-full border rounded px-3 py-2" required>
            </div>

            {{-- Alamat KTP --}}
            <div class="mb-4">
                <label class="block font-semibold">Alamat KTP</label>
                <textarea name="alamat_ktp" class="w-full border rounded px-3 py-2" required>{{ old('alamat_ktp', $data->alamat_ktp) }}</textarea>
            </div>

            {{-- Alamat Sekarang --}}
            <div class="mb-4">
                <label class="block font-semibold">Alamat Sekarang</label>
                <textarea name="alamat_sekarang" class="w-full border rounded px-3 py-2" required>{{ old('alamat_sekarang', $data->alamat_sekarang) }}</textarea>
            </div>

            {{-- Kecamatan --}}
            <div class="mb-4">
                <label class="block font-semibold">Kecamatan</label>
                <input type="text" name="kecamatan" value="{{ old('kecamatan', $data->kecamatan) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Provinsi & Kabupaten --}}
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Provinsi</label>
                    <select name="provinsi_id" id="provinsi" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinsis as $prov)
                            <option value="{{ $prov->id }}" {{ $prov->id == $data->provinsi_id ? 'selected' : '' }}>
                                {{ $prov->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold">Kabupaten</label>
                    <select name="kabupaten_id" id="kabupaten" class="w-full border rounded px-3 py-2" required>
                        <option value="{{ $data->kabupaten_id }}">{{ optional($data->kabupaten)->nama ?? 'Pilih Kabupaten' }}</option>
                    </select>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="mb-4 grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-semibold">Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $data->telepon) }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-semibold">Nomor HP</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $data->no_hp) }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email', $data->email) }}" class="w-full border rounded px-3 py-2" required>
                </div>
            </div>

            {{-- Kewarganegaraan --}}
            <div class="mb-4">
                <label class="block font-semibold">Kewarganegaraan</label>
                <select name="kewarganegaraan" class="w-full border rounded px-3 py-2" required>
                    <option value="WNI Asli" {{ $data->kewarganegaraan == 'WNI Asli' ? 'selected' : '' }}>WNI Asli</option>
                    <option value="WNI Keturunan" {{ $data->kewarganegaraan == 'WNI Keturunan' ? 'selected' : '' }}>WNI Keturunan</option>
                    <option value="WNA" {{ $data->kewarganegaraan == 'WNA' ? 'selected' : '' }}>WNA</option>
                </select>
                <input type="text" name="kewarganegaraan_negara" placeholder="Isi jika WNA"
                    class="w-full mt-2 border rounded px-3 py-2"
                    value="{{ old('kewarganegaraan_negara', $data->kewarganegaraan_negara) }}">
            </div>

            {{-- Tempat, Tanggal Lahir --}}
            <div class="mb-4">
                <label class="block font-semibold">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $data->tempat_lahir) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4 grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-semibold">Kota Lahir</label>
                    <input type="text" name="kota_lahir" value="{{ old('kota_lahir', $data->kota_lahir) }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold">Provinsi Lahir</label>
                    <select name="provinsi_lahir_id" class="w-full border rounded px-3 py-2" required>
                        @foreach ($provinsis as $prov)
                            <option value="{{ $prov->id }}" {{ $prov->id == $data->provinsi_lahir_id ? 'selected' : '' }}>
                                {{ $prov->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold">Negara</label>
                    <input type="text" name="negara_lahir" value="{{ old('negara_lahir', $data->negara_lahir) }}" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Jenis Kelamin, Status, Agama --}}
            <div class="mb-4 grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-semibold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full border rounded px-3 py-2" required>
                        <option value="Pria" {{ $data->jenis_kelamin == 'Pria' ? 'selected' : '' }}>Pria</option>
                        <option value="Wanita" {{ $data->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold">Status Menikah</label>
                    <select name="status_menikah" class="w-full border rounded px-3 py-2" required>
                        <option value="Belum menikah" {{ $data->status_menikah == 'Belum menikah' ? 'selected' : '' }}>Belum menikah</option>
                        <option value="Menikah" {{ $data->status_menikah == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="Lain-lain" {{ $data->status_menikah == 'Lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold">Agama</label>
                    <select name="agama" class="w-full border rounded px-3 py-2" required>
                        @foreach (['Islam','Katolik','Kristen','Hindu','Budha','Lain-lain'] as $agama)
                            <option value="{{ $agama }}" {{ $data->agama == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.pendaftaran') }}" class="ml-3 text-gray-600 hover:underline">← Batal</a>
            </div>
        </form>

        <script>
            document.getElementById('provinsi').addEventListener('change', function () {
                let provinsiId = this.value;
                let kabupatenSelect = document.getElementById('kabupaten');

                kabupatenSelect.innerHTML = '<option>Loading...</option>';

                fetch(`/api/kabupaten?provinsi_id=${provinsiId}`)
                    .then(response => response.json())
                    .then(data => {
                        kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                        data.forEach(item => {
                            kabupatenSelect.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                        });
                    })
                    .catch(() => {
                        kabupatenSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                    });
            });
        </script>
    </div>
</x-app-layout>
