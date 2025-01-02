<?php

namespace App\Http\Controllers;

use App\Models\MemberMessage;
use Illuminate\Http\Request;

class MemberHotSaleController extends Controller {
    public function show($user_id, $id) {
        $hotSale = MemberMessage::where('user_id', $user_id)
            ->where('id', $id)
            ->where('active', 1)
            ->with(['hotel', 'user'])
            ->firstOrFail();
            
        return view('pages.member.hot-sale.show', [
            'hotSale' => $hotSale
        ]);
    }
}
