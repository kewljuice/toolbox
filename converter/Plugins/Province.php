<?php

namespace Plugins;

class Province {

  public function fetch($value) {
    if (!empty($value)) {
      switch (TRUE) {
        case  ($value < 1300):
          return "Brussel";
          break;
        case  ($value < 1500):
          return "Waals-Brabant";
          break;
        case  ($value < 2000):
          return "Vlaams-Brabant";
          break;
        case  ($value < 3000):
          return "Antwerpen";
          break;
        case  ($value < 3500):
          return "Vlaams-Brabant";
          break;
        case  ($value < 4000):
          return "Limburg";
          break;
        case  ($value < 5000):
          return "Luik";
          break;
        case  ($value < 6000):
          return "Namen";
          break;
        case  ($value < 6600):
          return "Henegouwen";
          break;
        case  ($value < 7000):
          return "Luxemburg";
          break;
        case  ($value < 8000):
          return "Henegouwen";
          break;
        case  ($value < 9000):
          return "West-Vlaanderen";
          break;
        case  ($value < 10000):
          return "Oost-Vlaanderen";
          break;
        default:
          return $value;
      }
    }
    // return input.
    return $value;
  }
}