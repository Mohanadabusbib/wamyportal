<?php

namespace App\Models\Auction;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class auctions extends Model
{
    /**
     * Get all of the comments for the auctions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     /**
      * Get all of the comments for the auctions
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasMany
      */
     public function trans()
     {
         return $this->hasMany(auctiontrns::class);
     }
     public function getImageAttribute($image)
     {
         if ($image === null) {
             
             return asset('public/storage/Cars/default.jpg');
         } else {
             return asset('public/storage/Cars/'.$image);
         }
     }


    /* public function user()
    {
        return $this->belongsTo('App\Models\User');
    } */

    /**
     * Get all of the comments for the auctions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Images()
    {
        return $this->hasMany('App\Models\Auction\auctionImgs', 'auction_id');
    }

    
    /* public function getStartDateAttribute($value)
    {
        return $value->format('H:i:s');
    }
    public function getEndDateAttribute($value)
    {
        return $value->format('H:i:s');
    } */
}
