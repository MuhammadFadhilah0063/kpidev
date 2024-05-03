<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GLKPIBulananItem extends Model
{
    use HasFactory;

    protected $table = 'gl_kpi_bulanan_item';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kpi_bulanan', 'id_kamus', 'realisasi', 'konversi_sf', 'konversi_bintang'
    ];

    public $timestamps = false;

    public function kpi(): BelongsTo
    {
        return $this->belongsTo(GLKPIBulanan::class, "id_kpi_bulanan", "id");
    }

    public function kamus(): HasOne
    {
        return $this->hasOne(Kamuskpi::class, "id", "id_kamus");
    }
}
