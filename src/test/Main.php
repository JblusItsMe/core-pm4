<?php

namespace test;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase {

  public static $instance;

  protected function onEnable(): void {
    self::$instance = $this;
    $this->getLogger()->notice("§aActivé");
    (new Loader($this))->load();
  }

  protected function onDisable(): void {
    $this->getLogger()->notice("§cDésactivé");
  }

  public static function getInstance() {
    return self::$instance;
  }

}