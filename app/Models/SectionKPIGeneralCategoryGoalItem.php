<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SectionKPIGeneralCategoryGoalItem extends Model
{
    use HasFactory;

    protected $table = 'section_kpi_general_category_goal_items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_category', 'goal_name', 'metric_description', 'metric_scale', 'weight', 'nilai_pencapaian_sf', "konversi_bintang", "filters"
    ];

    public $timestamps = false;

    public function category(): BelongsTo
    {
        return $this->belongsTo(SectionKPIGeneralCategoryItem::class, 'id_category', 'id');
    }
}
