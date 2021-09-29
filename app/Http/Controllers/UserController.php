<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


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


    $response = Http::withToken(self::PAYSTACK_TEST_KEY)->get('https://api.paystack.co/bank/resolve', [
      'account_number' => $fields['user_account_number'],
      'bank_code' => $fields['user_bank_code'],
    ]);

    if ($response->failed()) {
      // dd($response->json()['message']);
      return back()->with([
        'message' => $response->json()['message'],
      ]);
    }

    // dd($response->json());

    $lev = levenshtein(strtoupper($fields['user_account_name']), strtoupper($response->json()['data']['account_name']));

    if ($lev <= 2) {
      $fields['is_verified'] = true;
      $request->user()->update($fields);

      return back()->with([
        'message' => "You're verified.",
        'user_account_name' => $response->json()['data']['account_name'],
      ]);
    }else{
      return back()->with([
        'message' => 'Name does not match',
      ]);
    }

    

    // return back()->with([
    //   'message' => $response->json()['message'],
    //   'bank_account_name' => $response->json()['data']['account_name'],
    // ]);
  }
}
