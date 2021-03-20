<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault\Database;

use Paroxity\ParoxityVault\ParoxityVault;
use Paroxity\ParoxityVault\Records\RecordsQuery;
use poggit\libasynql\libasynql;

final class VaultDatabase extends AwaitDatabase{

	public const TYPE_MYSQL = "mysql";
	public const TYPE_SQLITE = "sqlite";

	private static string $type = self::TYPE_MYSQL;

	public function __construct(ParoxityVault $plugin){
		$config = $plugin->getConfig();

		self::$type = (string) $config->getNested("database.type", "mysql");

		$connector = libasynql::create(
			$plugin,
			$config->get("database"),
			[
				"mysql" => "stmts/mysql/sql.sql"
			]
		);

		parent::__construct($plugin, $connector); // this needs to be called before the next

		self::loadQueryFile($plugin->getResource("stmts/mysql/records/records.sql"));
		self::loadQueryFile($plugin->getResource("stmts/mysql/records/name_records.sql"));

		$connector->executeGeneric(RecordsQuery::INIT_RECORDS);
		$connector->executeGeneric(RecordsQuery::INIT_NAME_RECORDS);
		$connector->waitAll();
	}

	/**
	 * Returns the database type selected in the config
	 *
	 * Either TYPE_MYSQL or TYPE_SQLITE
	 */
	public static function getType(): string{
		return self::$type;
	}

	/**
	 * Only load queries of the database type selected
	 *
	 * @param resource $fh
	 */
	public static function loadQueryFile($fh, string $type = self::TYPE_MYSQL, string $fileName = null) : void{
		if(self::$type !== $type){
			return;
		}

		ParoxityVault::getInstance()->getDatabase()->getConnector()->loadQueryFile($fh, $fileName);
	}

	public function close(): void{
		$this->connector->close();
		$this->connector->waitAll();
	}
}