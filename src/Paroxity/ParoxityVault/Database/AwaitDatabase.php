<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault\Database;

use Generator;
use SOFe\AwaitGenerator\Await;

abstract class AwaitDatabase extends BaseDatabase{

	public function asyncGeneric(string $queryName, array $args = []): Generator{
		$this->connector->executeGeneric($queryName, $args, yield, yield Await::REJECT);

		return yield Await::ONCE;
	}

	public function asyncRawGeneric(string $queryName, array $args = []): Generator{
		$this->connector->executeGenericRaw($queryName, $args, yield, yield Await::REJECT);

		return yield Await::ONCE;
	}

	public function asyncChange(string $queryName, array $args = []): Generator{
		$this->connector->executeChange($queryName, $args, yield, yield Await::REJECT);

		return yield Await::ONCE;
	}

	public function asyncRawChange(string $queryName, array $args = []): Generator{
		$this->connector->executeChangeRaw($queryName, $args, yield, yield Await::REJECT);

		return yield Await::ONCE;
	}

	public function asyncInsert(string $queryName, array $args = []): Generator{
		$resolve = yield;

		$this->connector->executeInsert($queryName, $args, static function(int $insertId, int $affectedRows) use ($resolve): void{
			$resolve($insertId, $affectedRows);
		},
			yield Await::REJECT
		);

		return yield Await::ONCE;
	}

	public function asyncRawInsert(string $queryName, array $args = []): Generator{
		$resolve = yield;

		$this->connector->executeInsertRaw($queryName, $args, static function(int $insertId, int $affectedRows) use ($resolve): void{
			$resolve($insertId, $affectedRows);
		},
			yield Await::REJECT
		);

		return yield Await::ONCE;
	}

	public function asyncSelect(string $queryName, array $args = []): Generator{
		$this->connector->executeSelect($queryName, $args, yield, yield Await::REJECT);

		return yield Await::ONCE;
	}

	public function asyncRawSelect(string $queryName, array $args = []): ?Generator{
		$this->connector->executeSelectRaw($queryName, $args, yield, yield Await::REJECT);

		return yield Await::ONCE;
	}
}
