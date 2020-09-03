<?php

namespace App\Http\Controllers;

use App\Lot;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuctionController extends Controller
{
    public function refresh($id)
    {
        $lot = Lot::find($id);
        $lot->last_refresh = date("Y-m-d H:i:s");
        $lot->save();
        $from = DateTime::createFromFormat('Y-m-d H:i:s', $lot->last_offer);
        $to = DateTime::createFromFormat('Y-m-d H:i:s', $lot->last_refresh);
        $diff = 0;
        $s="Цена: " . $lot->auction_price;
        if ($from) {
            $diff = $to->getTimestamp() - $from->getTimestamp();
            if ($diff > 10) {
                $s = "Продано: " . $lot->last_offer_user . " за: " . $lot->auction_price;
            } else {
                $s = "Цена: " . $lot->auction_price . " предложил: " . $lot->last_offer_user . " время " . $lot->last_refresh . " " . $diff;
            }
        }
        return response()->json(['refreshString' => $s], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function index()
    {
        $lot = Lot::where("flag_run_auction", 1)->get()->first();
        return view('auction', ['lot' => $lot]);
    }

    public function offer($id, Request $request)
    {
        $lot = Lot::find($id);
        $from = DateTime::createFromFormat('Y-m-d H:i:s', $lot->last_offer);
        $to = DateTime::createFromFormat('Y-m-d H:i:s', $lot->last_refresh);
        $diff = 0;
        $newPrice = $request->get('newPrice');

        if ($from) {
            $diff = $to->getTimestamp() - $from->getTimestamp();
        }
        if ($diff <= 10 && $newPrice > $lot->auction_price) {
            $dateTime = date("Y-m-d H:i:s");
            $lot->last_refresh = $dateTime;
            $lot->last_offer = $dateTime;
            $lot->auction_price = $newPrice;
            $user = $user = Auth::user();
            $lot->last_offer_user = $user->name;
            $lot->save();
        }
        return view('auction', ['lot' => $lot]);

    }

    public function start($id)
    {
        DB::connection()->getPdo()->exec("update lots set flag_run_auction = null;");
        $lot = Lot::find($id);
        $lot->flag_run_auction = 1;
        $lot->last_refresh = date("Y-m-d H:i:s");
        $lot->last_offer = null;
        $lot->auction_price = $lot->start_price;
        $lot->save();
        return view('auction', ['lot' => $lot]);
    }

}
