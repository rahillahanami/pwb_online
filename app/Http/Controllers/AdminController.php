<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MahasiswaRegistration;
use Illuminate\Http\Request;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Barryvdh\DomPDF\Facade\Pdf;


use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $pendaftar = MahasiswaRegistration::with('user')->latest()->get();

        return view('dashboard.admin', compact('users', 'pendaftar'));
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }


    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }

    public function pendaftaran()
    {
        $pendaftar = \App\Models\MahasiswaRegistration::latest()->get();
        return view('admin.pendaftaran', compact('pendaftar'));
    }

    public function deletePendaftaran($id)
    {
        $data = MahasiswaRegistration::findOrFail($id);
        $data->delete();

        return back()->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }


    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,mahasiswa',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->update($validator->validated());

        return redirect()->route('admin.users')->with('success', 'User berhasil diupdate.');
    }

    public function editPendaftaran($id)
    {
        $data = MahasiswaRegistration::findOrFail($id);

        $provinsis = \App\Models\Provinsi::all();
        $kabupatens = \App\Models\Kabupaten::all();

        return view('admin.pendaftaran.edit', compact('data', 'provinsis', 'kabupatens'));
    }

    public function updatePendaftaran(Request $request, $id)
    {
        $data = MahasiswaRegistration::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'alamat_ktp' => 'required|string',
            'alamat_sekarang' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten_id' => 'required|integer',
            'provinsi_id' => 'required|integer',
            'no_hp' => 'required|numeric',
            'email' => 'required|email',
            'tanggal_lahir' => 'required|date',
            // tambahkan field lain jika diperlukan
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data->update($validator->validated());

        return redirect()->route('admin.pendaftaran')->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    public function exportExcel(): StreamedResponse
    {
        $pendaftar = MahasiswaRegistration::with(['user', 'provinsi', 'kabupaten'])->get();

        return SimpleExcelWriter::streamDownload('pendaftaran-mahasiswa.xlsx')
            ->addRows($pendaftar->map(function ($data) {
                return [
                    'Nama Lengkap' => $data->nama_lengkap,
                    'Email' => $data->email,
                    'Nomor HP' => $data->no_hp,
                    'Tempat Lahir' => $data->tempat_lahir,
                    'Tanggal Lahir' => $data->tanggal_lahir,
                    'Alamat KTP' => $data->alamat_ktp,
                    'Alamat Sekarang' => $data->alamat_sekarang,
                    'Kecamatan' => $data->kecamatan,
                    'Kabupaten' => optional($data->kabupaten)->nama,
                    'Provinsi' => optional($data->provinsi)->nama,
                    'Agama' => $data->agama,
                    'Jenis Kelamin' => $data->jenis_kelamin,
                    'Status Menikah' => $data->status_menikah,
                    'Kewarganegaraan' => $data->kewarganegaraan,
                ];
            }))->toResponse();
    }


    public function exportPDF()
    {
        $pendaftar = MahasiswaRegistration::with(['user', 'kabupaten', 'provinsi'])->get();

        $pdf = Pdf::loadView('admin.pendaftaran.pdf', compact('pendaftar'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('data-pendaftaran.pdf');
    }
}
