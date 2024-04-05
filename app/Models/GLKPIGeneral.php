<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GLKPIGeneral extends Model
{
    use HasFactory;

    protected $table = 'gl_kpi_generals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'file', 'total', 'id_user', "status", "id_periode", "subdivisi", "alasan", "created_at", "updated_at",
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, "id", "id_user");
    }

    public function periode(): HasOne
    {
        return $this->hasOne(Periode::class, "id", "id_periode");
    }

    public function kpiApprove(): BelongsTo
    {
        return $this->belongsTo(GLKPIApprove::class, "id", "id_kpi_general");
    }

    public function items(): HasMany
    {
        return $this->hasMany(GLKPIGeneralItem::class, 'id_kpi_general', 'id');
    }
}
