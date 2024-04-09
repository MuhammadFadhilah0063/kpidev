<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdminKPIGeneral extends Model
{
    use HasFactory;

    protected $table = 'admin_kpi_generals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'file', 'total', 'id_user', 'id_user_approve', "status", "periode", "subdivisi", "alasan", "created_at", "updated_at",
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, "id", "id_user");
    }

    public function user_approve(): HasOne
    {
        return $this->hasOne(User::class, "id", "id_user_approve");
    }

    public function items(): HasMany
    {
        return $this->hasMany(AdminKPIGeneralItem::class, 'id_kpi_general', 'id');
    }
}
