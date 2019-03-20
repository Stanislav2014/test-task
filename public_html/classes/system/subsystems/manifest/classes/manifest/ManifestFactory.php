<?php
 class ManifestFactory implements iManifestFactory {use tAtomicOperationStateFile;private $configFactory;private $callbackFactory;private $sourceFactory;public function __construct(   iBaseXmlConfigFactory $v32b287123e8302dc053d5799dff14589,   iAtomicOperationCallbackFactory $v97455cfd2ebb801e102c1643786a1bed,   iManifestSourceFactory $v47644a7bfb979e3553480b3e9481ba55  ) {$this->configFactory = $v32b287123e8302dc053d5799dff14589;$this->callbackFactory = $v97455cfd2ebb801e102c1643786a1bed;$this->sourceFactory = $v47644a7bfb979e3553480b3e9481ba55;}public function create($v62582aeedd5b66d3e5d300c4daf36248, array $v21ffce5b8a6cc8cc6a41448dd69623c9 = [], $v7726aa18ee80b6c3c6d416572ad7c1e4 = iAtomicOperationCallbackFactory::JSON) {$v36cd38f49b9afa08222c0dc9ebfe35eb = $this->getSourceFactory()    ->create();return $this->instantiateAndInitiateClass($v62582aeedd5b66d3e5d300c4daf36248, $v36cd38f49b9afa08222c0dc9ebfe35eb, $v21ffce5b8a6cc8cc6a41448dd69623c9, $v7726aa18ee80b6c3c6d416572ad7c1e4);}public function createByModule(   $v62582aeedd5b66d3e5d300c4daf36248,   $v22884db148f0ffb0d830ba431102b0b5,   array $v21ffce5b8a6cc8cc6a41448dd69623c9 = [],   $v7726aa18ee80b6c3c6d416572ad7c1e4 = iAtomicOperationCallbackFactory::COMMON  ) {$v36cd38f49b9afa08222c0dc9ebfe35eb = $this->getSourceFactory()    ->create(iManifestSourceFactory::MODULE, $v22884db148f0ffb0d830ba431102b0b5);return $this->instantiateAndInitiateClass($v62582aeedd5b66d3e5d300c4daf36248, $v36cd38f49b9afa08222c0dc9ebfe35eb, $v21ffce5b8a6cc8cc6a41448dd69623c9, $v7726aa18ee80b6c3c6d416572ad7c1e4);}public function createBySolution(   $v62582aeedd5b66d3e5d300c4daf36248,   $v550237b8fbcdf3741bb1127d0fc7f6bf,   array $v21ffce5b8a6cc8cc6a41448dd69623c9 = [],   $v7726aa18ee80b6c3c6d416572ad7c1e4 = iAtomicOperationCallbackFactory::COMMON  ) {$v36cd38f49b9afa08222c0dc9ebfe35eb = $this->getSourceFactory()    ->create(iManifestSourceFactory::SOLUTION, $v550237b8fbcdf3741bb1127d0fc7f6bf);return $this->instantiateAndInitiateClass($v62582aeedd5b66d3e5d300c4daf36248, $v36cd38f49b9afa08222c0dc9ebfe35eb, $v21ffce5b8a6cc8cc6a41448dd69623c9, $v7726aa18ee80b6c3c6d416572ad7c1e4);}private function instantiateAndInitiateClass(   $v62582aeedd5b66d3e5d300c4daf36248,   iManifestSource $v36cd38f49b9afa08222c0dc9ebfe35eb,   array $v21ffce5b8a6cc8cc6a41448dd69623c9,   $v7726aa18ee80b6c3c6d416572ad7c1e4  ) {$v032b3f8b77a334416437bb804895de35 = $v36cd38f49b9afa08222c0dc9ebfe35eb->getConfigFilePath($v62582aeedd5b66d3e5d300c4daf36248);$v2245023265ae4cf87d02c8b6ba991139 = $this->getConfigFactory()    ->create($v032b3f8b77a334416437bb804895de35);$v924a8ceeac17f54d3be3f8cdf1c04eb2 = $this->getCallbackFactory()    ->create($v7726aa18ee80b6c3c6d416572ad7c1e4);$v7f5cb74af5d7f4b82200738fdbdc5a45 = new Manifest($v2245023265ae4cf87d02c8b6ba991139, $v36cd38f49b9afa08222c0dc9ebfe35eb, $v21ffce5b8a6cc8cc6a41448dd69623c9);$v7f5cb74af5d7f4b82200738fdbdc5a45->setCallback($v924a8ceeac17f54d3be3f8cdf1c04eb2);$v7f5cb74af5d7f4b82200738fdbdc5a45->loadTransactions();$v17686b6dc6aae6ad46d83d04aa895405 = $this->getFilePath($v7f5cb74af5d7f4b82200738fdbdc5a45);$v7f5cb74af5d7f4b82200738fdbdc5a45->setStatePath($v17686b6dc6aae6ad46d83d04aa895405);$v7f5cb74af5d7f4b82200738fdbdc5a45->loadState();return $v7f5cb74af5d7f4b82200738fdbdc5a45;}private function getConfigFactory() {return $this->configFactory;}private function getCallbackFactory() {return $this->callbackFactory;}private function getSourceFactory() {return $this->sourceFactory;}}