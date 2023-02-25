<?php

namespace Xgbnl\LaravelRule\Validators;

use HttpException;
use Illuminate\Support\Facades\Validator;
use ReflectionClass;
use ReflectionException;

final class Factory
{
    protected array $validators = [];

    public static function make(): self
    {
        return new self();
    }

    final  public function store(string $rule, string $validator): self
    {
        $this->validators[$rule] = $validator;

        return $this;
    }

    final public function register(): void
    {
        foreach ($this->validators as $rule => $validator) {
           Validator::extend($rule, "{$validator}@validate", $this->getInstance($validator)->message());
        }
    }

    /**
     * @throws ReflectionException
     * @throws HttpException
     */
    protected function getInstance(string $class): object
    {
        $ref = new ReflectionClass($class);

        if (!$ref->isInstantiable()) {
            throw new HttpException('验证器(' . $class . '),不能被实例化', 500);
        }

        return $ref->newInstance();
    }
}