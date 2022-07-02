<?php

namespace Xgbnl\LaravelRule\Validators;

use Xgbnl\LaravelRule\Attributes\Tag;

#[Tag('手机规则')]
class MobileRule extends Rule
{
    public function validate(string $attribute, string $value, array $parameters = [], mixed $validator = null): bool
    {
        $pattern = '/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/';

        return preg_match($pattern, $value);
    }

    public function message(): string
    {
        return '请填写正确的手机号';
    }
}