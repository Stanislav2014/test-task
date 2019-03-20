<?php
 use UmiCms\Service;class selectorGetter {protected static $types = [   'object',   'page',   'object-type',   'hierarchy-type',   'field',   'field-type',   'domain',   'lang'  ];protected $requestedType;public function __construct($v9c32b08fe4f1100357be3cefc37fb591) {if (!in_array($v9c32b08fe4f1100357be3cefc37fb591, self::$types)) {throw new selectorException("Wrong content type \"{$v9c32b08fe4f1100357be3cefc37fb591}\"");}$this->requestedType = $v9c32b08fe4f1100357be3cefc37fb591;}public function id($vbf516925bb37a8544c8ee19a24e15c05) {if (is_array($vbf516925bb37a8544c8ee19a24e15c05)) {$v07214c6750d983a32e0a33da225c4efd = [];foreach ($vbf516925bb37a8544c8ee19a24e15c05 as $vb80bb7740288fda1f201890375a60c8f) {$vf5e638cc78dd325906c1298a0c21fb6b = $this->id($vb80bb7740288fda1f201890375a60c8f);if (is_object($vf5e638cc78dd325906c1298a0c21fb6b)) {$v07214c6750d983a32e0a33da225c4efd[] = $vf5e638cc78dd325906c1298a0c21fb6b;}}return $v07214c6750d983a32e0a33da225c4efd;}if (!$vbf516925bb37a8544c8ee19a24e15c05) {return null;}$vb80bb7740288fda1f201890375a60c8f = $vbf516925bb37a8544c8ee19a24e15c05;$vdb6d9b451b818ccc9a449383f2f0c450 = $this->collection();try {switch ($this->requestedType) {case 'object':      return $vdb6d9b451b818ccc9a449383f2f0c450->getObject($vb80bb7740288fda1f201890375a60c8f);case 'page':      return $vdb6d9b451b818ccc9a449383f2f0c450->getElement($vb80bb7740288fda1f201890375a60c8f);case 'hierarchy-type':     case 'object-type':      return $vdb6d9b451b818ccc9a449383f2f0c450->getType($vb80bb7740288fda1f201890375a60c8f);case 'field':      return $vdb6d9b451b818ccc9a449383f2f0c450->getField($vb80bb7740288fda1f201890375a60c8f);case 'field-type':      return $vdb6d9b451b818ccc9a449383f2f0c450->getFieldType($vb80bb7740288fda1f201890375a60c8f);case 'domain':      return $vdb6d9b451b818ccc9a449383f2f0c450->getDomain($vb80bb7740288fda1f201890375a60c8f);case 'lang':      return $vdb6d9b451b818ccc9a449383f2f0c450->getLang($vb80bb7740288fda1f201890375a60c8f);}}catch (coreException $ve1671797c52e15f763380b45e841ec32) {return null;}}public function name($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce = '') {$vdb6d9b451b818ccc9a449383f2f0c450 = $this->collection();switch ($this->requestedType) {case 'object-type': {$v6301cee35ea764a1e241978f93f01069 = $vdb6d9b451b818ccc9a449383f2f0c450->getTypeIdByHierarchyTypeName($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce);return $this->id($v6301cee35ea764a1e241978f93f01069);}case 'hierarchy-type': {$v89b0b9deff65f8b9cd1f71bc74ce36ba = $vdb6d9b451b818ccc9a449383f2f0c450->getTypeByName($v22884db148f0ffb0d830ba431102b0b5, $vea9f6aca279138c58f705c8d4cb4b8ce);return ($v89b0b9deff65f8b9cd1f71bc74ce36ba instanceof iUmiHierarchyType) ? $v89b0b9deff65f8b9cd1f71bc74ce36ba : null;}default: {throw new selectorException("Unsupported \"name\" method for \"{$this->requestedType}\"");}}}public function guid($v1e0ca5b1252f1f6b1e0ac91be7e7219e) {$vdb6d9b451b818ccc9a449383f2f0c450 = $this->collection();switch ($this->requestedType) {case 'object-type': {$v726e8e4809d4c1b28a6549d86436a124 = $vdb6d9b451b818ccc9a449383f2f0c450->getTypeByGUID($v1e0ca5b1252f1f6b1e0ac91be7e7219e);return $v726e8e4809d4c1b28a6549d86436a124 ?: null;}case 'object': {$va8cfde6331bd59eb2ac96f8911c4b666 = $vdb6d9b451b818ccc9a449383f2f0c450->getObjectByGUID($v1e0ca5b1252f1f6b1e0ac91be7e7219e);return $va8cfde6331bd59eb2ac96f8911c4b666 ?: null;}default: {throw new selectorException("Unsupported \"guid\" method for \"{$this->requestedType}\"");}}}public function prefix($v851f5ac9941d720844d143ed9cfcf60a) {if ($this->requestedType != 'lang') {throw new selectorException("Unsupported \"prefix\" method for \"{$this->requestedType}\"");}$vdb6d9b451b818ccc9a449383f2f0c450 = $this->collection();return $this->id($vdb6d9b451b818ccc9a449383f2f0c450->getLangId($v851f5ac9941d720844d143ed9cfcf60a));}public function host($v67b3dba8bc6778101892eb77249db32e) {if ($this->requestedType != 'domain') {throw new selectorException("Unsupported \"host\" method for \"{$this->requestedType}\"");}$vdb6d9b451b818ccc9a449383f2f0c450 = $this->collection();return $this->id($vdb6d9b451b818ccc9a449383f2f0c450->getDomainId($v67b3dba8bc6778101892eb77249db32e));}protected function collection() {switch ($this->requestedType) {case 'object':     return umiObjectsCollection::getInstance();case 'page':     return umiHierarchy::getInstance();case 'object-type':     return umiObjectTypesCollection::getInstance();case 'hierarchy-type':     return umiHierarchyTypesCollection::getInstance();case 'field':     return umiFieldsCollection::getInstance();case 'field-type':     return umiFieldTypesCollection::getInstance();case 'domain':     return Service::DomainCollection();case 'lang':     return Service::LanguageCollection();}}}