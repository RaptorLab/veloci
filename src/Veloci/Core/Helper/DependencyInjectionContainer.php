<?php

namespace Veloci\Core\Helper;

use Closure;

interface DependencyInjectionContainer
{

    /**
     * @param string $alias
     * @param string $class
     */
    public function registerClass($alias, $class);

    /**
     * @param string $alias
     * @param Closure $closure
     */
    public function registerClosure($alias, Closure $closure);

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