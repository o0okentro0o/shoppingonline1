<?php
namespace App\Utils;

class MyUtil {
  static function showAlertAndRedirect($msg, $url) {
    $script = "<script type='text/javascript'>";
    $script .= "alert('" . $msg . "');";
    $script .= "location='" . $url . "';";
    $script .= "</script>";
    echo $script;
  }
}
?>