<?php

namespace App\Models\Auction;

use Illuminate\Database\Eloquent\Model;

class auctiontrns extends Model
{
    protected $fillable = ['auction_id', 'price', 'userEntry'];

    /**
     * Get the user that owns the auctiontrns
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auction()
    {
        return $this->belongsTo(auctions::class);
    }
    
}
