<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 11:11
 */

namespace Veloci\Core\Model;


use Veloci\Core\Helper\Metadata\ModelAnalyzer;
use Veloci\Core\Helper\Metadata\ObjectMetadata;
use Veloci\Core\Helper\Metadata\PropertyMetadata;

abstract class RichEntityModel implements EntityModel
{
    use DateableModel;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ObjectMetadata
     */
    public static function getMetadata():ObjectMetadata
    {
        $metadata = ModelAnalyzer::analyze(static::class);

        $metadata->getProperty('id')->setPrimaryKey(true);

        return $metadata;
    }

}