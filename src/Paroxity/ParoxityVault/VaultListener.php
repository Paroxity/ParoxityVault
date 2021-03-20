<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class VaultListener implements Listener{

	private ParoxityVault $plugin;

	public function __construct(ParoxityVault $plugin){
		$this->plugin = $plugin;
	}

	/**
	 * @prioirty LOWEST
	 */
	public function onJoin(PlayerJoinEvent $event){
		$this->plugin->getRecords()->update($event->getPlayer());
		$this->plugin->getNameRecords()->update($event->getPlayer());
	}

	public function onQuit(PlayerQuitEvent $event){
		$this->plugin->getRecords()->update($event->getPlayer());
		$this->plugin->getNameRecords()->update($event->getPlayer());
	}

	//TODO: listen for player display name changes
}