<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index() {
        // $dt_lap = DB::table('penayangan')->orderByDesc('id')->get();
        // $jlm_tiket = DB::select('select')
        return view('laporan.index');
    }
}
