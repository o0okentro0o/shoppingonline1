<?php
namespace App\Utils;

use Illuminate\Support\Facades\Mail;

class EmailUtil {
  static function send($email, $subject, $content) {
    Mail::to($email)->send(new MyEmail($subject, $content));
    if (Mail::failures()) return false;
    return true;
  }
}
?>