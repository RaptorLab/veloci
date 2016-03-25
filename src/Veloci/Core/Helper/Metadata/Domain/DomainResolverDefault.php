<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 15:06
 */

namespace Veloci\Core\Helper\Metadata\Domain;


use Veloci\Core\Repository\KeyValueStore;

class DomainResolverDefault implements DomainResolver
{

    /**
     * @var KeyValueStore
     */
    private $store;

    public function __construct(KeyValueStore $store)
    {
        $this->store = $store;

        $this->setDomain('int', IntegerDomain::class);
        $this->setDomain('bool', BooleanDomain::class);
        $this->setDomain('string', StringDomain::class);
    }

    public function setDomain(string $type, string $class)
    {
        if (!is_a($class, Domain::class)) {
            throw new \InvalidArgumentException('Expected ' . Domain::class . '. ' . $class . ' found');
        }

        $this->store->set($type, $class);
    }

    /**
     * @param $type
     * @param null $init
     * @return Domain|null
     */
    public function resolveDomain($type, $init = null)
    {
        $result = null;

        if ($this->store->contains($type)) {
            /** @var Domain $class */
            $class = $this->store->get($type);

            $result = $class::create($init);
        }

        return $result;
    }
}