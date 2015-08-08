<?php

namespace StatsPlayer;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\level\particle\FloatingTextParticle;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as F;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\Server;
use pocketmine\scheduler\CallbackTask;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\block\BlockBreakEvent;

class main extends PluginBase implements Listener{
 private $function_mps, $timer, $target, $EconomyS;
 
 public function onEnable(){
 $this->getServer()->getPluginManager()->registerEvents($this, $this);
 $this->EconomyS = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
 $this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "sbs_stats")), 10);
 $this->timer = 0;
 }
 
 public function sbs_stats(){
 foreach($this->getServer()->getOnlinePlayers() as $p){
 $pName = $p->getPlayer()->getName();
 $pMoney = $this->EconomyS->mymoney($pName);
 $pOnline = count(Server::getInstance()->getOnlinePlayers());
 $pFull = $this->getServer()->getMaxPlayers();
 $p->sendTip(" §e==§4StatsPlayer§e==\n §3Welcome,§b $pName !\n §aMoney$:§f $pMoney §2$\n §6ОnlinePlayer:§d $pOnline §e/§d $pFull");
 }
 }
}
