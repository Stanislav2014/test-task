<?php
 class umiObjectPropertyOptioned extends umiObjectProperty {protected function loadValue() {$vf09cc7ee3a9a93273f4b80601cafb00c = [];$v8d777f385d3dfec8815d20f7496026dc = $this->getPropData();$v80071f37861c360a27b7327e132c911a = $this->getTableName();if (!$v8d777f385d3dfec8815d20f7496026dc) {$v8d777f385d3dfec8815d20f7496026dc = [];$v4717d53ebfdfea8477f780ec66151dcb = $this->getConnection();$vac5c74b64b4b8352ef2f181affb5ac2a = <<<SQL
SELECT int_val, varchar_val, text_val, rel_val, tree_val, float_val
FROM {$v80071f37861c360a27b7327e132c911a}
WHERE obj_id = '{$this->object_id}' AND field_id = '{$this->field_id}'
SQL;
INSERT INTO `$v80071f37861c360a27b7327e132c911a` (`obj_id`, `field_id`, `int_val`, `varchar_val`, `text_val`, `rel_val`, `tree_val`, `float_val`) VALUES
SQL;