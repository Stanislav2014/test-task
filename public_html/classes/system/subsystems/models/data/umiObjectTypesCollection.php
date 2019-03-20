<?php
 use UmiCms\Service;use UmiCms\System\Data\Object\Type\Hierarchy\iRelation;use UmiCms\System\Data\Object\Type\Hierarchy\Relation\iRepository;class umiObjectTypesCollection extends singleton implements iSingleton, iUmiObjectTypesCollection {private $types = [];protected function __construct() {}public static function getInstance($v4a8a08f09d37b73795649038408b5f33 = null) {return parent::getInstance(__CLASS__);}public function getType($vb80bb7740288fda1f201890375a60c8f) {if (!$vb80bb7740288fda1f201890375a60c8f) {return false;}if (!is_numeric($vb80bb7740288fda1f201890375a60c8f)) {$vb80bb7740288fda1f201890375a60c8f = $this->getTypeIdByGUID($vb80bb7740288fda1f201890375a60c8f);}if ($this->isLoaded($vb80bb7740288fda1f201890375a60c8f)) {return $this->types[$vb80bb7740288fda1f201890375a60c8f];}$this->loadType($vb80bb7740288fda1f201890375a60c8f);return getArrayKey($this->types, $vb80bb7740288fda1f201890375a60c8f);}public function getTypeList(array $v5a2576254d428ddc22a03fac145c8749) {$v5a2576254d428ddc22a03fac145c8749 = array_filter($v5a2576254d428ddc22a03fac145c8749, function ($vb80bb7740288fda1f201890375a60c8f) {return is_numeric($vb80bb7740288fda1f201890375a60c8f);});if (count($v5a2576254d428ddc22a03fac145c8749) == 0) {return [];}$v5a2576254d428ddc22a03fac145c8749 = array_map(function ($vb80bb7740288fda1f201890375a60c8f) {return (int) $vb80bb7740288fda1f201890375a60c8f;}, $v5a2576254d428ddc22a03fac145c8749);$v5a2576254d428ddc22a03fac145c8749 = array_unique($v5a2576254d428ddc22a03fac145c8749);$v5a2576254d428ddc22a03fac145c8749 = implode(',', $v5a2576254d428ddc22a03fac145c8749);$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
	SELECT `id`, 
		   `name`, 
		   `parent_id`, 
		   `is_locked`, 
		   `is_guidable`,
		   `is_public`, 
		   `hierarchy_type_id`, 
		   `sortable`,
		   `guid`,
		   `domain_id`
	FROM   `cms3_object_types` 
	WHERE  `id` IN ({$v5a2576254d428ddc22a03fac145c8749})
SQL;
SELECT  MIN(fg.type_id)
	FROM cms3_fields_controller fc, cms3_object_field_groups fg
	WHERE fc.field_id = {$vb80bb7740288fda1f201890375a60c8f} AND fg.id = fc.group_id
SQL;
SELECT `id` FROM `cms3_object_types` WHERE `guid` = '{$v1e0ca5b1252f1f6b1e0ac91be7e7219e}' LIMIT 0,1
SQL;
INSERT INTO cms3_object_field_groups (name, title, type_id, is_active, is_visible, ord, is_locked)
VALUES (
		'{$v4717d53ebfdfea8477f780ec66151dcb->escape($vf1965a857bc285d26fe22023aa5ab50d['name'])}',
		'{$v4717d53ebfdfea8477f780ec66151dcb->escape($vf1965a857bc285d26fe22023aa5ab50d['title'])}',
		'{$v5f694956811487225d15e973ca38fbab}',
		'{$vf1965a857bc285d26fe22023aa5ab50d['is_active']}',
		'{$vf1965a857bc285d26fe22023aa5ab50d['is_visible']}',
		'{$vf1965a857bc285d26fe22023aa5ab50d['ord']}',
		'{$vf1965a857bc285d26fe22023aa5ab50d['is_locked']}'
);
SQL;
INSERT INTO cms3_fields_controller
SELECT ord, field_id, '{$vff9cf219aa220e28c4427f9f02a4b294}' FROM cms3_fields_controller WHERE group_id = '{$v390e5b152c952a92ad629c3c8b06663f}';
SQL;
SELECT `id`
FROM `cms3_object_types`
WHERE `name` LIKE '%$vb068931cc450442b63f5b3d276ea4297%' $v62d065196a8bc83904c512f52c2300ed AND $vbf14d04db94110ef7eb9bf81e6cda0af
SQL;
SELECT `id`, `name`, `guid`, `is_locked`, `parent_id`, `is_guidable`, `is_public`, `hierarchy_type_id`, `sortable`, 
`domain_id`
FROM `cms3_object_types`
WHERE `hierarchy_type_id` = $vaa0bb62d762a477cc976e0a1bf0ce827 AND $vbf14d04db94110ef7eb9bf81e6cda0af
SQL;
SELECT id, name, guid, is_locked, parent_id, is_guidable, is_public, hierarchy_type_id, sortable, domain_id
FROM cms3_object_types;
SQL;
SELECT `id`
FROM `cms3_object_types`
LIMIT $v8c9b5763e67cd287e1e815fffa4de408, $v5a0f217f54927dfb5cb016b73d657e97;
SQL;