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

//$metadata = $metadataRepository->getMetadata(\Veloci\User\Model\UserDefault::class);
//
//echo json_encode($metadata, JSON_PRETTY_PRINT);
//
//$metadata = $metadataRepository->getMetadata(\Veloci\User\Model\UserDefault::class);
//
//echo "\n---------------------------------------------------------------------------\n";
//
//echo json_encode($metadata, JSON_PRETTY_PRINT);
//
//return 0;

$user = new \Veloci\User\Model\UserDefault();

$strategies = new \Veloci\Core\Helper\Serializer\SerializationStrategyRepositoryDefault();

$strategies->setFallback(new \Veloci\Core\Helper\Serializer\Strategy\DoNothingStrategy());

$strategies->register(DateTime::class, new \Veloci\Core\Helper\Serializer\Strategy\DateTimeStrategy('H:i:s d/m/Y'));


$serializer = new \Veloci\Core\Helper\Serializer\ModelSerializerDefault($strategies, $metadataRepository);

$data = $serializer->serialize($user);

$data['createdAt'] = null;

$object = $serializer->hydrate($data, new \Veloci\User\Model\UserDefault(), true);

print_r($data);
print_r($object);

