<?php

namespace Xgbnl\LaravelRule\Attributes;

use Attribute;

#[Attribute]
class Tag
{
    public string $tag;

    public function __construct(string $tag)
    {
        $this->tag = $tag;
    }
}