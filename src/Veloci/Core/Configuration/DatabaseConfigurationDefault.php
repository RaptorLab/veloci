<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 08/04/16
 * Time: 15:24
 */

namespace Veloci\Core\Configuration;


class DatabaseConfigurationDefault implements DatabaseConfiguration
{
    /**
     * @var string
     */
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType():string
    {
        return $this->type;
    }
}