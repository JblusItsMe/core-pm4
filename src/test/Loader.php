<?php

namespace test;

use pocketmine\Server;
use test\commands\PingCMD;
use test\events\PlayerJoin;
use test\events\PlayerQuit;

class Loader {

  protected Main $plugin;

  public function __construct(Main $plugin) {
    $this->plugin = $plugin;
  }

  public function load() {
    $this->eventsLoad();
    $this->unloadCommands();
    $this->commandsLoad();
    $this->worldLoad();
  }

  private function eventsLoad() {
    $list = [
      new PlayerJoin($this->plugin), new PlayerQuit($this->plugin)
    ];
    foreach($list as $event) {
      $this->plugin->getServer()->getPluginManager()->registerEvents($event, $this->plugin);
    }
  }

  private function commandsLoad() {
    $this->plugin->getServer()->getCommandMap()->registerAll("ex", [
      new PingCMD($this->plugin)
    ]);
  }

  private function unloadCommands() {
    $commands = $this->plugin->getServer()->getCommandMap();
    foreach([
      "dumpmemory", "effect", "enchant", "list", "listperms", "me", "particle", "plugins", "say", "seed",
      "tell", "title", "transferserver", "version", "ban", "ban-ip", "clear", "defaultgamemode", "difficulty",
      "genplugin", "gc", "makeplugin", "extractplugin", "banlist", "give", "kick", "kill", "setworldspawn", "spawnpoint", "time",
      "timings", "whitelist", "gamemode", "pardon", "pardon-ip"
    ] as $cmd) {
      $command = $commands->getCommand($cmd);
      $command->setLabel("old_" . $command->getName());
      $commands->unregister($command);
    }
  }

  private function worldLoad() {
    foreach(array_diff(scandir($this->plugin->getServer()->getDataPath() . "worlds"), ["..", "."]) as $levelName) {
      if($this->plugin->getServer()->getWorldManager()->loadWorld($levelName)) {
        $this->plugin->getLogger()->notice("§e$levelName §achargé");
      }
    }
  }

}