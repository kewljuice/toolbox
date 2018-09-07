<?php

namespace Plugins;

class Text {

  public function uppercasefirst($text) {
    $result = implode('-', array_map('ucfirst', explode('-', strtolower($text))));
    $result = implode('(', array_map('ucfirst', explode('(', $result)));
    return $result;
  }

  public function lowercase($text) {
    $result = mb_strtolower($text);
    return $result;
  }
}
