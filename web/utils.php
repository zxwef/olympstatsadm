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

  static public function dumper($obj, $die = false) {
    echo '<pre>';
    print_r($obj);
    echo '<pre>==============================================<br><br>';

    if($die) {
      exit;
    }
  }

}
