<?php

namespace Centipede\Configuration;

class Configuration
{
    private $rules = [];
    private $ignores = [];

    public function addRule(Rule $rule)
    {
        $this->rules[$rule->getUrl()] = $rule;
    }

    public function getRule($url)
    {
        if (isset($this->rules[$url])) {
            return $this->rules[$url];
        }

        return new Rule();
    }

    public function addIgnore($url)
    {
        $this->ignores[] = $url;
    }
}
