<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa_MataKuliah;

class Matakuliah extends Model
{
    use HasFactory;
    protected $table='matakuliah'; //def model ini terkait dgn tabel kelas

    protected $fillable = [
        'nama_matkul',
        'sks',
        'jam',
        'semester',
    ];

    public function mahasiswa_matakuliah()
    {
        return $this->hasMany(Mahasiswa_Matakuliah::class);
        //return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah');
    }
}
