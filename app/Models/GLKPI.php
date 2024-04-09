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
        'id_periode', 'id_kamus', 'file', 'status', 'subdivisi', 'alasan', 'id_user', "pencapaian_sf", "realisasi"
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

    public function periode(): HasOne
    {
        return $this->hasOne(Periode::class, "id", "id_periode");
    }
}
