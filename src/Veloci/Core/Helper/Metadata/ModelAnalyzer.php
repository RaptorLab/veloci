<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 25/03/16
 * Time: 15:41
 */

namespace Veloci\Core\Helper\Metadata;


use Veloci\Core\Model\EntityModel;

interface ModelAnalyzer
{
    /**
     * @param string $model
     * @return ObjectMetadata
     */
    public function analyze(string $model):ObjectMetadata;
}