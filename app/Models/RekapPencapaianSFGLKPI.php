<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RekapPencapaianSFGLKPI extends Model
{
    use HasFactory;

    protected $table = 'rekap_pencapaian_sf_gl_kpi_individu';
    protected $primaryKey = 'id';
    protected $fillable = [
        'point_kpi', 'periode', 'id_user', 'id_kamus', 'rata_rata_pencapaian_sf', 'konversi_bintang'
    ];

    public $timestamps = false;

    public function user(): HasOne
    {
        return $this->hasOne(User::class, "id", "id_user");
    }

    public function kamus(): HasOne
    {
        return $this->hasOne(Kamuskpi::class, "id", "id_kamus");
    }
}
