<?php

namespace Centipede\Configuration;

use Symfony\Component\Yaml\Parser;

class ConfigurationFactory
{
    public static function create($path)
    {
        $configurtion = new Configuration();

        if (!file_exists($path)) {
            return $configurtion;
        }

        $array = (new Parser())->parse(file_get_contents($path));

        if (isset($array['rules']) && is_array($array['rules'])) {
            foreach ($array['rules'] as $rule) {
                $configurtion->addRule(
                    RuleFactory::create($rule)
                );
            };
        }

        if (isset($array['ignore']) && is_array($array['ignore'])) {
            foreach ($array['ignore'] as $ignore) {
                $configurtion->addIgnore($ignore);
            };
        }

        return $configurtion;
    }
}
