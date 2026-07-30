<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Events\Verified;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'name_pronunciation',
        'birth_year',
        'birth_month',
        'birth_day',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verify_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_verified' => 'boolean',
        'status' => 'integer',
    ];
    public function viewers()
    {
        return $this->hasMany(TaskViewer::class, 'user_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'users_groups')->withTimestamps();
    }

    public function hasVerifiedEmail(): bool
    {
        return $this->email_verified_at !== null
            || (bool) $this->email_verified
            || (int) $this->status === (int) config('const.USER_STATUS.REGISTER', 1);
    }

    public function markEmailAsVerified(): bool
    {
        if ($this->hasVerifiedEmail() && $this->email_verified_at !== null) {
            return false;
        }

        $this->forceFill([
            'email_verified_at' => Carbon::now(),
            'email_verified' => true,
            'status' => (int) config('const.USER_STATUS.REGISTER', 1),
            'email_verify_token' => null,
        ])->save();

        event(new Verified($this));

        return true;
    }
}
