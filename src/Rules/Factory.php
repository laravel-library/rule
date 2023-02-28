<?php

namespace Xgbnl\LaravelRule\Rules;

use Illuminate\Support\Facades\Validator;

final class Factory
{
    protected array $validators = [];

    public static function make(): self
    {
        return new self();
    }

    final  public function push(string $rule, string $validator): self
    {
        $this->validators[$rule] = $validator;

        return $this;
    }

    final public function extend(): void
    {
        foreach ($this->validators as $rule => $validator) {
            Validator::extend($rule, "{$validator}@validate", (new $validator())->message());
        }
    }
}