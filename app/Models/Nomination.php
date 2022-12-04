<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    protected $fillable = ['empid','name','mobile','dept','sectn','job','qualification','candidateposition','file','avatar'];

    public function getAvatarAttribute($avatar)
    {
        if ($avatar === null) {
            return asset('public/storage/Images/avatar.png');
        } else {
            return asset('public/storage/Images/'.$avatar);
        }
        
        return asset('public/storage/Images/'.$avatar);
    }

}
