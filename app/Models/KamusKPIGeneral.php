<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KamusKPIGeneral extends Model
{
    use HasFactory;

    protected $table = 'kamuskpi_generals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'area_kinerja_utama', "subdivisi", "baris", "kategori"
    ];

    public $timestamps = false;

    public function indicator_items(): HasMany
    {
        return $this->hasMany(KeyPerformanceIndicator::class, "id_kamus_general", "id");
    }
}
