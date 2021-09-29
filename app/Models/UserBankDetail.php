<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBankDetail extends Model
{
  use HasFactory;

  protected $fillable = ['user_account_name', 'user_account_number', 'user_bank_code',];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
