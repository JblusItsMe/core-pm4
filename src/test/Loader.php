<?php

namespace test;

use pocketmine\Server;

class Loader {

  protected Main $plugin;

  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
  }

  public function load() {
    $this->eventsLoad();
    $this->commandsLoad();
  }

  private function eventsLoad() {
    $list = [

    ];
    foreach($list as $event) {
      Server::getInstance()->getPluginManager()->registerEvents($event, $this->plugin);
    }
  }

  private function commandsLoad() {
    Server::getInstance()->getCommandMap()->registerAll("ex", [

    ]);
  }

}