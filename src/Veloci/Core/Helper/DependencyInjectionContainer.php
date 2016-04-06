<?php

namespace Veloci\Core\Helper;

use Closure;

interface DependencyInjectionContainer
{

    /**
     * @param string $alias
     * @param string $class
     */
    public function registerClass($alias, $class, Closure $generator = null);


    /**
     * @param string $alias
     * @return mixed
     */
    public function get($alias);

    /**
     * @param $alias
     * @return string | null
     */
    public function getClass($alias);
}