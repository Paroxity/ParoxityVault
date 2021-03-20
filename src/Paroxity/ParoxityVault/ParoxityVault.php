<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault;

use Paroxity\ParoxityVault\Database\VaultDatabase;
use Paroxity\ParoxityVault\Records\NameRecords;
use Paroxity\ParoxityVault\Records\Records;
use pocketmine\plugin\PluginBase;

class ParoxityVault extends PluginBase{

	private VaultDatabase $database;

	private Records $records;
	private NameRecords $nameRecords;

	public function onEnable(){
		$this->saveDefaultConfig();

		$this->database = new VaultDatabase($this);

		$this->records = new Records($this);
		$this->nameRecords = new NameRecords($this);

		$this->getServer()->getPluginManager()->registerEvents(new VaultListener($this), $this);
	}

	public function onDisable(){
		$this->database->close();
	}

	public function getDatabase(): VaultDatabase{
		return $this->database;
	}

	public function getRecords(): Records{
		return $this->records;
	}

	public function getNameRecords(): NameRecords{
		return $this->nameRecords;
	}
}