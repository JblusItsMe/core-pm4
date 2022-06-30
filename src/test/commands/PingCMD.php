<?php

namespace test\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use test\Main;

class PingCMD extends Command {

  protected Main $plugin;

  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
    parent::__construct("ping", "Obtenir son ping.", "/ping [pseudo]");
  }

  public function execute(CommandSender $sender, string $commandLabel, array $args) {
    if($sender instanceof Player) {
      if(isset($args[0])) {
        if($this->plugin->getServer()->getPlayerExact($args[0])) {
          $ping = $this->plugin->getServer()->getPlayerExact($args[0])->getNetworkSession()->getPing();
          $sender->sendMessage("Le ping de §e".$args[0]."§r est de §e".$ping." ms§r.");
        } else {
          $sender->sendMessage("§cL'utilisateur n'est pas en ligne.");
        }
      } else if(!isset($args[0])) {
        $ping = $sender->getNetworkSession()->getPing();
        $sender->sendMessage("Votre ping est de §e$ping ms§r.");
      }
    }
  }

}