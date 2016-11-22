<?php

class Utils {

  static public function render($tpl, $vars = array()) {
    if(file_exists(TPL_DIR . $tpl)) {
      ob_start();
      extract($vars);
      require TPL_DIR . $tpl;
      return ob_get_clean();
    }
  }

  static public function dumper($obj, $die = false, $outputStyle = 'html') {
    if($outputStyle == 'html') {
      echo '<pre>';
      print_r($obj);
      echo '<pre>==============================================<br><br>';
    } else {
      print_r($obj);
      echo "\n==============================================\n\n";
    }

    if($die) {
      exit;
    }
  }

}
