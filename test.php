<?php

include __DIR__ . "/vendor/autoload.php";

//$class = new class
//{
//    public function getA():int
//    {
//    }
//
//    private function getB():array
//    {
//    }
//
//    public function getC():\Veloci\User\Model\UserDefault
//    {
//    }
//
//    public function setC(string $c)
//    {
//    }
//
//    protected function isD():float
//    {
//    }
//};
//
//$result = \Veloci\Core\Helper\ModelAnalyzer::analize($class);
//
//print_r($result);
//var_dump( instanceof );

$metadataRepository = new \Veloci\Core\Repository\MetadataRepositoryDefault(new \Veloci\Core\Repository\InMemoryKeyValueStore());

$metadata = $metadataRepository->getMetadata(\Veloci\User\Model\UserDefault::class);

echo json_encode($metadata, JSON_PRETTY_PRINT);

$metadata = $metadataRepository->getMetadata(\Veloci\User\Model\UserDefault::class);

echo "\n---------------------------------------------------------------------------\n";

echo json_encode($metadata, JSON_PRETTY_PRINT);

return 0;