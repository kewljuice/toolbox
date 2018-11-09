<?php

namespace Plugins;

class INSZ {

  public function clean($insz) {
    return preg_replace("/\D/", "", $insz);
  }

}