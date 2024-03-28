<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdminKPIGeneralApprove extends Model
{
    use HasFactory;

    protected $table = 'admin_kpi_general_approves';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kpi_general', 'file', 'created_at', 'updated_at', "id_user_approve"
    ];

    public function kpi(): HasOne
    {
        return $this->hasOne(AdminKPIGeneral::class, "id", "id_kpi_general");
    }

    public function user_approve(): HasOne
    {
        return $this->hasOne(User::class, "id", "id_user_approve");
    }
}
