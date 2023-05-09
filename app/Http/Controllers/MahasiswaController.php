<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use PDF;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswa = Mahasiswa::all(); // Mengambil semua isi tabel
        // $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
        // return view('mahasiswa.index', compact('mahasiswa'))
        // ->with('i', (request()->input('page', 1) - 1) * 5);


        $mahasiswa = Mahasiswa::paginate(5);
        return view('mahasiswa.index', compact('mahasiswa'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswa.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'image' => 'required',
            'Tanggal_Lahir'=>'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
        ]);

        if ($request->file('image')){
            $image_name = $request->file('image')->store('images', 'public',);
        }

        //fungsi eloquent untuk menambah data
        $mahasiswa= new Mahasiswa;
        $mahasiswa->nim=$request->get('Nim');
        $mahasiswa->nama=$request->get('Nama');
        $mahasiswa->foto=$image_name;
        $mahasiswa->tanggal_lahir=$request->get('Tanggal_Lahir');
        // $mahasiswa->kelas=$request->get('Kelas');
        $mahasiswa->jurusan=$request->get('Jurusan');
        $mahasiswa->no_handphone=$request->get('No_Handphone');
        $mahasiswa->email=$request->get('Email');
        // $mahasiswa->save();

        //
        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untukdiedit
        $Mahasiswa = Mahasiswa::find($Nim);
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
        'Nim' => 'required',
        'Nama' => 'required',
        'image' => 'required',
        'Tanggal_Lahir'=>'required',
        'Kelas' => 'required',
        'Jurusan' => 'required',
        'No_Handphone' => 'required',
        'Email' => 'required',
        
    ]);

        $mahasiswa= Mahasiswa::with('Kelas')->where('Nim',$Nim)->first();
        $mahasiswa->nim=$request->get('Nim');
        $mahasiswa->nama=$request->get('Nama');
        if($mahasiswa->Foto && file_exists(storage_path('app/public/' . $mahasiswa->Foto))) {
            Storage::delete('public/' . $mahasiswa->Foto);
        }
        $image_name = $request->file('image')->store('image', 'public');
        $mahasiswa->Foto = $image_name;
        $mahasiswa->tanggal_lahir=$request->get('Tanggal_Lahir');
        // $mahasiswa->kelas=$request->get('Kelas');
        $mahasiswa->jurusan=$request->get('Jurusan');
        $mahasiswa->no_handphone=$request->get('No_Handphone');
        $mahasiswa->email=$request->get('Email');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        //fungsi eloquent untuk mengupdate data inputan kita
        Mahasiswa::find($Nim)->update($request->all());
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')
        -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function nilai($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        return view('mahasiswa.nilai', compact('Mahasiswa'));
    }

    public function cetak_pdf($Nim)
    {
        $Mahasiswa = Mahasiswa::find($Nim);
        $pdf = PDF::loadview('mahasiswa.cetak_pdf',['Mahasiswa' =>$Mahasiswa]);
        return $pdf->stream();
    }
}
