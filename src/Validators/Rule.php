<?php

namespace Xgbnl\LaravelRule\Validators;

interface Rule
{
    public function validate(string $attribute, string $value, array $parameters = [], mixed $validator = null): bool;

    public function verify(string $value): bool|int;

    public function message(): string;
}