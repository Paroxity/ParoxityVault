<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault\Database;

use Paroxity\ParoxityVault\ParoxityVault;
use poggit\libasynql\DataConnector;

abstract class BaseDatabase{

	protected ParoxityVault $plugin;
	protected DataConnector $connector;

	public function __construct(ParoxityVault $plugin, DataConnector $connector){
		$this->plugin = $plugin;
		$this->connector = $connector;
	}

	public function getPlugin(): ParoxityVault{
		return $this->plugin;
	}

	public function getConnector(): DataConnector{
		return $this->connector;
	}
}