<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault\Records;

use pocketmine\Player;

class NameRecords extends BaseRecords{
	
	public function update(Player $player): void{
		$this->connector->executeInsert(self::UPDATE_NAME_RECORDS,
			[
				"id"           => $player->getDisplayName() . ":" . $player->getUniqueId()->toString(),
				"uuid"         => $player->getUniqueId()->toString(),
				"display_name" => $player->getDisplayName()
			]
		);
	}

	public function viaUUID(string $uuid, callable $callable): void{
		$this->connector->executeSelect(self::GET_NAME_RECORDS_VIA_UUID, ["uuid" => $uuid], $callable, function() use ($callable){
			$callable(-1);
		});
	}

	/**
	 * The callable will contain display_names => username
	 */
	public function viaDisplayName(string $displayName, callable $callable): void{
		$this->connector->executeSelect(self::GET_NAME_RECORDS_VIA_DISPLAY_NAME, ["display_name" => $displayName], $callable, function() use ($callable){
			$callable(-1);
		});
	}

	public function viaUsername(string $username, callable $callable): void{
		$this->connector->executeSelect(self::GET_NAME_RECORDS_VIA_USERNAME, ["username" => $username], $callable, function() use ($callable){
			$callable(-1);
		});
	}
}