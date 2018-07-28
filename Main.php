<?php
namespace Test;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Cancellable;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;
class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("aktiviert");
     @mkdir($this->getDataFolder());
		$this->initConfig();
	}
	
	public function initConfig(){
		if(!file_exists($this->getDataFolder() . "settings.yml")){
			$config = new Config($this->getDataFolder() . "settings.yml", Config::YAML);
			
			$config->set("enable_chat", true);
			$config->set("message_if_disabled_chat", "The Chat is disabled!");
			$config->save();
		}
	}
	
	public function onChat(PlayerChatEvent $event){
		$player = $event->getPlayer();
		$name = $player->getName();
		$config = new Config($this->getDataFolder() . "settings.yml", Config::YAML);
		$message = $config->get("message_if_disabled_chat");
		
		if($config->get("enable_chat", true)){
			$event->setCancelled(false);
		}
		if($config->get("enable_chat", false)){
			$event->setCancelled(true);
			$player->sendMessage($message);
		}
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) :bool {
		$config = new Config($this->getDataFolder() . "settings.yml", Config::YAML);
		$name = $sender->getName();
		
		if($cmd->getName() == "chat"){
			if($args[0] == "enable"){
				$sender->sendMessage("§7[§eMineU§bChat§7] §2You activated the chat!");
				$this->getServer()->broadcastMessage("§7[§eMineU§bChat§7] §2$name enabled the chat!");
				$config->set("enable_chat", false);
				$config->save();
			}
			if($args[0] == "disable"){
				$sender->sendMessage("§7[§eMineU§bChat§7] §4You deactivated the chat!");
				$this->getServer()->broadcastMessage("§7[§eMineU§bChat§7] §4$name deactivated the chat!");
				$config->set("enable_chat", true);
				$config->save();
			}
		}
		return true;
		
	}
	
}