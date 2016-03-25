<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 15:03
 */

namespace Veloci\Core\Helper\Metadata\Domain;


interface DomainResolver
{
    /**
     * @param $type
     * @param null $init
     * @return Domain|null
     */
    public function resolveDomain($type, $init = null);
}