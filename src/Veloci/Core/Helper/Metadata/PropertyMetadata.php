<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 10/03/16
 * Time: 12:54
 */

namespace Veloci\Core\Helper\Metadata;


use Veloci\Core\Helper\Metadata\Domain\Domain;
use Veloci\Core\Helper\Validable;

class PropertyMetadata implements Validable
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

    /** @var Domain|null  */
    private $domain = null;


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

        return $this;
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

        return $this;
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

        return $this;
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

        return $this;
    }

    /**
     * @return boolean
     */
    public function isNullable():bool
    {
        return $this->nullable;
    }

    /**
     * @param bool $nullable
     */
    public function setNullable(bool $nullable)
    {
        $this->nullable = $nullable;

        return $this;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isPrimaryKey():bool
    {
        return $this->primaryKey;
    }

    /**
     * @param bool $primaryKey
     */
    public function setPrimaryKey(bool $primaryKey)
    {
        $this->primaryKey = $primaryKey;

        return $this;
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
    public function setSetter(string $setter)
    {
        $this->setter = $setter;

        return $this;
    }

    /**
     * @return null|Domain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param null|Domain $domain
     */
    public function setDomain(Domain $domain)
    {
        $this->domain = $domain;

        return $this;
    }

    public function validate($value)
    {

    }

    public function formatError($value):string
    {
        // TODO: Implement formatError() method.
    }
}