<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 13:35
 */

namespace Veloci\Core\Helper\Metadata\Domain;


class StringDomain extends AbstractDomain
{

    /**
     * @var
     */
    private $regex;

    public function __construct($regex = null)
    {
        $this->regex = $regex;
    }

    /**
     * @param $value
     * @return bool
     */
    public function validate($value):bool
    {
        return is_string($value) && ($this->regex === null || preg_match($this->regex, $value) === 1);
    }

    /**
     * @param string|null $init
     * @return Domain
     */
    public static function create(string $init = null):Domain
    {
        return new static($init);
    }

    public function getType():string
    {
        return sprintf('string [%s]', $this->regex);
    }
}