<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'alamat_ktp',
        'alamat_sekarang',
        'kecamatan',
        'kabupaten_id',
        'provinsi_id',
        'telepon',
        'no_hp',
        'email',
        'kewarganegaraan',
        'kewarganegaraan_negara',
        'tempat_lahir',
        'kota_lahir',
        'provinsi_lahir_id',
        'negara_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_menikah',
        'agama',
        'foto', // path file foto
        'video', // path file video
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function provinsiLahir()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_lahir_id');
    }
}
