<?php

namespace App\Models\Auction;

use Illuminate\Database\Eloquent\Model;

class auctionImgs extends Model
{
    protected $fillable = ['image'];

    /**
     * Get the user that owns the auctionImgs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   /*  public function auction()
    {
        return $this->belongsTo(auctions ::class, 'foreign_key', 'other_key');
    } */

    public function getImageAttribute($image)
    {
        if ($image === null) {
            
            return asset('public/storage/Cars/default.jpg');
        } else {
            return asset('public/storage/Cars/'.$image);
        }
    }
}
