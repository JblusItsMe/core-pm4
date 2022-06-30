<?php

namespace test\events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use test\Main;

class PlayerQuit implements Listener {

  protected Main $plugin;

  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
  }

  public function onQuit(PlayerQuitEvent $event) {
    $sender = $event->getPlayer();
    $name = $sender->getName();

    $event->setQuitMessage("");
    foreach($this->plugin->getServer()->getOnlinePlayers() as $players) {
      $players->sendTip("§c[-] $name");
    }
  }

}