<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault\Records;

use Paroxity\ParoxityVault\ParoxityVault;
use pocketmine\Player;

class Records extends BaseRecords{

	public function __construct(ParoxityVault $plugin){
		parent::__construct($plugin);

		$this->connector->executeInsert(self::UPDATE_RECORDS,
			[
				"uuid"         => "console",
				"xuid"         => "console",
				"username"     => "console",
				"display_name" => "CONSOLE",
				"ip"           => "0.0.0.0"
			]
		);
	}

	public function update(Player $player): void{
		$this->connector->executeInsert(self::UPDATE_RECORDS,
			[
				"uuid"         => $player->getUniqueId()->toString(),
				"xuid"         => $player->getXuid(),
				"username"     => $player->getName(),
				"display_name" => $player->getDisplayName(),
				"ip"           => $player->getAddress()
			]
		);
	}

	public function viaUUID(string $uuid, callable $callable): void{
		$this->connector->executeSelect(self::GET_RECORDS_VIA_UUID, ["uuid" => $uuid], $callable, function() use ($callable){
			$callable([]);
		});
	}

	public function viaUsername(string $username, callable $callable): void{
		$this->connector->executeSelect(self::GET_RECORDS_VIA_USERNAME, ["username" => $username], $callable, function() use ($callable){
			$callable([]);
		});
	}
}