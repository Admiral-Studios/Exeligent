<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class CheckVoucherController extends Controller
{

    public function check(Request $request)
    {
        $request->validate([
            'voucher_code' => ['nullable', 'exists:vouchers,code']
        ]);

        if (!$request->wantsJson())
            return redirect('/');

        $voucher = Voucher::isValid($request->post('voucher_code'));

        if ($voucher)
            session()->put('voucher_code', $request->post('voucher_code'));

        return [
            'available' => $voucher,
            'message' => $voucher
                ? 'Voucher activated'
                : 'Voucher is no longer available'
        ];
    }

}
