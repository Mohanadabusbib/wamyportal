<?php

namespace App\Models;

use App\Models\Auction\auctions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'empid', 'name', 'email', 'mobile', 'email_verified_at', 'password', 'avatar', 'role_id','lang', 'remember_token', 'created_at', 'updated_at'
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

    public function getAvatarAttribute($avatar)
    {
        if ($avatar === null) {
            
            return asset('public/storage/Images/avatar.png');
        } else {
            return asset('public/storage/Images/'.$avatar);
        }
        
        /* return asset('public/storage/Images/'.$avatar); */
    }

    /**
     * Get the auction t
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auction()
    {
        return $this->belongsTo(auctions::class);
    }
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
    public function coronas()
    {
        return $this->hasMany('App\Models\Corona');
    }

    public function visitors()
    {
        return $this->hasMany('App\Models\Visitor');
    }
    public function departments()
    {
        return $this->hasMany('App\Models\Department');
    }
    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }

    public function permissions()
    {
        return $this->hasMany('App\Models\permissionsuser');
    }
    
    

    public function isSuperAdmin()
    {
        return $this->role->id == 1;
    }

    public function hasAllow($permission)
    {
        $role = $this->role()->first();
        return $role->permissions()->whereName($permission)->first() ? true : false;
    }

    
    public function savin()
    {
        return $this->belongsTo('App\Models\Saving\Savings');
    }
    
    public function votes()
    {
        return $this->hasMany('App\Models\Vote', 'candidatePerson');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    /* public function auctions()
    {
        return $this->hasMany('App\Models\Auction\auctions', 'auctionUser');
    } */
}
