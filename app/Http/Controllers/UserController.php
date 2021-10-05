<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use App\Models\UserBankDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
  const PAYSTACK_TEST_KEY = 'sk_test_a326631056771e2538b7bc7af35ace8f239d4c72';

  public function verify(Request $request)
  {
    $fields = $this->validate($request, [
      'user_account_name' => 'required|min:3|max:255',
      'user_account_number' => 'required|digits:10',
      'user_bank_code' => 'required|digits:3',
    ]);
    Mail::to('kofi.quist@shaqexpress.com')->send(new VerifyMail($fields, 'client'));
    Mail::to('kofi.quist@shaqexpress.com')->send(new VerifyMail($fields, 'back_office'));

    $user_bank_detail = UserBankDetail::where('user_account_number', $fields['user_account_number'])->first();

    if ($user_bank_detail !== null) {
      return back()->with([
        'message' => "You're verified.",
        'user_account_name' => $user_bank_detail->user_account_name,
      ]);
    } else {
      $response = Http::withToken(self::PAYSTACK_TEST_KEY)->get('https://api.paystack.co/bank/resolve', [
        'account_number' => $fields['user_account_number'],
        'bank_code' => $fields['user_bank_code'],
      ]);

      if ($response->failed()) {
        return back()->with([
          'message' => $response->json()['message'],
        ]);
      }


      $lev = levenshtein(strtoupper($fields['user_account_name']), strtoupper($response->json()['data']['account_name']));

      if ($lev <= 2) {
        $request->user()->user_bank_detail()->create($fields);

        return back()->with([
          'message' => "You're verified.",
          'user_account_name' => $response->json()['data']['account_name'],
        ]);
      } else {
        return back()->with([
          'message' => 'Name does not match',
        ]);
      }
    }
  }
}
