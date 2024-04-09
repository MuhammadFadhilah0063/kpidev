<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nrp',
        'nama',
        'kategori',
        'subdivisi',
        'password',
        'foto_profil',
        'ttd',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    // Ignore timestamps (created_at and updated_at)
    public $timestamps = false;

    public function admin_kpi(): BelongsTo
    {
        return $this->belongsTo(AdminKPI::class, "id", "id_user");
    }

    public function gl_kpi(): BelongsTo
    {
        return $this->belongsTo(GLKPI::class, "id", "id_user");
    }

    public function rekap_gl_kpi(): BelongsTo
    {
        return $this->belongsTo(RekapPencapaianSFGLKPI::class, "id", "id_user");
    }

    public function gl_kpi_general(): BelongsTo
    {
        return $this->belongsTo(GLKPIGeneral::class, "id", "id_user");
    }

    public function admin_kpi_general(): BelongsTo
    {
        return $this->belongsTo(AdminKPIGeneral::class, "id", "id_user");
    }
}
