<?php
namespace App\Utils;

use Illuminate\Mail\Mailable;

class MyEmail extends Mailable {
  public $subject;
  public $content;
  public function __construct($subject, $content) {
    $this->subject = $subject;
    $this->content = $content;
  }
  public function build() {
    return $this->subject($this->subject)->view('emailtemplate');
  }
}
?>