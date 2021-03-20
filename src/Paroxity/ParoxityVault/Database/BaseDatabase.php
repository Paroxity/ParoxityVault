<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault\Database;

use poggit\libasynql\DataConnector;

abstract class BaseDatabase{

	protected DataConnector $connector;

	public function __construct(DataConnector $connector){
		$this->connector = $connector;
	}

	public function getConnector(): DataConnector{
		return $this->connector;
	}
}