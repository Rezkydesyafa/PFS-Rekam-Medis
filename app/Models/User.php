<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
    ];


    /**
     * Check if the user is a superadmin. (Aliased to admin)
     */
    public function isSuperadmin(): bool
    {
        return $this->role === 'admin' || $this->role === 'superadmin';
    }

    /**
     * Check if the user is a petugas rekam medis.
     */
    public function isPetugas(): bool
    {
        return $this->role === 'petugas_rekam_medis' || $this->role === 'petugas';
    }

    // --- Role Helpers ---

    public function isUnitPendaftaran(): bool
    {
        return $this->role === 'unit_pendaftaran';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPetugasRekamMedis(): bool
    {
        return in_array($this->role, ['petugas_rekam_medis', 'petugas']);
    }

    public function isDokter(): bool
    {
        return $this->role === 'dokter';
    }

    public function isApoteker(): bool
    {
        return $this->role === 'apoteker';
    }

    public function isKasir(): bool
    {
        return $this->role === 'kasir';
    }

    /**
     * Check if the user has a specific role.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
