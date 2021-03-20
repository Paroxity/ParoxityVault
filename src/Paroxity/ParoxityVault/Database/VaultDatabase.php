<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault\Database;

use Paroxity\ParoxityVault\ParoxityVault;
use Paroxity\ParoxityVault\Records\RecordsQuery;
use poggit\libasynql\libasynql;

class VaultDatabase extends AwaitDatabase{

	public function __construct(ParoxityVault $vault){
		$config = $vault->getConfig();

		$connector = libasynql::create(
			$vault,
			$config->get("database"),
			[
				"mysql" => "stmts/mysql/sql.sql"
			]
		);

		$connector->loadQueryFile($vault->getResource("stmts/mysql/records/records.sql"));
		$connector->loadQueryFile($vault->getResource("stmts/mysql/records/name_records.sql"));
		$connector->executeGeneric(RecordsQuery::INIT_RECORDS);
		$connector->executeGeneric(RecordsQuery::INIT_NAME_RECORDS);
		$connector->waitAll();

		parent::__construct($vault, $connector);
	}

	public function close(): void{
		$this->connector->close();
		$this->connector->waitAll();
	}
}