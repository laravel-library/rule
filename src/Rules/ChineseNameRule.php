<?php

namespace Xgbnl\LaravelRule\Rules;

class ChineseNameRule implements Rule
{

    public function verify(string $value): bool|int
    {
        return preg_match('/^([\x{4e00}-\x{9fa5}\.]){2,25}$/u', $value);
    }

    public function validate(string $attribute, string $value, array $parameters = [], mixed $validator = null): bool
    {
        return $this->verify($value);
    }

    public function message(): string
    {
        return '姓名格式不正确';
    }
}