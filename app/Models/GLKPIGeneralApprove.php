<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GLKPIGeneralApprove extends Model
{
    use HasFactory;

    protected $table = 'gl_kpi_general_approves';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_kpi_general', 'file', 'created_at', 'updated_at'
    ];

    public function kpi(): HasOne
    {
        return $this->hasOne(GLKPIGeneral::class, "id", "id_kpi_general");
    }
}
