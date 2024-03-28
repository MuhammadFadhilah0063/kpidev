<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeyPerformanceIndicator extends Model
{
    use HasFactory;

    protected $table = 'key_performance_indicator_items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kamus_general', 'indicator', 'bobot', 'target'
    ];

    public $timestamps = false;

    public function kamus(): BelongsTo
    {
        return $this->belongsTo(KamusKPIGeneral::class, "id_kamus_general", "id");
    }

    public function gl_kpi_item(): BelongsTo
    {
        return $this->belongsTo(GLKPIGeneralItem::class, "id", "id_key_performance_indicator");
    }

    public function admin_kpi_item(): BelongsTo
    {
        return $this->belongsTo(AdminKPIGeneralItem::class, "id", "id_key_performance_indicator");
    }
}
