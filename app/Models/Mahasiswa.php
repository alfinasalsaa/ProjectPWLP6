<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
   

     protected $table="mahasiswa"; // Eloquent akan membuat model mahasiswamenyimpan record di tabel mahasiswa
     public $timestamps= false; 
     protected $primaryKey = 'Nim'; // Memanggil isi DB Dengan primarykey

     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'Nim',
        'Nama',
        'Tanggal_Lahir',
        'Kelas',
        'Jurusan',
        'No_Handphone',
        'Email'
    ];

    
}
