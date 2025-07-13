<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\MahasiswaRegistration;
use App\Models\Provinsi;
use Barryvdh\DomPDF\Facade\Pdf;

class MahasiswaRegistrationController extends Controller
{
    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->mahasiswaRegistration) {
            return redirect()->route('mahasiswa.registration.show');
        }

        // Ambil semua provinsi
        $provinsis = Provinsi::orderBy('nama')->get();

        // Cek apakah provinsi terpilih
        $selectedProvinsiId = $request->get('provinsi_id');

        // Ambil kabupaten sesuai provinsi (jika ada)
        $kabupatens = $selectedProvinsiId
            ? Kabupaten::where('provinsi_id', $selectedProvinsiId)->orderBy('nama')->get()
            : collect();

        return view('mahasiswa.registration.create', compact('provinsis', 'kabupatens', 'selectedProvinsiId'));
    }
    // PROSES SIMPAN PENDAFTARAN
    public function store(Request $request)
    {
        // VALIDASI
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'alamat_ktp' => 'required|string',
            'alamat_sekarang' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten_id' => 'required|integer',
            'provinsi_id' => 'required|integer',
            'telepon' => 'nullable|numeric',
            'no_hp' => 'required|numeric',
            'email' => 'required|email',
            'kewarganegaraan' => 'required|in:WNI Asli,WNI Keturunan,WNA',
            'kewarganegaraan_negara' => 'nullable|string',
            'tempat_lahir' => 'required|string',
            'kota_lahir' => 'required|string',
            'provinsi_lahir_id' => 'required|integer',
            'negara_lahir' => 'nullable|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'status_menikah' => 'required|in:Belum menikah,Menikah,Lain-lain',
            'agama' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov|max:10240',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Ambil data validasi
        $data = $validator->validated();
        $data['user_id'] = auth()->id();

        // Simpan file foto (jika ada)
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('uploads/foto', 'public');
        }

        // Simpan file video (jika ada)
        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('uploads/video', 'public');
        }

        // Simpan ke database
        MahasiswaRegistration::create($data);

        return redirect()->route('mahasiswa.registration.show')->with('success', 'Pendaftaran berhasil disimpan.');
    }

    // LIHAT DATA PENDAFTARAN
    public function show()
    {
        $data = Auth::user()->mahasiswaRegistration;

        if (!$data) {
            return redirect()->route('mahasiswa.registration.create')->with('warning', 'Silakan isi pendaftaran terlebih dahulu.');
        }

        return view('mahasiswa.registration.show', compact('data'));
    }

    public function exportPDF()
    {
        $data = Auth::user()->mahasiswaRegistration;

        if (!$data) {
            return redirect()->route('mahasiswa.registration.create')->with('warning', 'Silakan isi pendaftaran terlebih dahulu.');
        }

        $pdf = Pdf::loadView('mahasiswa.registration.pdf', compact('data'));
        return $pdf->download('bukti-pendaftaran.pdf');
    }
}
