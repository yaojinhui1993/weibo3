<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->activation_token = Str::random(10);
        });
    }

    public function gravatar($size = 100)
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));

        return "http://gravatar.com/avatar/{$hash}?s={$size}";
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function feed()
    {
        return $this->statuses()->orderBy('created_at', 'desc');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function follow($userIds)
    {
        $userIds = is_array($userIds) ? $userIds : [$userIds];

        $this->followings()->sync($userIds, false);
    }

    public function unfollow($userIds)
    {
        $userIds = is_array($userIds) ? $userIds : [$userIds];

        $this->followings()->detach($userIds, false);
    }

    public function isFollowing($userId)
    {
        return $this->followings->contains($userId);
    }
}
