<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'start_price', 'src','auction_price', 'flag_run_auction', 'last_refresh', 'last_offer_user', 'last_offer'
    ];

}
