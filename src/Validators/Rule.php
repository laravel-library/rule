<?php

namespace Xgbnl\LaravelRule\Validators;

use HttpException;
use Xgbnl\LaravelRule\Attributes\Tag;
use Illuminate\Support\Facades\Validator as FaValidator;
use ReflectionClass;
use ReflectionException;

#[Tag('规则抽象类')]
abstract class Rule
{
    private static array $validators = [];

    /**
     * 存储规则
     */
    final static public function storeValidator(string $rule, string $validator):void
    {
        self::$validators[$rule] = $validator;
    }

    /**
     * 实例化规则
     * @throws ReflectionException
     * @throws HttpException
     */
    static private function getInstance(string $class):object
    {
        $ref = new ReflectionClass($class);

        if (!$ref->isInstantiable()) {
            throw new HttpException('验证器('.$class.'),不能被实例化',500);
        }

        return $ref->newInstance();
    }

    /**
     * 注册所有验证器
     * @throws ReflectionException
     * @throws HttpException
     */
    final static public function registerValidators(): void
    {
        foreach (self::$validators as $rule => $validator) {
            FaValidator::extend($rule,"{$validator}@validate",self::getInstance($validator)->message());
        }
    }

    abstract public function validate(string $attribute, string $value, array $parameters = [], mixed $validator = null): bool;

    abstract public function message(): string;
}