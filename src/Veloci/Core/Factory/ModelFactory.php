<?php

namespace Veloci\Core\Factory;

use Veloci\Core\Model\EntityModel;

interface ModelFactory {
    public function create(array $data = [], bool $fullHydration = false):EntityModel;
}