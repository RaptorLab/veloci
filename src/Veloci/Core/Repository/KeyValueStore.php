<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 21/02/16
 * Time: 19:23
 */

namespace Veloci\Core\Repository;


interface KeyValueStore
{
    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value);

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param string $key
     * @return boolean
     */
    public function contains($key);

    /**
     * @param $key
     */
    public function forget($key);
}