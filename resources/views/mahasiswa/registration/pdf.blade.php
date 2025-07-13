<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Pendaftaran Mahasiswa</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .section { margin-bottom: 12px; }
        .label { font-weight: bold; width: 180px; display: inline-block; vertical-align: top; }
    </style>
</head>
<body>

    <h2 style="text-align: center;">Bukti Pendaftaran Mahasiswa Baru</h2>
    <p style="text-align: center;">Dicetak: {{ now()->translatedFormat('d F Y, H:i') }}</p>
    <hr>

    <div class="section"><span class="label">Nama Lengkap:</span> {{ $data->nama_lengkap }}</div>
    <div class="section"><span class="label">Alamat KTP:</span> {{ $data->alamat_ktp }}</div>
    <div class="section"><span class="label">Alamat Sekarang:</span> {{ $data->alamat_sekarang }}</div>
    <div class="section"><span class="label">Kecamatan:</span> {{ $data->kecamatan }}</div>
    <div class="section"><span class="label">Kabupaten:</span> {{ $data->kabupaten->nama ?? '-' }}</div>
    <div class="section"><span class="label">Provinsi:</span> {{ $data->provinsi->nama ?? '-' }}</div>
    <div class="section"><span class="label">No HP:</span> {{ $data->no_hp }}</div>
    <div class="section"><span class="label">Email:</span> {{ $data->email }}</div>
    <div class="section"><span class="label">Kewarganegaraan:</span> {{ $data->kewarganegaraan }} {{ $data->kewarganegaraan == 'WNA' ? '('.$data->kewarganegaraan_negara.')' : '' }}</div>
    <div class="section"><span class="label">Tempat, Tgl Lahir:</span> {{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d-m-Y') }}</div>
    <div class="section"><span class="label">Kota Lahir:</span> {{ $data->kota_lahir }}</div>
    <div class="section"><span class="label">Provinsi Lahir:</span> {{ $data->provinsiLahir->nama ?? '-' }}</div>
    <div class="section"><span class="label">Negara Lahir:</span> {{ $data->negara_lahir ?? '-' }}</div>
    <div class="section"><span class="label">Jenis Kelamin:</span> {{ $data->jenis_kelamin }}</div>
    <div class="section"><span class="label">Status Menikah:</span> {{ $data->status_menikah }}</div>
    <div class="section"><span class="label">Agama:</span> {{ $data->agama }}</div>

    <hr>
    <p><em>Bukti ini dicetak otomatis dari sistem PSB Online. Simpan sebagai arsip.</em></p>

</body>
</html>
