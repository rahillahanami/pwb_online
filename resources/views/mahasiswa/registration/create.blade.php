<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Pendaftaran Mahasiswa Baru
        </h2>
    </x-slot>

    <br><br>
    <div class="py-6 px-6 max-w-4xl mx-auto bg-white shadow rounded">
        <form id="formPendaftaran" action="{{ route('mahasiswa.registration.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            {{-- Nama Lengkap --}}
            <div class="mb-4">
                <label class="block font-semibold">Nama Lengkap <span class="text-red-600">*</span></label>
                <input type="text" name="nama_lengkap" class="mt-1 w-full border rounded px-3 py-2" required>
            </div>

            {{-- Alamat KTP --}}
            <div class="mb-4">
                <label class="block font-semibold">Alamat KTP <span class="text-red-600">*</span></label>
                <textarea name="alamat_ktp" class="w-full border rounded px-3 py-2" required></textarea>
            </div>

            {{-- Alamat Sekarang --}}
            <div class="mb-4">
                <label class="block font-semibold">Alamat Sekarang <span class="text-red-600">*</span></label>
                <textarea name="alamat_sekarang" class="w-full border rounded px-3 py-2" required></textarea>
            </div>

            {{-- Kecamatan --}}
            <div class="mb-4">
                <label class="block font-semibold">Kecamatan <span class="text-red-600">*</span></label>
                <input type="text" name="kecamatan" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Provinsi & Kabupaten --}}
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Provinsi <span class="text-red-600">*</span></label>
                    <select name="provinsi_id" id="provinsi" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Pilih Provinsi --</option>
                        @foreach ($provinsis as $provinsi)
                            <option value="{{ $provinsi->id }}">{{ $provinsi->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold">Kabupaten/Kota <span class="text-red-600">*</span></label>
                    <select name="kabupaten_id" id="kabupaten" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Pilih Kabupaten --</option>
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
                    <label class="block font-semibold">Nomor HP <span class="text-red-600">*</span></label>
                    <input type="text" name="no_hp" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold">Email <span class="text-red-600">*</span></label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
                </div>
            </div>

            {{-- Kewarganegaraan --}}
            <div class="mb-4">
                <label class="block font-semibold">Kewarganegaraan <span class="text-red-600">*</span></label>
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
                <label class="block font-semibold">Tempat Lahir <span class="text-red-600">*</span></label>
                <input type="text" name="tempat_lahir" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4 grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-semibold">Kota/Kabupaten Lahir <span class="text-red-600">*</span></label>
                    <input type="text" name="kota_lahir" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-semibold">Provinsi Lahir <span class="text-red-600">*</span></label>
                    <select name="provinsi_lahir_id" class="w-full border rounded px-3 py-2" required>
                        @foreach ($provinsis as $provinsi)
                            <option value="{{ $provinsi->id }}">{{ $provinsi->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-semibold">Negara (jika luar negeri)</label>
                    <input type="text" name="negara_lahir" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Tanggal Lahir <span class="text-red-600">*</span></label>
                <input type="date" name="tanggal_lahir" class="w-full border rounded px-3 py-2" required>
            </div>

            {{-- Jenis Kelamin, Status Menikah, Agama --}}
            <div class="mb-4 grid grid-cols-3 gap-4">
                <div>
                    <label class="block font-semibold">Jenis Kelamin <span class="text-red-600">*</span></label>
                    <select name="jenis_kelamin" class="w-full border rounded px-3 py-2" required>
                        <option value="Pria">Pria</option>
                        <option value="Wanita">Wanita</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold">Status Menikah <span class="text-red-600">*</span></label>
                    <select name="status_menikah" class="w-full border rounded px-3 py-2" required>
                        <option value="Belum menikah">Belum menikah</option>
                        <option value="Menikah">Menikah</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold">Agama <span class="text-red-600">*</span></label>
                    <select name="agama" class="w-full border rounded px-3 py-2" required>
                        <option value="Islam">Islam</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>
            </div>

            {{-- Foto & Video --}}
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Upload Foto</label>
                    <input type="file" name="foto" accept="image/*" class="w-full mt-1">
                </div>
                <div>
                    <label class="block font-semibold">Upload Video</label>
                    <input type="file" name="video" accept="video/*" class="w-full mt-1">
                </div>
            </div>

            {{-- Submit --}}
            <div class="mt-6 text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Simpan Pendaftaran
                </button>
            </div>
        </form>
    </div>

    {{-- SweetAlert + Validasi --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('provinsi').addEventListener('change', function() {
            let provinsiId = this.value;
            let kabupatenSelect = document.getElementById('kabupaten');
            kabupatenSelect.innerHTML = '<option>Loading...</option>';

            fetch(`/api/kabupaten?provinsi_id=${provinsiId}`)
                .then(res => res.json())
                .then(data => {
                    kabupatenSelect.innerHTML = '<option value="">-- Pilih Kabupaten --</option>';
                    data.forEach(item => {
                        kabupatenSelect.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
                    });
                })
                .catch(() => {
                    kabupatenSelect.innerHTML = '<option>Gagal memuat data</option>';
                });
        });

        document.getElementById('formPendaftaran').addEventListener('submit', function(e) {
            let email = document.querySelector('[name="email"]');
            let noHp = document.querySelector('[name="no_hp"]');
            let telepon = document.querySelector('[name="telepon"]');
            let foto = document.querySelector('[name="foto"]');
            let video = document.querySelector('[name="video"]');

            let errors = [];

            // Email
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) errors.push("Email tidak valid.");

            // Nomor HP
            if (isNaN(noHp.value) || noHp.value.trim() === '') errors.push("Nomor HP harus berupa angka.");

            // Telepon
            if (telepon.value.trim() !== '' && isNaN(telepon.value)) errors.push("Telepon harus berupa angka.");

            // Foto
            if (foto.files.length > 0) {
                let f = foto.files[0];
                let valid = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!valid.includes(f.type)) errors.push("Foto harus JPG/PNG.");
                if (f.size > 2 * 1024 * 1024) errors.push("Ukuran foto maksimal 2MB.");
            }

            // Video
            if (video.files.length > 0) {
                let v = video.files[0];
                let valid = ['video/mp4', 'video/avi', 'video/mov'];
                if (!valid.includes(v.type)) errors.push("Video harus MP4/AVI/MOV.");
                if (v.size > 10 * 1024 * 1024) errors.push("Ukuran video maksimal 10MB.");
            }

            if (errors.length > 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: '<ul style="text-align:left;">' + errors.map(e => `<li>• ${e}</li>`).join('') +
                        '</ul>',
                    confirmButtonColor: '#d33'
                });
            }
        });
    </script>
</x-app-layout>
