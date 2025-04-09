<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServisController extends Controller
{
    public function index()
    {
        $servis = DB::table('nota_servis')->get();
        return view('admin.servis.index', compact('servis'));
    }

    public function create()
    {
        return view('admin.servis.create');
    }

    public function edit($id)
    {
        $servis = DB::table('nota_servis')->where('id', $id)->first();
        return view('admin.servis.edit', compact('servis'));
    }

    public function destroy($id)
    {
        DB::table('nota_servis')->where('id', $id)->delete();
        return redirect()->route('servis.index')->with('success', 'Data berhasil dihapus');
    }
}
