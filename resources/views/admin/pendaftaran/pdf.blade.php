<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftaran Mahasiswa</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 10px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            word-wrap: break-word;
            vertical-align: top;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Data Pendaftaran Mahasiswa Baru</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Nomor HP</th>
                <th>Tempat, Tanggal Lahir</th>
                <th>Alamat KTP</th>
                <th>Alamat Sekarang</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Provinsi</th>
                <th>Jenis Kelamin</th>
                <th>Status Menikah</th>
                <th>Agama</th>
                <th>Kewarganegaraan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pendaftar as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->nama_lengkap }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->no_hp }}</td>
                    <td>{{ $data->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d M Y') }}</td>
                    <td>{{ $data->alamat_ktp }}</td>
                    <td>{{ $data->alamat_sekarang }}</td>
                    <td>{{ $data->kecamatan }}</td>
                    <td>{{ optional($data->kabupaten)->nama ?? '-' }}</td>
                    <td>{{ optional($data->provinsi)->nama ?? '-' }}</td>
                    <td>{{ $data->jenis_kelamin }}</td>
                    <td>{{ $data->status_menikah }}</td>
                    <td>{{ $data->agama }}</td>
                    <td>{{ $data->kewarganegaraan }}{{ $data->kewarganegaraan === 'WNA' ? ' - '.$data->kewarganegaraan_negara : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
