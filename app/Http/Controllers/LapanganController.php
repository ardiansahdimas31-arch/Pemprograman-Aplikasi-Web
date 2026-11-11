<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan; // 

class LapanganController extends Controller
{
  
    public function index()
    {
        $lapangans = Lapangan::all();
        return view('index', compact('lapangans'));
    }

   
    public function indoor()
    {
        $lapangans = Lapangan::where('kategori', 'Indoor')->get();
        return view('indoor', compact('lapangans'));
    }

    
    public function outdoor()
    {
        $lapangans = Lapangan::where('kategori', 'Outdoor')->get();
        return view('outdoor', compact('lapangans'));
    }


    public function store(Request $request)
    {
        Lapangan::create($request->all());
        //Return redirect
         return redirect('/');
    }

  
    public function edit($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('edit', compact('lapangan'));
    }

    
    public function update(Request $request, $id)
    {
        $lapangan = Lapangan::findOrFail($id);
        $lapangan->update($request->all());
        return redirect('/');
    }
    public function destroy($id)
    {
        $lapangan = Lapangan::findOrFail($id);

        //Delete $lapangan
        $lapangan->delete();
        
        return redirect('/');
    }
}