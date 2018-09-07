<?php

namespace Plugins;

class Phone {

  public function clean_be($phone) {
    $default = $phone;
    $value = $phone;

    // remove 0
    if ($value == "0") {
      $value = NULL;
    }

    // check if numeric (excel mismatch 0)
    if (is_numeric($value)) {
      // remove hyphen
      $value = str_replace("-", "", $value);
      // check type
      $length = strlen($value);
    }
    else {
      // other remove space/characters
      $value = str_replace(" ", "", $value);
      $value = str_replace("²", "", $value);
      $value = str_replace("(0)", "", $value);
      // preg replace
      $value = preg_replace('/\D/', '', $value);
    }

    // remove zero's
    $value = ltrim($value, '0');

    // check length
    $length = strlen($value);

    // 32 fix (for belgian telephone)
    if (substr($value, 0, 2) == "32" && $length > 9) {
      $value = str_replace('32', '', $value);
    }
    // recheck length
    $length = strlen($value);
    // check size
    switch (TRUE) {
      case ($length == 0):
        // zero
        $value = NULL;
        break;
      case ($length <= 7):
        // small
        $value = $default;
        break;
      case ($length == 8):
        // belgiam landline
        // large cities
        $n1 = substr($value, 0, 1);
        $large = [2, 3, 4, 9];
        // small towns
        $n2 = substr($value, 0, 2);
        $small = [
          10,
          11,
          12,
          13,
          14,
          15,
          16,
          19,
          50,
          51,
          52,
          53,
          54,
          55,
          56,
          57,
          58,
          59,
          60,
          61,
          63,
          64,
          65,
          67,
          68,
          69,
          71,
          80,
          81,
          82,
          83,
          84,
          85,
          86,
          87,
          89,
        ];
        // check
        if (in_array($n1, $large)) {
          // check for large city x xxx xx xx
          $value = "+32 " . substr($value, 0, 1) . " " . substr($value, 1, 3) . " " . substr($value, 4, 2) . " " . substr($value, 6, 2);
        }
        else {
          if (in_array($n2, $small)) {
            // small city xx xx xx xx
            $value = "+32 " . substr($value, 0, 2) . " " . substr($value, 2, 2) . " " . substr($value, 4, 2) . " " . substr($value, 6, 2);
          }
          else {
            // default
            $value = $default;
          }
        }
        break;
      case ($length == 9):
        // belgian mobile
        // telenet
        $n1 = substr($value, 0, 3);
        $c1 = [468];
        // proximus,base,mobistar
        $n2 = substr($value, 0, 2);
        $c2 = [47, 48, 49];
        // check
        if (in_array($n1, $c1) || in_array($n2, $c2)) {
          // check for large city x xxx xx xx
          $value = "+32 " . substr($value, 0, 3) . " " . substr($value, 3, 2) . " " . substr($value, 5, 2) . " " . substr($value, 7, 2);
        }
        else {
          // default
          $value = $default;
        }
        break;
      default:
        // larger
        $value = $default;
    }
    // clean up import error prone characters
    $value = str_replace("'", "", $value);
    // return value
    return $value;
  }
}