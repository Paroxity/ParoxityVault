<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault\Database;

use Paroxity\ParoxityVault\ParoxityVault;
use poggit\libasynql\DataConnector;

abstract class BaseDatabase{

	protected ParoxityVault $vault;
	protected DataConnector $connector;

	public function __construct(ParoxityVault $vault, DataConnector $connector){
		$this->vault = $vault;
		$this->connector = $connector;
	}

	public function getVault(): ParoxityVault{
		return $this->vault;
	}

	public function getConnector(): DataConnector{
		return $this->connector;
	}
}