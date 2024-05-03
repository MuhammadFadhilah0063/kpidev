<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GLKPIBulanan extends Model
{
    use HasFactory;

    protected $table = 'gl_kpi_bulanan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_periode', 'id_user',
    ];

    public $timestamps = false;

    public function periode(): HasOne
    {
        return $this->hasOne(Periode::class, "id", "id_periode");
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, "id", "id_user");
    }

    public function items(): HasMany
    {
        return $this->hasMany(GLKPIBulananItem::class, "id_kpi_bulanan", "id");
    }
}
