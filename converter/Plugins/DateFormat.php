<?php

namespace Plugins;

class DateFormat {

  public function convert($date, $format) {
    if (!empty($date)) {
      $date = strtotime($date);
      $date = date($format, $date);
    }
    return $date;
  }

}