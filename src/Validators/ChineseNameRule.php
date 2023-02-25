<?php

namespace Xgbnl\LaravelRule\Validators;

class ChineseNameRule implements Rule
{

    public function verify(string $value): bool|int
    {
        return preg_match('/^([\xe4-\xe9][\x80-\xbf]{2}){2,4}$/', $value);
    }

    public function validate(string $attribute, string $value, array $parameters = [], mixed $validator = null): bool
    {
        return $this->verify($value);
    }

    public function message(): string
    {
        return '姓名只能为2-4中文';
    }
}