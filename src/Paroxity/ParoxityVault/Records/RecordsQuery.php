<?php
declare(strict_types = 1);

namespace Paroxity\ParoxityVault\Records;

interface RecordsQuery{

	public const INIT_RECORDS             = "records.init";
	public const UPDATE_RECORDS           = "records.update";
	public const GET_RECORDS_VIA_UUID     = "records.get.via-uuid";
	public const GET_RECORDS_VIA_USERNAME = "records.get.via-username";

	public const INIT_NAME_RECORDS                 = "name_records.init";
	public const UPDATE_NAME_RECORDS               = "name_records.update";
	public const GET_NAME_RECORDS_VIA_UUID         = "name_records.get.via-uuid";
	public const GET_NAME_RECORDS_VIA_DISPLAY_NAME = "name_records.get.via-display_name";
	public const GET_NAME_RECORDS_VIA_USERNAME     = "name_records.get.via-username";

}