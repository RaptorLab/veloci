<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 21/02/16
 * Time: 19:28
 */

namespace Veloci\Core\Repository;


use Doctrine\Common\Collections\ArrayCollection;

class InMemoryKeyValueStore implements KeyValueStore
{
    /**
     * @var ArrayCollection<mixed>
     */
    private $store;

    public function __construct()
    {
        $this->store = new ArrayCollection();
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->store->set($key, serialize($value));
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return unserialize($this->store->get($key));
    }

    /**
     * @param string $key
     * @return boolean
     */
    public function contains($key)
    {
        return $this->store->containsKey($key);
    }

    /**
     * @param $key
     */
    public function forget($key)
    {
        $this->store->remove($key);
    }
}