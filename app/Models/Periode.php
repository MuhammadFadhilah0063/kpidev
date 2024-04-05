<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Periode extends Model
{
    use HasFactory;

    protected $table = 'periodes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'periode', 'tanggal'
    ];

    public $timestamps = false;

    public function gl_kpi(): BelongsTo
    {
        return $this->belongsTo(GLKPI::class, "id", "id_periode");
    }

    public function gl_kpi_general(): BelongsTo
    {
        return $this->belongsTo(GLKPIGeneral::class, "id", "id_periode");
    }
}
