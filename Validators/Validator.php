<?php

namespace Xgbnl\Business\Validators;

use Illuminate\Support\Facades\Validator as FaValidator;
use ReflectionClass;
use ReflectionException;
use Xgbnl\Business\Attributes\BusinessTag;
use Xgbnl\Business\Utils\Fail;

#[BusinessTag('验证器抽象类')]
abstract class Validator
{
    private static array $validators = [];

    /**
     * @throws ReflectionException
     */
    final static public function registerValidator(string $rule, string $validator):void
    {
        self::$validators[$rule] = self::instance($validator);
    }

    /**
     * @throws ReflectionException
     */
    static private function instance(string $class):object
    {
        $ref = new ReflectionClass($class);

        if (!$ref->isInstantiable()) {
            Fail::throwFailException('验证器('.$class.'),不能被实例化');
        }

        return $ref->newInstance();
    }

    /**
     * @throws ReflectionException
     */
    final static public function extend(): void
    {
        foreach (self::$validators as $rule => $validator) {
            FaValidator::extend($rule,"{$validator}@validate",$validator->message());
        }
    }

    abstract public function validate(string $attribute, string $value, array $parameters = [], mixed $validator = null): bool;

    abstract public function message(): string;
}