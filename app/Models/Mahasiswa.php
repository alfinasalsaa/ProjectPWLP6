<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

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
        'Tanngal_Lahir',
        'Jurusan',
        'No_Handphone',
        'Email',
        'Kelas_id'
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    
}
