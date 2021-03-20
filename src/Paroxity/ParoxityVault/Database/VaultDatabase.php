<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault\Database;

use Paroxity\ParoxityVault\ParoxityVault;
use Paroxity\ParoxityVault\Records\RecordsQuery;
use poggit\libasynql\libasynql;

final class VaultDatabase extends AwaitDatabase{

	public function __construct(ParoxityVault $plugin){
		$config = $plugin->getConfig();

		$connector = libasynql::create(
			$plugin,
			$config->get("database"),
			[
				"mysql" => "stmts/mysql/sql.sql"
			]
		);

		$connector->loadQueryFile($plugin->getResource("stmts/mysql/records/records.sql"));
		$connector->loadQueryFile($plugin->getResource("stmts/mysql/records/name_records.sql"));
		$connector->executeGeneric(RecordsQuery::INIT_RECORDS);
		$connector->executeGeneric(RecordsQuery::INIT_NAME_RECORDS);
		$connector->waitAll();

		parent::__construct($connector);
	}

	public function close(): void{
		$this->connector->close();
		$this->connector->waitAll();
	}
}