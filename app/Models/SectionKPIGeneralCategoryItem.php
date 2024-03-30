<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SectionKPIGeneralCategoryItem extends Model
{
    use HasFactory;

    protected $table = 'section_kpi_general_category_items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_section_kpi', 'bsc_category'
    ];

    public $timestamps = false;

    public function kpi(): BelongsTo
    {
        return $this->belongsTo(SectionKPIGeneral::class, 'id_section_kpi', 'id');
    }

    public function goal_items(): HasMany
    {
        return $this->hasMany(SectionKPIGeneralCategoryGoalItem::class, 'id_category', 'id');
    }
}
