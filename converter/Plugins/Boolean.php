<?php

namespace Plugins;

class Boolean {

  public function convert($value) {
    if (!empty($value)) {
      if ($value == 'ja') {
        $value = 1;
      }
      else {
        $value = 0;
      }
    }
    return $value;
  }
}