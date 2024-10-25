<?php

class WPReactStarterDeactivate
{
  public static function deactivate() {
    flush_rewrite_rules();
  }
}