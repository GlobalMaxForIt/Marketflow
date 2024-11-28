<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'middlename',
        'image',
        'phone',
        'email',
        'role',
        'gender',
        'birth_date',
        'status',
        'address_id',
        'company_id',
        'organization_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function store(){
        return $this->hasOne(Store::class, 'id', 'store_id');
    }
    public function personalInfo(){
        return $this->hasOne(PersonalInfo::class, 'id', 'personal_info_id');
    }
    public function company(){
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
    public function organization(){
        return $this->hasOne(PersonalInfo::class, 'id', 'organization_id');
    }
}
