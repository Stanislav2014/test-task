<?php
 use \iUmiImportRelations as iBaseSourceIdBinder;use UmiCms\System\Import\UmiDump\Helper\Entity\iSourceIdBinder;class entityImportRelations implements iSourceIdBinder {private $baseSourceIdBinder;private $connection;private $sourceId;const OBJECT_IMPORT_TABLE = 'cms3_import_objects';const TYPE_IMPORT_TABLE = 'cms3_import_types';public function __construct(iBaseSourceIdBinder $vb0b42c0e629ba26f8188e2883dbf5af7,\IConnection $v4717d53ebfdfea8477f780ec66151dcb) {$this->setBaseSourceIdBinder($vb0b42c0e629ba26f8188e2883dbf5af7)    ->setConnection($v4717d53ebfdfea8477f780ec66151dcb);}public function setSourceId($vb80bb7740288fda1f201890375a60c8f) {if (!is_numeric($vb80bb7740288fda1f201890375a60c8f)) {throw new InvalidArgumentException('Source id is not numeric');}$this->sourceId = (int) $vb80bb7740288fda1f201890375a60c8f;return $this;}public function setSourceIdByName($vb068931cc450442b63f5b3d276ea4297) {$vb80bb7740288fda1f201890375a60c8f = $this->getBaseSourceIdBinder()    ->getSourceId($vb068931cc450442b63f5b3d276ea4297);return $this->setSourceId($vb80bb7740288fda1f201890375a60c8f);}public function getSourceId() {return $this->sourceId;}public function defineRelation($v32a9d3c9a4b1449499e182e90d04fcc9, $v1c043be0eed6949c174fcf4359f7c601, $vaab9e1de16f38176f86d7a92ba337a8d) {$vb0b42c0e629ba26f8188e2883dbf5af7 = $this->getBaseSourceIdBinder();$v52195dae0174459c5f066fa0df053c26 = (int) $this->getSourceId();switch ($vaab9e1de16f38176f86d7a92ba337a8d) {case self::OBJECT_IMPORT_TABLE : {$vb0b42c0e629ba26f8188e2883dbf5af7->setObjectIdRelation($v52195dae0174459c5f066fa0df053c26, $v32a9d3c9a4b1449499e182e90d04fcc9, $v1c043be0eed6949c174fcf4359f7c601);return $this;}case self::TYPE_IMPORT_TABLE : {$vb0b42c0e629ba26f8188e2883dbf5af7->setTypeIdRelation($v52195dae0174459c5f066fa0df053c26, $v32a9d3c9a4b1449499e182e90d04fcc9, $v1c043be0eed6949c174fcf4359f7c601);return $this;}}$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();$v32a9d3c9a4b1449499e182e90d04fcc9 = $v4717d53ebfdfea8477f780ec66151dcb->escape($v32a9d3c9a4b1449499e182e90d04fcc9);$v1c043be0eed6949c174fcf4359f7c601 = (int) $v1c043be0eed6949c174fcf4359f7c601;$vaab9e1de16f38176f86d7a92ba337a8d = $v4717d53ebfdfea8477f780ec66151dcb->escape($vaab9e1de16f38176f86d7a92ba337a8d);if (!$vaab9e1de16f38176f86d7a92ba337a8d) {throw new InvalidArgumentException('Empty table');}$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
INSERT INTO `{$vaab9e1de16f38176f86d7a92ba337a8d}`
	(`external_id`, `internal_id`, `source_id`) VALUES
	('$v32a9d3c9a4b1449499e182e90d04fcc9', $v1c043be0eed6949c174fcf4359f7c601, $v52195dae0174459c5f066fa0df053c26)
SQL;
SELECT `internal_id`
FROM `{$vaab9e1de16f38176f86d7a92ba337a8d}`
WHERE
	`external_id` = '$v32a9d3c9a4b1449499e182e90d04fcc9' AND `source_id` = $v52195dae0174459c5f066fa0df053c26
LIMIT 0,1
SQL;
SELECT `external_id`
FROM `{$vaab9e1de16f38176f86d7a92ba337a8d}`
WHERE `internal_id` = $v1c043be0eed6949c174fcf4359f7c601 AND `source_id` = $v52195dae0174459c5f066fa0df053c26
LIMIT 0,1
SQL;
SELECT `internal_id`, `external_id`
FROM `{$vaab9e1de16f38176f86d7a92ba337a8d}`
WHERE `internal_id` IN ($v689f9b0d90e82b15fbd75db891fc65b5) AND `source_id` = $v52195dae0174459c5f066fa0df053c26
LIMIT 0, $v9ecb406b1bbb49e4c3dea52dc787d708
SQL;
SELECT `external_id`, `internal_id`
FROM `{$vaab9e1de16f38176f86d7a92ba337a8d}`
WHERE `external_id` IN ("$ve7143c35e910d05210552bcc5b236bc8") AND `source_id` = $v52195dae0174459c5f066fa0df053c26
LIMIT 0, $v436e747b14bd62ab16757e04b407e1fb
SQL;
SELECT `external_id` FROM `{$vaab9e1de16f38176f86d7a92ba337a8d}` 
	WHERE `source_id` != $v52195dae0174459c5f066fa0df053c26 AND `internal_id` = $v1c043be0eed6949c174fcf4359f7c601 LIMIT 0,1
SQL;