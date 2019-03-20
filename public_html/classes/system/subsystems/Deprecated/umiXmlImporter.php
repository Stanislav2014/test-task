<?php
 class umiXmlImporter implements iUmiXmlImporter {protected $ignore_new_fields = false,   $ignore_new_items = false,   $is_xml_analyzed = false;protected $xml;protected $xml_elements = [],   $xml_objects = [],   $xml_stores = [],   $xml_types = [];protected $source_id = 1;protected $importedElements = 0,   $importedElementsArr = [],   $createdElements = 0,   $deletedElements = 0,   $updatedElements = 0,   $importErrors = 0;protected $importLog = [];protected $destination_element_id = 0;public function __construct() {}public function setDestinationElementId($v8e2dcfd7e7e24b1ca76c1193f645902b) {if ($v8e2dcfd7e7e24b1ca76c1193f645902b instanceof umiHierarchyElement) {$this->destination_element_id = $v8e2dcfd7e7e24b1ca76c1193f645902b->getId();return true;}if (umiHierarchy::getInstance()->getElement($v8e2dcfd7e7e24b1ca76c1193f645902b) instanceof umiHierarchyElement) {$this->destination_element_id = $v8e2dcfd7e7e24b1ca76c1193f645902b;return true;}return false;}public function ignoreNewFields($v16766072928ade37ad6cfb3f5f3a1b92 = null) {$vee59c1569ba29f1d7595628815a773a5 = $this->ignore_new_fields;if (!is_null($v16766072928ade37ad6cfb3f5f3a1b92)) {$this->ignore_new_fields = (bool) $v16766072928ade37ad6cfb3f5f3a1b92;}return $vee59c1569ba29f1d7595628815a773a5;}public function ignoreNewItems($ve90cfd0adc4ee5f162118a96c60bc216 = null) {$vee59c1569ba29f1d7595628815a773a5 = $this->ignore_new_items;if (!is_null($ve90cfd0adc4ee5f162118a96c60bc216)) {$this->ignore_new_items = (bool) $ve90cfd0adc4ee5f162118a96c60bc216;}return $vee59c1569ba29f1d7595628815a773a5;}public function loadXmlString($v2d04a630b197c6991c3e00e003f88be4) {$v0f635d0e0f3874fff8b581c132e6c7a7 = simplexml_load_string($v2d04a630b197c6991c3e00e003f88be4);return $this->loadXml($v0f635d0e0f3874fff8b581c132e6c7a7);}public function loadXmlFile($va30c2e8bafac20e81c697b2396c8a3b0) {if (!is_file($va30c2e8bafac20e81c697b2396c8a3b0)) {trigger_error("XML file {$va30c2e8bafac20e81c697b2396c8a3b0} not found", E_USER_WARNING);return false;}if (!is_readable($va30c2e8bafac20e81c697b2396c8a3b0)) {trigger_error("XML file {$va30c2e8bafac20e81c697b2396c8a3b0} is not readable", E_USER_WARNING);return false;}$v0f635d0e0f3874fff8b581c132e6c7a7 = simplexml_load_file($va30c2e8bafac20e81c697b2396c8a3b0);return $this->loadXml($v0f635d0e0f3874fff8b581c132e6c7a7);}protected function loadXml($v0f635d0e0f3874fff8b581c132e6c7a7) {if (is_object($v0f635d0e0f3874fff8b581c132e6c7a7)) {$this->xml = $v0f635d0e0f3874fff8b581c132e6c7a7;return true;}else {trigger_error("Failed to read xml-content", E_USER_WARNING);return false;}}public function analyzeXml() {$va3e987edaf3270b0a5b8b012ea24688f = (string) $this->xml->sourceId;$this->source_id = umiImportRelations::getInstance()->addNewSource($va3e987edaf3270b0a5b8b012ea24688f);foreach ($this->xml->element as $v6b5e36ca20d9b7f16d58365fbb6666cc) {$this->analyzeElementNode($v6b5e36ca20d9b7f16d58365fbb6666cc);}foreach ($this->xml->object as $v6b5e36ca20d9b7f16d58365fbb6666cc) {$va9cecbe3552e2561ce80cf4fe36d259c = (string) $v6b5e36ca20d9b7f16d58365fbb6666cc->attributes()->id;if (array_key_exists($va9cecbe3552e2561ce80cf4fe36d259c, $this->xml_objects)) {$this->analyzeObjectNode($v6b5e36ca20d9b7f16d58365fbb6666cc);}}}protected function analyzeElementNode(SimpleXMLElement $vdafb8b287b8f84de951377d662f0bb07) {$v7057e8409c7c531a1a6e9ac3df4ed549 = (string) $vdafb8b287b8f84de951377d662f0bb07->attributes()->id;$v99babaa1f2d4129d12be54e74769f513 = (string) $vdafb8b287b8f84de951377d662f0bb07->attributes()->parentId;$v95f4ed1eb77470b0ab298fe5f354a1d2 = (string) $vdafb8b287b8f84de951377d662f0bb07->attributes()->objectId;$v6047ed7401a9473da4179b068871e34f = (string) $vdafb8b287b8f84de951377d662f0bb07->altName;$v712546bad453a4d99cb79be316f6e64b =    is_object($vdafb8b287b8f84de951377d662f0bb07->attributes()->is_visible) ? (string) $vdafb8b287b8f84de951377d662f0bb07->attributes()->is_visible : null;$v53f070b923b86cc3c1b95e9950674c7c =    is_object($vdafb8b287b8f84de951377d662f0bb07->attributes()->is_active) ? (string) $vdafb8b287b8f84de951377d662f0bb07->attributes()->is_active : null;$v25f5c3dfce7a3048a8e9f70bad15bdd3 =    is_object($vdafb8b287b8f84de951377d662f0bb07->attributes()->is_deleted) ? (string) $vdafb8b287b8f84de951377d662f0bb07->attributes()->is_deleted : null;if (in_array($v7057e8409c7c531a1a6e9ac3df4ed549, $this->importedElementsArr)) {return false;}$v22884db148f0ffb0d830ba431102b0b5 = $vdafb8b287b8f84de951377d662f0bb07->behaviour->module;$vea9f6aca279138c58f705c8d4cb4b8ce = $vdafb8b287b8f84de951377d662f0bb07->behaviour->method;$v108f182d36befa7e9828ecfa700cef7d =    umiHierarchyTypesCollection::getInstance()->getTypeByName((string) $v22884db148f0ffb0d830ba431102b0b5, (string) $vea9f6aca279138c58f705c8d4cb4b8ce);if ($v108f182d36befa7e9828ecfa700cef7d === false) {trigger_error("Unknown element's module/method", E_USER_ERROR);return false;}$v676e8343c1739a5f3d8893a0ebdf5d63 = (string) $vdafb8b287b8f84de951377d662f0bb07->templatePath;$v42e506e228f21138f6dda1d82cbba619 = $v108f182d36befa7e9828ecfa700cef7d->getId();$this->xml_elements[$v7057e8409c7c531a1a6e9ac3df4ed549] = [    "old_element_id" => $v7057e8409c7c531a1a6e9ac3df4ed549,    "old_parent_id" => $v99babaa1f2d4129d12be54e74769f513,    "old_element_object_id" => $v95f4ed1eb77470b0ab298fe5f354a1d2,    "element_hierarchy_type_id" => $v42e506e228f21138f6dda1d82cbba619,    "element_filepath" => $v676e8343c1739a5f3d8893a0ebdf5d63,    "old_element_alt_name" => $v6047ed7401a9473da4179b068871e34f,    "element_is_visible" => $v712546bad453a4d99cb79be316f6e64b,    "element_is_active" => $v53f070b923b86cc3c1b95e9950674c7c,    "element_is_deleted" => $v25f5c3dfce7a3048a8e9f70bad15bdd3   ];$this->xml_objects[$v95f4ed1eb77470b0ab298fe5f354a1d2] = [    "old_element_id" => $v7057e8409c7c531a1a6e9ac3df4ed549,    "element_hierarcy_type_id" => $v42e506e228f21138f6dda1d82cbba619,    "is_linked" => true   ];}protected function analyzeObjectNode(SimpleXMLElement $vbfb9b1cd25f05560dfdda8bca7dac185) {$vaf31437ce61345f416579830a98c91e5 = (string) $vbfb9b1cd25f05560dfdda8bca7dac185->attributes()->id;$v87306dd4235ed712ebc07fe169b76f83 = (string) $vbfb9b1cd25f05560dfdda8bca7dac185->attributes()->typeId;$vedc7225bd4c7ca9e2cab1d7126aa5c66 = (string) $vbfb9b1cd25f05560dfdda8bca7dac185->attributes()->typeName;$vac1626d9f9d3685491cc6c06cf195a3d = $this->xml_objects[$vaf31437ce61345f416579830a98c91e5];$vac1626d9f9d3685491cc6c06cf195a3d['old_object_id'] = $vaf31437ce61345f416579830a98c91e5;$vac1626d9f9d3685491cc6c06cf195a3d['old_type_id'] = $v87306dd4235ed712ebc07fe169b76f83;$vac1626d9f9d3685491cc6c06cf195a3d['type_name'] = $vedc7225bd4c7ca9e2cab1d7126aa5c66;$vac1626d9f9d3685491cc6c06cf195a3d['old_name'] = (string) $vbfb9b1cd25f05560dfdda8bca7dac185->name;$vac1626d9f9d3685491cc6c06cf195a3d['props'] = $this->analyzeObjectPropertiesBlockNode($vbfb9b1cd25f05560dfdda8bca7dac185->propertiesBlock, $v87306dd4235ed712ebc07fe169b76f83);if ($vbfb9b1cd25f05560dfdda8bca7dac185->storesBlock->store) {$this->analyzeObjectSoresInfo($vaf31437ce61345f416579830a98c91e5, $vbfb9b1cd25f05560dfdda8bca7dac185->storesBlock->store);}$this->xml_objects[$vaf31437ce61345f416579830a98c91e5] = $vac1626d9f9d3685491cc6c06cf195a3d;}protected function analyzeObjectPropertiesBlockNode(   SimpleXMLElement $v198e8116ae17465abca88e97f359b81a,   $v87306dd4235ed712ebc07fe169b76f83  ) {if (!array_key_exists($v87306dd4235ed712ebc07fe169b76f83, $this->xml_types)) {$this->xml_types[$v87306dd4235ed712ebc07fe169b76f83] = [];$this->xml_types[$v87306dd4235ed712ebc07fe169b76f83]['is_base'] = true;$this->xml_types[$v87306dd4235ed712ebc07fe169b76f83]['props'] = [];}$v1a9413baa5cb34046f8b2472dc0382c8 = [];foreach ($v198e8116ae17465abca88e97f359b81a as $vfe53ab6ad20b6c24efeeb7c181ad88c1) {$v271d58c8413c3b66c32d16e54cc452ba = (string) $vfe53ab6ad20b6c24efeeb7c181ad88c1->title;$v161c76bbd5a451c8a6b9eb76ee6b6498 = (string) $vfe53ab6ad20b6c24efeeb7c181ad88c1->name;$vf0f68d8e24c9280eacba0ba7c3ddc0a6 = (string) $vfe53ab6ad20b6c24efeeb7c181ad88c1->isPublic;foreach ($vfe53ab6ad20b6c24efeeb7c181ad88c1->property as $v3694d39d4419096025f79a7e72a2a43f) {$vb93ab79a25fda37f76a5beb706e7999b = (string) $v3694d39d4419096025f79a7e72a2a43f->title;$vdfc394bd05a4b48161c790034af522a8 = (string) $v3694d39d4419096025f79a7e72a2a43f->name;$vfa041bc0a81b4595e902278f42cbf9d4 = (string) $v3694d39d4419096025f79a7e72a2a43f->tip;$v654741aedfca3e4fc2f0f0246e8c3bd8 = (string) $v3694d39d4419096025f79a7e72a2a43f->isMultiple;$vd32d563354e11708656be8c192a1b235 = (string) $v3694d39d4419096025f79a7e72a2a43f->isIndexed;$v57563115e8f09aa8368e898c2bfe62e0 = (string) $v3694d39d4419096025f79a7e72a2a43f->isFilterable;$v994d25f616e2141faa36e4eed03d7d47 = (string) $v3694d39d4419096025f79a7e72a2a43f->isPublic;$v994d25f616e2141faa36e4eed03d7d47 = (bool) $v3694d39d4419096025f79a7e72a2a43f->isPublic;$v1568d7dc6933bac8766232a78173c400 = (string) $v3694d39d4419096025f79a7e72a2a43f->guideId;$ve48c0b9cb2ae62c695b02c2950304cc3 = (string) $v3694d39d4419096025f79a7e72a2a43f->fieldType;$v8b2a89413a23bcdc2fa4f48518266787 = $this->extractValues($v3694d39d4419096025f79a7e72a2a43f->values);$v52e3817fff5250b5391ef85b1ce23bdb = (string) $v3694d39d4419096025f79a7e72a2a43f->values->attributes()->currency_code;if (!$vdfc394bd05a4b48161c790034af522a8) {$vdfc394bd05a4b48161c790034af522a8 = translit::convert($vb93ab79a25fda37f76a5beb706e7999b);}$v410e0a26c217dfabf8a5653e8f9e68ef = [];$v410e0a26c217dfabf8a5653e8f9e68ef['title'] = $vb93ab79a25fda37f76a5beb706e7999b;$v410e0a26c217dfabf8a5653e8f9e68ef['name'] = $vdfc394bd05a4b48161c790034af522a8;$v410e0a26c217dfabf8a5653e8f9e68ef['tip'] = $vfa041bc0a81b4595e902278f42cbf9d4;$v410e0a26c217dfabf8a5653e8f9e68ef['is_multiple'] = $v654741aedfca3e4fc2f0f0246e8c3bd8;$v410e0a26c217dfabf8a5653e8f9e68ef['is_filterable'] = $v57563115e8f09aa8368e898c2bfe62e0;$v410e0a26c217dfabf8a5653e8f9e68ef['guide_id'] = $v1568d7dc6933bac8766232a78173c400;$v410e0a26c217dfabf8a5653e8f9e68ef['field_type'] = $ve48c0b9cb2ae62c695b02c2950304cc3;$v410e0a26c217dfabf8a5653e8f9e68ef['values'] = $v8b2a89413a23bcdc2fa4f48518266787;$v410e0a26c217dfabf8a5653e8f9e68ef['currency_code'] = $v52e3817fff5250b5391ef85b1ce23bdb;$v410e0a26c217dfabf8a5653e8f9e68ef['is_public'] = $v994d25f616e2141faa36e4eed03d7d47;$v410e0a26c217dfabf8a5653e8f9e68ef['prop_block_title'] = $v271d58c8413c3b66c32d16e54cc452ba;$v410e0a26c217dfabf8a5653e8f9e68ef['prop_block_name'] = $v161c76bbd5a451c8a6b9eb76ee6b6498;$v410e0a26c217dfabf8a5653e8f9e68ef['prop_block_is_public'] = $vf0f68d8e24c9280eacba0ba7c3ddc0a6;$this->xml_types[$v87306dd4235ed712ebc07fe169b76f83]['props'][$vdfc394bd05a4b48161c790034af522a8] = $v410e0a26c217dfabf8a5653e8f9e68ef;$v1a9413baa5cb34046f8b2472dc0382c8[$vdfc394bd05a4b48161c790034af522a8] = $v410e0a26c217dfabf8a5653e8f9e68ef;}}return $v1a9413baa5cb34046f8b2472dc0382c8;}protected function analyzeObjectSoresInfo($va77b1053cb200e022574f213c7553d88, SimpleXMLElement $v95baf4199d5b9b51afa6d4dd8468adb2) {foreach ($v95baf4199d5b9b51afa6d4dd8468adb2 as $ved5882848050676ac4477bf1b46ca2b4) {$v5d7d58f9cd945f9f3eb551a83caa0c42 = (string) $ved5882848050676ac4477bf1b46ca2b4->attributes()->id;$vbd047b181e82cec3af1400e7ee193be5 = (int) $ved5882848050676ac4477bf1b46ca2b4->amount;if (strlen($v5d7d58f9cd945f9f3eb551a83caa0c42)) {$v5d7d58f9cd945f9f3eb551a83caa0c42 = $v5d7d58f9cd945f9f3eb551a83caa0c42;if (!isset($this->xml_stores[$va77b1053cb200e022574f213c7553d88])) {$this->xml_stores[$va77b1053cb200e022574f213c7553d88] = [];}$v57f6446eb03e6af4fa631be4795f0c9b = [];$v57f6446eb03e6af4fa631be4795f0c9b['old_store_id'] = $v5d7d58f9cd945f9f3eb551a83caa0c42;$v57f6446eb03e6af4fa631be4795f0c9b['amount'] = $vbd047b181e82cec3af1400e7ee193be5;$this->xml_stores[$va77b1053cb200e022574f213c7553d88][] = $v57f6446eb03e6af4fa631be4795f0c9b;}}}protected function extractValues($v60a3282b31e7a1e46163b55fce49cc71) {$v9b207167e5381c47682c6b4f58a623fb = [];if (!$v60a3282b31e7a1e46163b55fce49cc71->value) {return [];}foreach ($v60a3282b31e7a1e46163b55fce49cc71->value as $v67236e502346412a98a0bb965b7a59e6) {$vd7e6d55ba379a13d08c25d15faf2a23b = ((string) $v67236e502346412a98a0bb965b7a59e6->timestamp[0]);$v3a6d0284e743dc4a9b86f97d6dd1a3bf = ((string) $v67236e502346412a98a0bb965b7a59e6);if ($vd7e6d55ba379a13d08c25d15faf2a23b) {$v3a6d0284e743dc4a9b86f97d6dd1a3bf = new umiDate();$v3a6d0284e743dc4a9b86f97d6dd1a3bf->setDateByTimeStamp($vd7e6d55ba379a13d08c25d15faf2a23b);}if ($v3a6d0284e743dc4a9b86f97d6dd1a3bf) {$v9b207167e5381c47682c6b4f58a623fb[] = $v3a6d0284e743dc4a9b86f97d6dd1a3bf;}}return $v9b207167e5381c47682c6b4f58a623fb;}protected function detectBetterFieldType($v2063c1608d6e0baf80249c42e2be5804) {}protected function detectBetterObjectType($v0715f6d9497f93911417c9c324265771, $v5f6492d9717ccf1b8566bd4bc64110b6, $vb061ac7561555582525d2977444ea3f5 = "") {$vd05b6ed7d2345020440df396d6da7f73 = array_keys($this->xml_types[$v5f6492d9717ccf1b8566bd4bc64110b6]['props']);$v69203671ddb68b3848f87700fe06de55 = umiImportRelations::getInstance()->getNewTypeIdRelation($this->source_id, $v5f6492d9717ccf1b8566bd4bc64110b6);if ($v69203671ddb68b3848f87700fe06de55) {return $v69203671ddb68b3848f87700fe06de55;}$vd14a8022b085f9ef19d479cbdd581127 = umiObjectTypesCollection::getInstance()->getTypesByHierarchyTypeId($v0715f6d9497f93911417c9c324265771);$v85a0d697cef37e3885323fd9088343b0 = umiObjectTypesCollection::getInstance()->getTypeIdByHierarchyTypeId($v0715f6d9497f93911417c9c324265771);foreach ($vd14a8022b085f9ef19d479cbdd581127 as $v94757cae63fd3e398c0811a976dd6bbe => $v22178d66649d30b18a7e4e331dc778ce) {$v5cfd9480c9d94f569a3c2847c3eb9639 = $this->compareObjectTypeFields($v94757cae63fd3e398c0811a976dd6bbe, $vd05b6ed7d2345020440df396d6da7f73);if ($v5cfd9480c9d94f569a3c2847c3eb9639 == 0) {$v69203671ddb68b3848f87700fe06de55 = $v94757cae63fd3e398c0811a976dd6bbe;break;}}if (!$v69203671ddb68b3848f87700fe06de55) {$v676c8cf12853cb65368bba87aead6387 = umiObjectTypesCollection::getInstance()->getType($v85a0d697cef37e3885323fd9088343b0)->getName();if (!$vb061ac7561555582525d2977444ea3f5 || !strlen($vb061ac7561555582525d2977444ea3f5)) {$vb061ac7561555582525d2977444ea3f5 = "Подтип \"{$v676c8cf12853cb65368bba87aead6387}\" #{$v5f6492d9717ccf1b8566bd4bc64110b6}";}$v69203671ddb68b3848f87700fe06de55 = umiObjectTypesCollection::getInstance()->addType($v85a0d697cef37e3885323fd9088343b0, $vb061ac7561555582525d2977444ea3f5);$v201620107bc2a3a690ce849a2380064a = umiObjectTypesCollection::getInstance()->getType($v69203671ddb68b3848f87700fe06de55);$v201620107bc2a3a690ce849a2380064a->setHierarchyTypeId($v0715f6d9497f93911417c9c324265771);$v201620107bc2a3a690ce849a2380064a->commit();}umiImportRelations::getInstance()->setTypeIdRelation($this->source_id, $v5f6492d9717ccf1b8566bd4bc64110b6, $v69203671ddb68b3848f87700fe06de55);return $v69203671ddb68b3848f87700fe06de55;}protected function compareObjectTypeFields($v87306dd4235ed712ebc07fe169b76f83, $vd05b6ed7d2345020440df396d6da7f73) {$v7ae7003da59ae71dcc9f8638ef50593d = umiObjectTypesCollection::getInstance()->getType($v87306dd4235ed712ebc07fe169b76f83);if ($v7ae7003da59ae71dcc9f8638ef50593d === false) {trigger_error("Object type #{$v87306dd4235ed712ebc07fe169b76f83} not found", E_USER_ERROR);return false;}$v5cfd9480c9d94f569a3c2847c3eb9639 = 0;foreach ($vd05b6ed7d2345020440df396d6da7f73 as $v73f329f154a663bfda020aadcdd0b775) {if ($v7ae7003da59ae71dcc9f8638ef50593d->getFieldId($v73f329f154a663bfda020aadcdd0b775) == false) {++$v5cfd9480c9d94f569a3c2847c3eb9639;}}return $v5cfd9480c9d94f569a3c2847c3eb9639;}protected function detectBetterTemplateId($v6a2a431fe8b621037ea949531c28551d) {if ($v6a2a431fe8b621037ea949531c28551d) {$v662cbf1253ac7d8750ed9190c52163e5 = cmsController::getInstance()->getCurrentDomain()->getId();$v78e6dd7a49f5b0cb2106a3a434dd5c86 = cmsController::getInstance()->getCurrentLang()->getId();$vfed36e93a0509e20f2dc96cbbd85b678 = templatesCollection::getInstance()->getTemplatesList($v662cbf1253ac7d8750ed9190c52163e5, $v78e6dd7a49f5b0cb2106a3a434dd5c86);foreach ($vfed36e93a0509e20f2dc96cbbd85b678 as $v4f96c7bc828b57b4a3b2b327a7a183c6) {if ($v4f96c7bc828b57b4a3b2b327a7a183c6->getFilename() == $v6a2a431fe8b621037ea949531c28551d) {return $v4f96c7bc828b57b4a3b2b327a7a183c6->getId();}}}return templatesCollection::getInstance()->getDefaultTemplate()->getId();}public function importXml() {foreach ($this->xml_elements as $vfc07ae6b81515e9c73cb36ac08488ca1) {$v0715f6d9497f93911417c9c324265771 = $vfc07ae6b81515e9c73cb36ac08488ca1['element_hierarchy_type_id'];$va9cecbe3552e2561ce80cf4fe36d259c = $vfc07ae6b81515e9c73cb36ac08488ca1['old_element_object_id'];$v2741adf691b2acf0359a6a73234bc605 = $this->xml_objects[$va9cecbe3552e2561ce80cf4fe36d259c]['old_type_id'];$v22178d66649d30b18a7e4e331dc778ce = $this->xml_objects[$va9cecbe3552e2561ce80cf4fe36d259c]['type_name'];$vfc07ae6b81515e9c73cb36ac08488ca1['old_type_id'] = $v2741adf691b2acf0359a6a73234bc605;$vfc07ae6b81515e9c73cb36ac08488ca1['new_type_id'] =    $v69203671ddb68b3848f87700fe06de55 = $this->detectBetterObjectType($v0715f6d9497f93911417c9c324265771, $v2741adf691b2acf0359a6a73234bc605, $v22178d66649d30b18a7e4e331dc778ce);$vfc07ae6b81515e9c73cb36ac08488ca1['new_tpl_id'] =    $ve274c3c0bb91d6582078fbbce8f388f6 = $this->detectBetterTemplateId($vfc07ae6b81515e9c73cb36ac08488ca1['element_filepath']);$vfc07ae6b81515e9c73cb36ac08488ca1['new_lang_id'] = cmsController::getInstance()->getCurrentLang()->getId();$vfc07ae6b81515e9c73cb36ac08488ca1['new_domain_id'] = cmsController::getInstance()->getCurrentDomain()->getId();$vfc07ae6b81515e9c73cb36ac08488ca1['element_name'] = $this->xml_objects[$va9cecbe3552e2561ce80cf4fe36d259c]['old_name'];$this->importElement($vfc07ae6b81515e9c73cb36ac08488ca1);}}protected function importElement($vfc07ae6b81515e9c73cb36ac08488ca1) {$this->importedElements += 1;$v2114c8075d855b3cea53d5d880c68948 = $vfc07ae6b81515e9c73cb36ac08488ca1['old_element_id'];$v75cacdb2219ff0da09cc2f909ea64759 = $vfc07ae6b81515e9c73cb36ac08488ca1['old_element_object_id'];$v777ccf80e4e83a9e7cdddd6ebc1edff7 = umiImportRelations::getInstance()->getNewIdRelation($this->source_id, $v2114c8075d855b3cea53d5d880c68948);$v161c9aaa4fe035e7b2f465bc59f3ab45 = new umiEventPoint("import_element");$v161c9aaa4fe035e7b2f465bc59f3ab45->setMode("before");$v161c9aaa4fe035e7b2f465bc59f3ab45->setParam("new_element_id", $v777ccf80e4e83a9e7cdddd6ebc1edff7);$v161c9aaa4fe035e7b2f465bc59f3ab45->setParam("old_element_id", $v2114c8075d855b3cea53d5d880c68948);$v161c9aaa4fe035e7b2f465bc59f3ab45->addRef("element_info", $vfc07ae6b81515e9c73cb36ac08488ca1);$v50fe03ab7bf37089a7e88da9b31ffb3b = $this->xml_objects[$v75cacdb2219ff0da09cc2f909ea64759]['props'];$v161c9aaa4fe035e7b2f465bc59f3ab45->addRef("props", $v50fe03ab7bf37089a7e88da9b31ffb3b);umiEventsController::getInstance()->callEvent($v161c9aaa4fe035e7b2f465bc59f3ab45);$v28b2e67839ab215dcac5f868963f2bcb = $vfc07ae6b81515e9c73cb36ac08488ca1['old_parent_id'];$this->importedElementsArr[] = $v2114c8075d855b3cea53d5d880c68948;$v10b04069381b2fef4e0a41e0ea65b914 = $vfc07ae6b81515e9c73cb36ac08488ca1['element_name'];$v9c668e7b8b95154aabe003bcfd8e15df = $vfc07ae6b81515e9c73cb36ac08488ca1['old_element_alt_name'];$v2741adf691b2acf0359a6a73234bc605 = $vfc07ae6b81515e9c73cb36ac08488ca1['old_type_id'];$v53f070b923b86cc3c1b95e9950674c7c = $vfc07ae6b81515e9c73cb36ac08488ca1['element_is_active'];$v712546bad453a4d99cb79be316f6e64b = $vfc07ae6b81515e9c73cb36ac08488ca1['element_is_visible'];$v25f5c3dfce7a3048a8e9f70bad15bdd3 = $vfc07ae6b81515e9c73cb36ac08488ca1['element_is_deleted'];if ($v9c668e7b8b95154aabe003bcfd8e15df) {$vd84ff935144e00c3e1d395c2379aca47 = $v9c668e7b8b95154aabe003bcfd8e15df;}else {$vd84ff935144e00c3e1d395c2379aca47 = $v10b04069381b2fef4e0a41e0ea65b914;}$vd84ff935144e00c3e1d395c2379aca47 = translit::convert($vd84ff935144e00c3e1d395c2379aca47);if ($v25f5c3dfce7a3048a8e9f70bad15bdd3 !== null) {if ($v25f5c3dfce7a3048a8e9f70bad15bdd3) {umiHierarchy::getInstance()->delElement($v777ccf80e4e83a9e7cdddd6ebc1edff7);$this->importLog[] = "Element \"" . $v10b04069381b2fef4e0a41e0ea65b914 . "\" (" . $v2114c8075d855b3cea53d5d880c68948 . ") has been deleted";$this->deletedElements++;return true;}}if ($v28b2e67839ab215dcac5f868963f2bcb === "0") {$v0a4066771994dd2315e8a742e4de72fc = $v28b2e67839ab215dcac5f868963f2bcb;}else {$v0a4066771994dd2315e8a742e4de72fc =     umiImportRelations::getInstance()->getNewIdRelation($this->source_id, $v28b2e67839ab215dcac5f868963f2bcb);}if ($v0a4066771994dd2315e8a742e4de72fc === false) {$v0a4066771994dd2315e8a742e4de72fc = $this->destination_element_id;}$v3252048a9dc6701c34b83c15c5be40f7 = false;if ($v777ccf80e4e83a9e7cdddd6ebc1edff7 === false && $v0a4066771994dd2315e8a742e4de72fc !== false) {$v555b8759c62b778531f7d10a1cfc1252 = $vfc07ae6b81515e9c73cb36ac08488ca1['new_domain_id'];$ve795657a63adabb22cdc79a959474fdd = $vfc07ae6b81515e9c73cb36ac08488ca1['new_lang_id'];$v5b4c55fc70f920b984055561aff116b3 = $vfc07ae6b81515e9c73cb36ac08488ca1['element_hierarchy_type_id'];$ve274c3c0bb91d6582078fbbce8f388f6 = $vfc07ae6b81515e9c73cb36ac08488ca1['new_tpl_id'];$v69203671ddb68b3848f87700fe06de55 = $vfc07ae6b81515e9c73cb36ac08488ca1['new_type_id'];$v616300e8f201203152145e6776ad27d1 =     umiImportRelations::getInstance()->getNewIdRelation($this->source_id, $v28b2e67839ab215dcac5f868963f2bcb);$v777ccf80e4e83a9e7cdddd6ebc1edff7 = umiHierarchy::getInstance()->addElement(     $v0a4066771994dd2315e8a742e4de72fc,     $v5b4c55fc70f920b984055561aff116b3,     $v10b04069381b2fef4e0a41e0ea65b914,     $vd84ff935144e00c3e1d395c2379aca47,     $v69203671ddb68b3848f87700fe06de55,     $v555b8759c62b778531f7d10a1cfc1252,     $ve795657a63adabb22cdc79a959474fdd,     $ve274c3c0bb91d6582078fbbce8f388f6    );umiImportRelations::getInstance()->setIdRelation($this->source_id, $v2114c8075d855b3cea53d5d880c68948, $v777ccf80e4e83a9e7cdddd6ebc1edff7);if ($v777ccf80e4e83a9e7cdddd6ebc1edff7) {$v3252048a9dc6701c34b83c15c5be40f7 = true;}}permissionsCollection::getInstance()->setDefaultPermissions($v777ccf80e4e83a9e7cdddd6ebc1edff7);$v691b2ea4f2db17699a29da0c302a91ea = umiHierarchy::getInstance()->getElement($v777ccf80e4e83a9e7cdddd6ebc1edff7, true, true);if (!$v691b2ea4f2db17699a29da0c302a91ea instanceof umiHierarchyElement) {$this->importLog[] = "Can't create element \"{$v10b04069381b2fef4e0a41e0ea65b914}\" ({$v2114c8075d855b3cea53d5d880c68948})";$this->importErrors++;return false;}$v161c9aaa4fe035e7b2f465bc59f3ab45 = new umiEventPoint("import_element");$v161c9aaa4fe035e7b2f465bc59f3ab45->setMode("process");$v161c9aaa4fe035e7b2f465bc59f3ab45->setParam("new_element", $v691b2ea4f2db17699a29da0c302a91ea);$v161c9aaa4fe035e7b2f465bc59f3ab45->setParam("old_element_id", $v2114c8075d855b3cea53d5d880c68948);$v161c9aaa4fe035e7b2f465bc59f3ab45->addRef("element_info", $vfc07ae6b81515e9c73cb36ac08488ca1);$v50fe03ab7bf37089a7e88da9b31ffb3b = $this->xml_objects[$v75cacdb2219ff0da09cc2f909ea64759]['props'];$v161c9aaa4fe035e7b2f465bc59f3ab45->addRef("props", $v50fe03ab7bf37089a7e88da9b31ffb3b);umiEventsController::getInstance()->callEvent($v161c9aaa4fe035e7b2f465bc59f3ab45);if ($v53f070b923b86cc3c1b95e9950674c7c !== null) {$v691b2ea4f2db17699a29da0c302a91ea->setIsActive($v53f070b923b86cc3c1b95e9950674c7c);}if ($v712546bad453a4d99cb79be316f6e64b !== null) {$v691b2ea4f2db17699a29da0c302a91ea->setIsVisible($v712546bad453a4d99cb79be316f6e64b);}if ($vd84ff935144e00c3e1d395c2379aca47) {$v691b2ea4f2db17699a29da0c302a91ea->setAltName($vd84ff935144e00c3e1d395c2379aca47);}if ($v10b04069381b2fef4e0a41e0ea65b914) {$v691b2ea4f2db17699a29da0c302a91ea->setName($v10b04069381b2fef4e0a41e0ea65b914);}$v82e85d12802becdae851373fcc70c4ff = [];$v50fe03ab7bf37089a7e88da9b31ffb3b = $this->xml_objects[$v75cacdb2219ff0da09cc2f909ea64759]['props'];foreach ($v50fe03ab7bf37089a7e88da9b31ffb3b as $vdfc394bd05a4b48161c790034af522a8 => $v410e0a26c217dfabf8a5653e8f9e68ef) {$v2771be291c4a714ca95fd1f45a32403e = $v410e0a26c217dfabf8a5653e8f9e68ef['values'];$v519504d7d4beb745dac24ccfb6c1d7c9 = $v410e0a26c217dfabf8a5653e8f9e68ef['field_type'];if ($v519504d7d4beb745dac24ccfb6c1d7c9 == "img_file") {if (isset($v2771be291c4a714ca95fd1f45a32403e[0])) {$v2771be291c4a714ca95fd1f45a32403e[0] = new umiImageFile($v2771be291c4a714ca95fd1f45a32403e[0]);}}$vdfc394bd05a4b48161c790034af522a8 = translit::convert($vdfc394bd05a4b48161c790034af522a8);if ($v691b2ea4f2db17699a29da0c302a91ea->getObject()->getPropByName($vdfc394bd05a4b48161c790034af522a8)) {if ($v519504d7d4beb745dac24ccfb6c1d7c9 == 'price' && strlen($v410e0a26c217dfabf8a5653e8f9e68ef['currency_code'])) {$vfcaea7edd270964cc145ea48e4367d43 = cmsController::getInstance()->getModule('emarket');if ($vfcaea7edd270964cc145ea48e4367d43) {$v78a5eb43deef9a7b5b9ce157b9d52ac4 = isset($v2771be291c4a714ca95fd1f45a32403e[0]) ? floatval($v2771be291c4a714ca95fd1f45a32403e[0]) : 0;$v1af0389838508d7016a9841eb6273962 = $vfcaea7edd270964cc145ea48e4367d43->getCurrency($v410e0a26c217dfabf8a5653e8f9e68ef['currency_code']);if ($v1af0389838508d7016a9841eb6273962) {$v30de5920b8dd5258394e19caa86bbe80 =         $vfcaea7edd270964cc145ea48e4367d43->formatCurrencyPrice([$v78a5eb43deef9a7b5b9ce157b9d52ac4], $vfcaea7edd270964cc145ea48e4367d43->getDefaultCurrency(), $v1af0389838508d7016a9841eb6273962);$v2771be291c4a714ca95fd1f45a32403e = isset($v30de5920b8dd5258394e19caa86bbe80[0]) ? floatval($v30de5920b8dd5258394e19caa86bbe80[0]) : 0;}}}$v691b2ea4f2db17699a29da0c302a91ea->setValue($vdfc394bd05a4b48161c790034af522a8, $v2771be291c4a714ca95fd1f45a32403e);}else {$v82e85d12802becdae851373fcc70c4ff[] = $v410e0a26c217dfabf8a5653e8f9e68ef;}}$this->addMissedProps($v691b2ea4f2db17699a29da0c302a91ea, $v82e85d12802becdae851373fcc70c4ff, $v2741adf691b2acf0359a6a73234bc605);if (umiCount($v82e85d12802becdae851373fcc70c4ff)) {$v691b2ea4f2db17699a29da0c302a91ea->getObject()->update();}foreach ($v82e85d12802becdae851373fcc70c4ff as $v410e0a26c217dfabf8a5653e8f9e68ef) {$v2771be291c4a714ca95fd1f45a32403e = $v410e0a26c217dfabf8a5653e8f9e68ef['values'];$v519504d7d4beb745dac24ccfb6c1d7c9 = $v410e0a26c217dfabf8a5653e8f9e68ef['field_type'];if ($v519504d7d4beb745dac24ccfb6c1d7c9 == "img_file") {if ($v2771be291c4a714ca95fd1f45a32403e[0]) {$v2771be291c4a714ca95fd1f45a32403e[0] = new umiImageFile($v2771be291c4a714ca95fd1f45a32403e[0]);}}if (!$v410e0a26c217dfabf8a5653e8f9e68ef['name']) {$v410e0a26c217dfabf8a5653e8f9e68ef['name'] = translit::convert($v410e0a26c217dfabf8a5653e8f9e68ef['title']);}$v410e0a26c217dfabf8a5653e8f9e68ef['name'] = translit::convert($v410e0a26c217dfabf8a5653e8f9e68ef['name']);if (!$v691b2ea4f2db17699a29da0c302a91ea->setValue($v410e0a26c217dfabf8a5653e8f9e68ef['name'], $v2771be291c4a714ca95fd1f45a32403e)) {continue;}}$v691b2ea4f2db17699a29da0c302a91ea->commit();if ($v3252048a9dc6701c34b83c15c5be40f7) {$this->importLog[] = "Element \"" . $v10b04069381b2fef4e0a41e0ea65b914 . "\" (" . $v2114c8075d855b3cea53d5d880c68948 . ") has been created";$this->createdElements++;}else {$this->importLog[] = "Element \"" . $v10b04069381b2fef4e0a41e0ea65b914 . "\" (" . $v2114c8075d855b3cea53d5d880c68948 . ") has been updated";$this->updatedElements++;}$v5e949eb2c66f5d51b8a4d4185a693b3f = umiObjectProperty::$USE_FORCE_OBJECTS_CREATION;umiObjectProperty::$USE_FORCE_OBJECTS_CREATION = false;$v9dfb9e2c355fe22768c93f6e0c33f1f9 = umiObjectTypesCollection::getInstance()->getTypeIdByHierarchyTypeName("eshop", "store");$v6f95a0b0f896cf9349af3afc8a2752df =    umiObjectTypesCollection::getInstance()->getTypeIdByHierarchyTypeName("eshop", "store_relation");$va8973f92932ba8c02915c86424eb77b0 = cmsController::getInstance()->getModule("eshop");if ($va8973f92932ba8c02915c86424eb77b0 && $v9dfb9e2c355fe22768c93f6e0c33f1f9 && $v6f95a0b0f896cf9349af3afc8a2752df) {if (isset($this->xml_stores[$v75cacdb2219ff0da09cc2f909ea64759])) {foreach ($this->xml_stores[$v75cacdb2219ff0da09cc2f909ea64759] as $v57f6446eb03e6af4fa631be4795f0c9b) {$v4ab09853d1229afdaa2c4b00b44b4828 = $v57f6446eb03e6af4fa631be4795f0c9b['old_store_id'];$vbd047b181e82cec3af1400e7ee193be5 = $v57f6446eb03e6af4fa631be4795f0c9b['amount'];$vb137c8149c716d240351a4b96434a60c = $this->getStoreIdByName($v4ab09853d1229afdaa2c4b00b44b4828);if ($vb137c8149c716d240351a4b96434a60c === false) {$vb137c8149c716d240351a4b96434a60c = umiObjectsCollection::getInstance()->addObject($v4ab09853d1229afdaa2c4b00b44b4828, $v9dfb9e2c355fe22768c93f6e0c33f1f9);}$vd47cbc7965be6318a50b0b921e4de391 = umiObjectsCollection::getInstance()->getObject($vb137c8149c716d240351a4b96434a60c);if ($vd47cbc7965be6318a50b0b921e4de391 instanceof umiObject) {$vd47cbc7965be6318a50b0b921e4de391->setName($v4ab09853d1229afdaa2c4b00b44b4828);$vd47cbc7965be6318a50b0b921e4de391->commit();$va8973f92932ba8c02915c86424eb77b0->setStoreAmount($v691b2ea4f2db17699a29da0c302a91ea->getId(), $vb137c8149c716d240351a4b96434a60c, $vbd047b181e82cec3af1400e7ee193be5);}}}}umiObjectProperty::$USE_FORCE_OBJECTS_CREATION = $v5e949eb2c66f5d51b8a4d4185a693b3f;$v161c9aaa4fe035e7b2f465bc59f3ab45 = new umiEventPoint("import_element");$v161c9aaa4fe035e7b2f465bc59f3ab45->setMode("after");$v161c9aaa4fe035e7b2f465bc59f3ab45->setParam("new_element_id", $v777ccf80e4e83a9e7cdddd6ebc1edff7);$v161c9aaa4fe035e7b2f465bc59f3ab45->setParam("old_element_id", $v2114c8075d855b3cea53d5d880c68948);$v161c9aaa4fe035e7b2f465bc59f3ab45->setParam("element_info", $vfc07ae6b81515e9c73cb36ac08488ca1);umiEventsController::getInstance()->callEvent($v161c9aaa4fe035e7b2f465bc59f3ab45);umiHierarchy::getInstance()->unloadElement($v777ccf80e4e83a9e7cdddd6ebc1edff7);}protected function getStoreIdByName($vfc19ae0e7cb9076cc4077381bbe0b168) {$v87306dd4235ed712ebc07fe169b76f83 = umiObjectTypesCollection::getInstance()->getTypeIdByHierarchyTypeName("eshop", "store");$v8be74552df93e31bbdd6b36ed74bdb6a = new umiSelection;$v8be74552df93e31bbdd6b36ed74bdb6a->setObjectTypeFilter();$v8be74552df93e31bbdd6b36ed74bdb6a->addObjectType($v87306dd4235ed712ebc07fe169b76f83);$v8be74552df93e31bbdd6b36ed74bdb6a->setPropertyFilter();$v8be74552df93e31bbdd6b36ed74bdb6a->addNameFilterEquals($vfc19ae0e7cb9076cc4077381bbe0b168);$result = umiSelectionsParser::runSelection($v8be74552df93e31bbdd6b36ed74bdb6a);return isset($result[0]) ? (int) $result[0] : false;}protected function addMissedProps(&$v691b2ea4f2db17699a29da0c302a91ea, $v82e85d12802becdae851373fcc70c4ff, $v2741adf691b2acf0359a6a73234bc605) {if (strlen($v2741adf691b2acf0359a6a73234bc605)) {$v87306dd4235ed712ebc07fe169b76f83 =     umiImportRelations::getInstance()->getNewTypeIdRelation($this->source_id, $v2741adf691b2acf0359a6a73234bc605);}else {$v87306dd4235ed712ebc07fe169b76f83 = $v691b2ea4f2db17699a29da0c302a91ea->getObject()->getTypeId();}$v7ae7003da59ae71dcc9f8638ef50593d = umiObjectTypesCollection::getInstance()->getType($v87306dd4235ed712ebc07fe169b76f83);foreach ($v82e85d12802becdae851373fcc70c4ff as $v6184026d3eb247fb90d471744679ece5) {$v2726ffa1d364725a0e3166638138e8e7 = $v6184026d3eb247fb90d471744679ece5['prop_block_title'];$vdf8958b8370cd74e1a8c33230a569b10 = $v6184026d3eb247fb90d471744679ece5['prop_block_name'];$ve41aac3b363ca7b963226f92ecda32d5 = $v6184026d3eb247fb90d471744679ece5['prop_block_is_public'];if (!$vdf8958b8370cd74e1a8c33230a569b10) {if ($v2726ffa1d364725a0e3166638138e8e7) {$vdf8958b8370cd74e1a8c33230a569b10 = translit::convert($v2726ffa1d364725a0e3166638138e8e7);}else {$v2726ffa1d364725a0e3166638138e8e7 = "Imported fields group";$vdf8958b8370cd74e1a8c33230a569b10 = "imported";}}if ($v216c92e7f92d45ebbf45c075ceae8c05 = $v7ae7003da59ae71dcc9f8638ef50593d->getFieldsGroupByName($vdf8958b8370cd74e1a8c33230a569b10)) {}else {$vb2cd255a43fd56eb1b203b521fa0ef69 =      $v7ae7003da59ae71dcc9f8638ef50593d->addFieldsGroup($vdf8958b8370cd74e1a8c33230a569b10, $vdf8958b8370cd74e1a8c33230a569b10, true, $ve41aac3b363ca7b963226f92ecda32d5);$v216c92e7f92d45ebbf45c075ceae8c05 = $v7ae7003da59ae71dcc9f8638ef50593d->getFieldsGroup($vb2cd255a43fd56eb1b203b521fa0ef69);$v216c92e7f92d45ebbf45c075ceae8c05->setTitle($v2726ffa1d364725a0e3166638138e8e7);$v216c92e7f92d45ebbf45c075ceae8c05->commit();}if (!$v6184026d3eb247fb90d471744679ece5['field_type']) {$v6184026d3eb247fb90d471744679ece5['field_type'] = "string";}$v1e3f04102267eaf5e8d0ca424fd5c561 = $this->getFieldTypeId($v6184026d3eb247fb90d471744679ece5['field_type'], $v6184026d3eb247fb90d471744679ece5['is_multiple']);if ($v1e3f04102267eaf5e8d0ca424fd5c561 === false) {continue;}$v6184026d3eb247fb90d471744679ece5['name'] = (string) $v6184026d3eb247fb90d471744679ece5['name'];if (!$v6184026d3eb247fb90d471744679ece5['name']) {$v6184026d3eb247fb90d471744679ece5['name'] = translit::convert($v6184026d3eb247fb90d471744679ece5['title']);}$v6184026d3eb247fb90d471744679ece5['name'] = translit::convert($v6184026d3eb247fb90d471744679ece5['name']);if ($v87306dd4235ed712ebc07fe169b76f83) {if (umiImportRelations::getInstance()->getNewFieldId($this->source_id, $v87306dd4235ed712ebc07fe169b76f83, $v6184026d3eb247fb90d471744679ece5['name'])) {continue;}}if ($v6184026d3eb247fb90d471744679ece5['field_type'] == "relation") {$v051369818a8073bba5feeb0e957eb308 = self::getAutoGuideId($v6184026d3eb247fb90d471744679ece5['title']);}else {$v051369818a8073bba5feeb0e957eb308 = false;}$v3aabf39f2d943fa886d86dcbbee4d910 = umiFieldsCollection::getInstance()->addField(     $v6184026d3eb247fb90d471744679ece5['name'],     $v6184026d3eb247fb90d471744679ece5['title'],     $v1e3f04102267eaf5e8d0ca424fd5c561,     $v6184026d3eb247fb90d471744679ece5['is_public'],     false    );$v06e3d36fa30cea095545139854ad1fb9 = umiFieldsCollection::getInstance()->getField($v3aabf39f2d943fa886d86dcbbee4d910);$v06e3d36fa30cea095545139854ad1fb9->setTip($v6184026d3eb247fb90d471744679ece5['tip']);if ($v051369818a8073bba5feeb0e957eb308) {$v06e3d36fa30cea095545139854ad1fb9->setGuideId($v051369818a8073bba5feeb0e957eb308);}$v06e3d36fa30cea095545139854ad1fb9->commit();$v216c92e7f92d45ebbf45c075ceae8c05->attachField($v3aabf39f2d943fa886d86dcbbee4d910);if ($v87306dd4235ed712ebc07fe169b76f83) {umiImportRelations::getInstance()->setFieldIdRelation(      $this->source_id,      $v87306dd4235ed712ebc07fe169b76f83,      $v6184026d3eb247fb90d471744679ece5['name'],      $v3aabf39f2d943fa886d86dcbbee4d910     );}}}protected function getFieldTypeId($v17f71d965fe9589ddbd11caf7182243e, $v96a76ec43956dac431b643cbd544dd08 = false) {$v3fa9d6639f24f9bb4bf81ac6bdbdbc8c = umiFieldTypesCollection::getInstance()->getFieldTypesList();foreach ($v3fa9d6639f24f9bb4bf81ac6bdbdbc8c as $v519504d7d4beb745dac24ccfb6c1d7c9) {if ($v519504d7d4beb745dac24ccfb6c1d7c9->getDataType() == $v17f71d965fe9589ddbd11caf7182243e && $v519504d7d4beb745dac24ccfb6c1d7c9->getIsMultiple() == $v96a76ec43956dac431b643cbd544dd08) {return $v519504d7d4beb745dac24ccfb6c1d7c9->getId();}}return false;}public function getAutoGuideId($vd5d3db1765287eef77d7927cc956f50a) {$vcf4313ee98665bb3d4b717b344ba6999 = "Справочник для поля \"{$vd5d3db1765287eef77d7927cc956f50a}\"";$vb3827f7111095f5ba1a9f49988fe9382 = umiObjectTypesCollection::getInstance();$vf996b02003664796b93c4befef5536ee = $vb3827f7111095f5ba1a9f49988fe9382->getTypeIdByGUID('root-guides-type');$v2af1d1812273df0bd0f720da7068f8a6 = $vb3827f7111095f5ba1a9f49988fe9382->getChildTypeIds($vf996b02003664796b93c4befef5536ee);foreach ($v2af1d1812273df0bd0f720da7068f8a6 as $vd4fd255f51559df00de5424b64292413) {$v793536b8480511c5e2975eba32738d1d = umiObjectTypesCollection::getInstance()->getType($vd4fd255f51559df00de5424b64292413);$vfd297f4a9a622aec6f6fb2589b9cda82 = $v793536b8480511c5e2975eba32738d1d->getName();if ($vfd297f4a9a622aec6f6fb2589b9cda82 == $vcf4313ee98665bb3d4b717b344ba6999) {$v793536b8480511c5e2975eba32738d1d->setIsGuidable(true);return $vd4fd255f51559df00de5424b64292413;}}$v051369818a8073bba5feeb0e957eb308 = umiObjectTypesCollection::getInstance()->addType($vf996b02003664796b93c4befef5536ee, $vcf4313ee98665bb3d4b717b344ba6999);$va0c391dc49c440fc9962168353cedde3 = umiObjectTypesCollection::getInstance()->getType($v051369818a8073bba5feeb0e957eb308);$va0c391dc49c440fc9962168353cedde3->setIsGuidable(true);$va0c391dc49c440fc9962168353cedde3->setIsPublic(true);$va0c391dc49c440fc9962168353cedde3->commit();return $v051369818a8073bba5feeb0e957eb308;}public function getImportedElementsCount() {return $this->importedElements;}public function getCreatedElementsCount() {return $this->createdElements;}public function getUpdatedElementsCount() {return $this->updatedElements;}public function getDeletedElementsCount() {return $this->deletedElements;}public function getImportErrorsCount() {return $this->importErrors;}public function getImportLog() {return $this->importLog;}};?>