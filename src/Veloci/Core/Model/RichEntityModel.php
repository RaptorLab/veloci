<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 11:11
 */

namespace Veloci\Core\Model;


use Veloci\Core\Helper\ModelAnalyzer;

abstract class RichEntityModel implements EntityModel, MetadataAware
{
    use DateableModel;

    /**
     * @var mixed
     */
    protected $id;

    public function getId():mixed
    {
        return $this->id;
    }

    public static function getMetadata():array
    {
        $metadata = ModelAnalyzer::analize(static::class);

        $metadata['id']['keys'] = ['primary'];

        return $metadata;
    }

}