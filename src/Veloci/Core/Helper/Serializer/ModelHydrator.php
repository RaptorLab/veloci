<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 06/04/16
 * Time: 14:24
 */

namespace Veloci\Core\Helper\Serializer;


interface ModelHydrator
{
    /**
     * @param string $className
     * @param array $data
     * @param bool $fullHydration
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public function hydrate (string $className, array $data, bool $fullHydration = false);
}