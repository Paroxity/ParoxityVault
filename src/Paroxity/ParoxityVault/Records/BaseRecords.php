<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault\Records;

use Paroxity\ParoxityVault\ParoxityVault;
use poggit\libasynql\DataConnector;

abstract class BaseRecords implements RecordsQuery{

	protected ParoxityVault $plugin;
	protected DataConnector $connector;

	public function __construct(ParoxityVault $plugin){
		$this->plugin = $plugin;
		$this->connector = $plugin->getDatabase()->getConnector();
	}

	public function getPlugin(): ParoxityVault{
		return $this->plugin;
	}

	public function getConnector(): DataConnector{
		return $this->connector;
	}
}