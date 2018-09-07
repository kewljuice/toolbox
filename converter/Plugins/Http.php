<?php

namespace Plugins;

class Http {

  public function clean_url($url) {
    if(!empty($url)) {
      if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
      }
    }
    return $url;
  }
}