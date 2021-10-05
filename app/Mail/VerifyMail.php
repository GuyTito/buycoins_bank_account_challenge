<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable
{
  use Queueable, SerializesModels;

  public $fields;
  public $receiver;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($fields, $receiver)
  {
    $this->fields = $fields;
    $this->receiver = $receiver;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    if ($this->receiver == 'client') {
      return $this->view('email.verify_mail')
      ->subject("You're Verified");
    }

    if ($this->receiver == 'back_office') {
      return $this->view('email.verify_mail')
      ->subject('A Client Joined');
    }
    
  }
}
