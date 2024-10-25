<?php

class WPReactStarterActivate
{
  public static function activate() {
    flush_rewrite_rules();
  }
}