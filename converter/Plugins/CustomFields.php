<?php

namespace Plugins;

class CustomFields {

  public function convert($value, $mapping) {
    $input = explode(',', $value);
    $output = [];
    foreach ($input as $element) {
      $index = ltrim(mb_strtolower($element, 'UTF-8'));
      if (isset($mapping[$index])) {
        array_push($output, $mapping[$index]);
      }
    }
    $return = implode(', ', $output);
    return $return;
  }
}