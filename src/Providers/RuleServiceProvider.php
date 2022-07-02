<?php

namespace Xgbnl\LaravelRule\Providers;

use HttpException;
use Illuminate\Support\ServiceProvider;
use ReflectionException;
use Xgbnl\LaravelRule\Validators\{
    Rule,
    MobileRule,
    BankCardRule,
};

class RuleServiceProvider extends ServiceProvider
{
    /**
     * @throws ReflectionException
     * @throws HttpException
     */
    public function boot(): void
    {
        Rule::storeValidator('bank_card', BankCardRule::class);
        Rule::storeValidator('mobile', MobileRule::class);

        Rule::registerValidators();
    }

    public function provides(): array
    {
        return ['laravel-rule'];
    }
}