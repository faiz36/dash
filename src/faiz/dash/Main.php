<?php

declare(strict_types=1);

namespace faiz\dash;

use pocketmine\block\Block;
use pocketmine\block\Lapis;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
    }

    public function Dash(Player $pl,int $power){
        $x= $pl->getDirectionVector()->x;
        $z = $pl->getDirectionVector()->z;
        $m = $pl->getMotion();
        $m->x /= 2;
        $m->y /= 2;
        $m->z /= 2;
        $m->x += $x * $power;
        $m->y += $pl->getDirectionVector()->y * $power;
        $m->z += $z * $power;
        $pl->setMotion($m);
    }

    public function onMove(PlayerMoveEvent $ev){
        $pl = $ev->getPlayer();
        $v = new Vector3($pl->getX(),$pl->getY()-1,$pl->getZ());
        if($ev->getPlayer()->getLevel()->getBlock($v)->getId() == Block::LAPIS_BLOCK||$ev->getPlayer()->getLevel()->getBlock($v)->getId() == Block::DIAMOND_BLOCK||$ev->getPlayer()->getLevel()->getBlock($v)->getId() == Block::NOTE_BLOCK){
            $this->Dash($pl,2);
        }
    }

    public function onJump(PlayerJumpEvent $ev){
        $pl = $ev->getPlayer();
        if($pl->isSneaking()){
            $x= $pl->getDirectionVector()->x;
            $z = $pl->getDirectionVector()->z;
            $m = $pl->getMotion();
            $m->x /= 2;
            $m->y /= 2;
            $m->z /= 2;
            $m->x += $x * 2;
            $m->y += $pl->getDirectionVector()->y * 1.2;
            $m->z += $z * 2;
            $pl->setMotion($m);
        }
    }

}
