<?php
 use UmiCms\Service;class redisCacheEngine implements iCacheEngine {private $client;private $host;private $port;private $baseNumber;private $authKey;private $socket;const DEFAULT_HOST = '127.0.0.1';const DEFAULT_PORT = 6379;const NAME = 'redis';public function __construct() {$v3f48301f2668ec4eec370518ddcffe63 = mainConfiguration::getInstance();$this->host = $v3f48301f2668ec4eec370518ddcffe63->get('cache', 'redis.host') ?: self::DEFAULT_HOST;$this->port = $v3f48301f2668ec4eec370518ddcffe63->get('cache', 'redis.port') ?: self::DEFAULT_PORT;$this->socket = $v3f48301f2668ec4eec370518ddcffe63->get('cache', 'redis.socket') ?: null;$this->baseNumber = $v3f48301f2668ec4eec370518ddcffe63->get('cache', 'redis.base');$this->authKey = $v3f48301f2668ec4eec370518ddcffe63->get('cache', 'redis.auth');$this->createClient();$this->connect();}public function getName() {return self::NAME;}public function saveRawData($v3c6e0b8a9c15224a8228b9a98ca1531d, $v8d777f385d3dfec8815d20f7496026dc, $vcd91e7679d575a2c548bd2c889c23b9e) {$v62608e08adc29a8d6dbc9754e659f125 = $this->getConnectedClient();return (bool) $v62608e08adc29a8d6dbc9754e659f125 ? $v62608e08adc29a8d6dbc9754e659f125->set($v3c6e0b8a9c15224a8228b9a98ca1531d, serialize($v8d777f385d3dfec8815d20f7496026dc), $vcd91e7679d575a2c548bd2c889c23b9e) : false;}public function loadRawData($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v62608e08adc29a8d6dbc9754e659f125 = $this->getConnectedClient();$v8d777f385d3dfec8815d20f7496026dc = $v62608e08adc29a8d6dbc9754e659f125 ? $v62608e08adc29a8d6dbc9754e659f125->get($v3c6e0b8a9c15224a8228b9a98ca1531d) : null;return $v8d777f385d3dfec8815d20f7496026dc ? unserialize($v8d777f385d3dfec8815d20f7496026dc) : null;}public function delete($v3c6e0b8a9c15224a8228b9a98ca1531d) {$v62608e08adc29a8d6dbc9754e659f125 = $this->getConnectedClient();return $v62608e08adc29a8d6dbc9754e659f125 ? (bool) $v62608e08adc29a8d6dbc9754e659f125->del($v3c6e0b8a9c15224a8228b9a98ca1531d) : false;}public function flush() {$v62608e08adc29a8d6dbc9754e659f125 = $this->getConnectedClient();if (!$v62608e08adc29a8d6dbc9754e659f125) {return false;}$v62608e08adc29a8d6dbc9754e659f125->setOption(Redis::OPT_SCAN, Redis::SCAN_RETRY);$v420cec00303cf5ff3ee30bf824fc1427 = null;$v94666270e7596947cba23efca3932dbd = Service::CacheKeyGenerator()    ->getBasePrefix();while ($v14f802e1fba977727845e8872c1743a7 = $v62608e08adc29a8d6dbc9754e659f125->scan($v420cec00303cf5ff3ee30bf824fc1427, $v94666270e7596947cba23efca3932dbd . '*')) {if (is_array($v14f802e1fba977727845e8872c1743a7) && !empty($v14f802e1fba977727845e8872c1743a7)) {$v62608e08adc29a8d6dbc9754e659f125->del($v14f802e1fba977727845e8872c1743a7);}}$v62608e08adc29a8d6dbc9754e659f125->setOption(Redis::OPT_SCAN, Redis::SCAN_NORETRY);return true;}public function getIsConnected() {return $this->getConnectedClient() instanceof Redis;}private function createClient() {$this->client = new Redis();return $this;}private function connect() {$v62608e08adc29a8d6dbc9754e659f125 = $this->getClient();if ($this->socket && !$v62608e08adc29a8d6dbc9754e659f125->connect($this->socket)) {return false;}if (!$v62608e08adc29a8d6dbc9754e659f125->connect($this->host, $this->port)) {return false;}if (!empty($this->authKey) && !$v62608e08adc29a8d6dbc9754e659f125->auth($this->authKey)) {return false;}if (!empty($this->baseNumber) && !$v62608e08adc29a8d6dbc9754e659f125->select($this->baseNumber)) {return false;}return true;}private function getConnectedClient() {$v62608e08adc29a8d6dbc9754e659f125 = $this->getClient();if ($v62608e08adc29a8d6dbc9754e659f125 instanceof Redis) {try {$v6fdb087aa3fbfbcb8287a593a0919e61 = $v62608e08adc29a8d6dbc9754e659f125->ping();if (!$v6fdb087aa3fbfbcb8287a593a0919e61) {$this->connect();}}catch (RedisException $v42552b1f133f9f8eb406d4f306ea9fd1) {$this->connect();}}return $v62608e08adc29a8d6dbc9754e659f125;}private function getClient() {return $this->client;}}