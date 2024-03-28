<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GLKPIGeneralItem extends Model
{
    use HasFactory;

    protected $table = 'gl_kpi_general_items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_key_performance_indicator', 'realisasi', "skor", "konversi_sf", "skor_akhir", "id_kpi_general", "no_urut"
    ];

    public $timestamps = false;

    public function key_kamus(): HasOne
    {
        return $this->hasOne(KeyPerformanceIndicator::class, "id", "id_key_performance_indicator");
    }

    public function kpi(): BelongsTo
    {
        return $this->belongsTo(GLKPIGeneral::class, 'id_kpi_general', 'id');
    }
}
