<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function mahasiswa()
    {
        return view('dashboard.mahasiswa');
    }

    // (Opsional) bisa tambahkan admin juga kalau mau satu tempat:
    public function admin()
    {
        return view('dashboard.admin');
    }
}
