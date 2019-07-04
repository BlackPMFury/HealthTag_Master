<?php

namespace NametagSV\PlayerName;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\{Player, Server};
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\untils\Config;
use jojoe7777\FormAPI;

class Main extends PluginBase implements Listener{
  public $tag = "Nametag•System";
  public $config;
  
  public function onEnable(){
    $this->getServer()->getLogger()->info($this->tag . "Enable Plugin....");
    $this->nt = new Config($this->getDataFolder() . "Nametag.yml", Config::YAML, []);
    $this->nt->save();
  }
  
  public function onJoin(PlayerJoinEvent $ev){
    $player = $ev->getPlayer();
    $name = $player->getName();
    $heal = $player->getHealth();
    $this->nt->set($name, ["Health" => $heal]);
    $this->nt->save();
    $player->getNameTag($ev->setNametag("Health:". $heal));
  }
}
