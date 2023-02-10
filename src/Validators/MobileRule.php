<?php

namespace Xgbnl\LaravelRule\Validators;

final class MobileRule implements Rule
{
    public function validate(string $attribute, string $value, array $parameters = [], mixed $validator = null): bool
    {
        return $this->verify($value);
    }

    public function message(): string
    {
        return '手机号格式错误,请输入正确的手机号';
    }

    public function verify(string $value): bool|int
    {
        return preg_match('/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/', $value);
    }
}