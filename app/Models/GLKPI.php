<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GLKPI extends Model
{
    use HasFactory;

    protected $table = 'gl_kpis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'periode', 'id_kamus', 'aktual_realisasi', 'file', 'status', 'subdivisi', 'alasan', 'id_user', "pencapaian_sf"
    ];

    public $timestamps = false;

    public function kamus(): HasOne
    {
        return $this->hasOne(Kamuskpi::class, "id", "id_kamus");
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, "id", "id_user");
    }
}
