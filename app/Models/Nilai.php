<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';
    protected $fillable = [
        'nama',
        'nim',
        'smtr',
        'matkul',
        'absen',
        'tugas',
        'uts',
        'uas',
        'bobot_absen',
        'bobot_tugas',
        'bobot_uts',
        'bobot_uas',
        'na',
        'grade',
        'user_id', // Pastikan 'user_id' ada di sini
    ];

    protected $hidden = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
