<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdminKPIApprove extends Model
{
    use HasFactory;

    protected $table = 'admin_kpi_approves';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kpi', 'created_at', 'updated_at',
    ];

    public function kpi(): HasOne
    {
        return $this->hasOne(AdminKPI::class, "id", "id_kpi");
    }
}
