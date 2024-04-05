<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SectionKPIGeneral extends Model
{
    use HasFactory;

    protected $table = 'section_kpi_generals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'file', 'total', 'periode', "periode_awal", "periode_akhir", "parameter", "created_at", "updated_at",
    ];

    public function category_items(): HasMany
    {
        return $this->hasMany(SectionKPIGeneralCategoryItem::class, 'id_section_kpi', 'id');
    }
}
