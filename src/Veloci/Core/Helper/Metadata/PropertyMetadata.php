<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 12:54
 */

namespace Veloci\Core\Helper\Metadata;


class PropertyMetadata
{
    /** @var bool */
    private $readOnly;

    /** @var string */
    private $type;

    /** @var string */
    private $getter;

    /** @var  string */
    private $setter;

    /** @var bool */
    private $builtIn;

    /** @var bool */
    private $nullable = false;

    /** @var string */
    private $name;

    /** @var bool */
    private $primaryKey = false;


    /**
     * @return boolean
     */
    public function isReadOnly()
    {
        return $this->readOnly;
    }

    /**
     * @param boolean $readOnly
     */
    public function setReadOnly(bool $readOnly)
    {
        $this->readOnly = $readOnly;
    }

    /**
     * @return string
     */
    public function getType():string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getGetter():string
    {
        return $this->getter;
    }

    /**
     * @param string $getter
     */
    public function setGetter(string $getter)
    {
        $this->getter = $getter;
    }

    /**
     * @return boolean
     */
    public function isBuiltIn():bool
    {
        return $this->builtIn;
    }

    /**
     * @param boolean $builtIn
     */
    public function setBuiltIn(bool $builtIn)
    {
        $this->builtIn = $builtIn;
    }

    /**
     * @return boolean
     */
    public function isNullable():bool
    {
        return $this->nullable;
    }

    /**
     * @param boolean $nullable
     */
    public function setNullable(bool $nullable)
    {
        $this->nullable = $nullable;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return boolean
     */
    public function isPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * @param boolean $primaryKey
     */
    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
    }

    /**
     * @return string
     */
    public function getSetter()
    {
        return $this->setter;
    }

    /**
     * @param string $setter
     */
    public function setSetter($setter)
    {
        $this->setter = $setter;
    }
}