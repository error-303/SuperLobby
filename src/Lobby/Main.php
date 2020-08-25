<?php 

namespace Lobby;

use pocketmine\Player;
use pocketmine\Server;


use pocketmine\plugin\RegisteredListener;
	
use pocketmine\scheduler\Task;


use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use jojoe77777\FormAPI;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\FormAPI;
use jojoe77777\FormAPI\Form;
use jojoe77777\FormAPI\ModalForm;

use pocketmine\item\Item;

use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;

use pocketmine\level\sound\AnvilFallSound;
use pocketmine\level\sound\ClickSound;
use pocketmine\level\sound\AnvilUseSound;

use pocketmine\plugin\MethodEventExecutor;
use pocketmine\plugin\EventExecutor;

use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacketV2;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDeathEvent;

class Main extends PluginBase implements Listener{


public function onEnable(){
	$this->getLogger()->info("Lobby Plugin has been actived");
	
	$this->getServer()->getPluginManager()->registerEvents($this , $this);
}


	
public function onDrop(PlayerDropItemEvent $event)
{
     $event->setCancelled(true);
     $event->getPlayer()->sendMessage("§cVous ne pouvez pas drop d'item");
}

public function onJoinPlayer(PlayerJoinEvent $event){

   $player = $event->getPlayer();	
   $name = $event->getPlayer()->getName();
   $player->getInventory()->clearAll();
   $player->getArmorInventory()->clearAll();

   $event->setJoinMessage("");
	
	$player->sendMessage("§7====================");
	$player->sendMessage("§a   §l  Test");
	$player->sendMessage("§f Code by 0v3r");
	$player->sendMessage("§7====================");
	
	$player->addTitle("§aBienvenu(e) sur");
	$player->addSubTitle("§c Test");
	

   $player->getInventory()->setItem(0, Item::get(369)->setCustomName("§r§aProfile"));
   $player->getInventory()->setItem(2, Item::get(341)->setCustomName("§r§eLobby"));
   $player->getInventory()->setItem(4, Item::get(345)->setCustomName("§r§6Compas"));
   $player->getInventory()->setItem(8, Item::get(130)->setCustomName("§r§5Cosmetics"));
   $player->getInventory()->setItem(6, Item::get(399)->setCustomName("§r§aInfo"));
	
   $player->setXpLevel("2020");
   $player->setFood("20");
   $player->setMaxHealth("20");
   $player->setHealth("20");
   $player->setGamemode(2);
   $player->getlevel()->addSound(new AnvilUseSound($player));

}
	
public function onQuitPlayer(PlayerQuitEvent $event){
	$player = $event->getPlayer();
	$name = $event->getPlayer()->getName();
     


}
	
public function Hunger(PlayerExhaustEvent $event){

        $event->setCancelled(true);
    }
	
	
public function onFallDamage(EntityDamageEvent $event){

        $event->setCancelled(true);

    }

    public function onPlayerDamage(EntityDamageEvent $event){

        $event->setCancelled(true);
    }


public function onInteract(PlayerInteractEvent $ev){

	
        $player = $ev->getPlayer();
        $item = $ev->getItem();
	
	if ($player->getInventory()->getItemInHand()->getId() === 345){
		
		$this->form($player);
	
	}

}
	
	


    public function form($player){

        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	$form = $api->createSimpleForm(function (Player $player, int $data = null) {
            $result = $data; 
            if ($result === null) {
                return true;
            }
            switch ($result) {
		    
		    case 0:
                        $player->sendMessage("§cFLY");
                    break;
           
		    case 1:
                        $player->sendMessage("§c SIZE");
                    break;	    
                
		    case 2:
                        $player->sendMessage("§c SPEED");
                    break;
            }
        });
        $form->setTitle("§r§5Cosmetics");
        $form->addButton("§l§6Fly");
        $form->addButton("§l§2Size");
        $form->addButton("§l§dSpeed");
	$form->adsButton("§4EXIT");
        $form->sendToPlayer($player);
	    return $form;

    }
	
}
