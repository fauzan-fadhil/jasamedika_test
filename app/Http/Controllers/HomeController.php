<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Jadwal;
use App\Models\Guru;
use App\Models\Kehadiran;
use App\Models\Siswa;
use App\Models\Mapel;
use App\Models\User;
use App\Models\Paket;
use App\Models\Pengumunan;
use App\Models\Pengumunan as AppPengumunan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Admin;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hari = date('w');
        $jam = date('H:i');
        return view('home');
    }

    public function admin()
    {

        $mapel = Mapel::count();
        $user = User::count();

        return view('admin.index', compact(



            'mapel',
            'user'
        ));
    }
}
