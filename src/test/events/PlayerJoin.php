<?php

namespace test\events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use test\Main;

class PlayerJoin implements Listener {

  protected Main $plugin;

  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
  }

  public function onJoin(PlayerJoinEvent $event) {
    $sender = $event->getPlayer();
    $name = $sender->getName();

    $event->setJoinMessage("§a[+] $name");
    $sender->sendMessage("Ceci est un test.");
    $sender->sendTitle("ligne 1", "ligne 2");
  }

}