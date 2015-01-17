<?php

namespace Centipede\Configuration;

use Symfony\Component\PropertyAccess\PropertyAccess;

class RuleFactory
{
    public static function create(array $configuration)
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        $rule = new Rule();

        foreach ($configuration as $key => $value) {
            $accessor->setValue($rule, $key, $value);
        }

        return $rule;
    }
}
