<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kamuskpi extends Model
{
    use HasFactory;

    protected $table = 'kamuskpis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pointkpi', 'subdivisi', 'target', 'unit_target', "kategori"
    ];

    public $timestamps = false;

    public function gl_kpi(): BelongsTo
    {
        return $this->belongsTo(GLKPI::class, "id", "id_kamus");
    }

    public function admin_kpi(): BelongsTo
    {
        return $this->belongsTo(AdminKPI::class, "id", "id_kamus");
    }

    public function rekap_gl_kpi(): BelongsTo
    {
        return $this->belongsTo(RekapPencapaianSFGLKPI::class, "id", "id_kamus");
    }
}
