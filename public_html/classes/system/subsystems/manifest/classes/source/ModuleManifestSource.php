<?php
 class ModuleManifestSource implements iManifestSource {private $module;public function __construct($v22884db148f0ffb0d830ba431102b0b5) {if (!is_string($v22884db148f0ffb0d830ba431102b0b5) || empty($v22884db148f0ffb0d830ba431102b0b5)) {throw new Exception('Wrong module name given');}$this->module = $v22884db148f0ffb0d830ba431102b0b5;}public function getConfigFilePath($vb068931cc450442b63f5b3d276ea4297) {return SYS_MODULES_PATH . "{$this->module}/manifest/{$vb068931cc450442b63f5b3d276ea4297}.xml";}public function getActionFilePath($vb068931cc450442b63f5b3d276ea4297) {$vb068931cc450442b63f5b3d276ea4297 = trimNameSpace($vb068931cc450442b63f5b3d276ea4297);return SYS_MODULES_PATH . "{$this->module}/manifest/actions/{$vb068931cc450442b63f5b3d276ea4297}.php";}}