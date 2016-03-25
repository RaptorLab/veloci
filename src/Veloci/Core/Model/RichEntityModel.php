<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 11:11
 */

namespace Veloci\Core\Model;

use Veloci\Core\Helper\Metadata\ObjectMetadata;

abstract class RichEntityModel implements EntityModel
{
    use DateableModel;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return ObjectMetadata
     *
     * @throws \RuntimeException
     */
    public static function setCustomMetadata(ObjectMetadata $metadata)
    {
        $metadata->getProperty('id')->setPrimaryKey(true);
    }
}