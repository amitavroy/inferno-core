<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Inferno\Foundation\Presenters\UserPresenter;
use Laracasts\Presenter\PresentableTrait;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, PresentableTrait, HasRoles, HasApiTokens;

    protected $presenter = UserPresenter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'active'
    ];

    /**
     * Creating the relation between User and Profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne('Inferno\Foundation\Models\Profile');
    }

    /**
     * User has Tokens used for Forgot password and other activities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function token()
    {
        return $this->hasMany('Inferno\Foundation\Models\Token');
    }
}
