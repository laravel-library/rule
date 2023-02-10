<?php

namespace Xgbnl\LaravelRule\Providers;

use HttpException;
use Illuminate\Support\ServiceProvider;
use ReflectionException;
use Xgbnl\LaravelRule\Validators\{
    Factory,
    MobileRule,
    BankCardRule,
    CardRule,
};

class RuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Factory::make()
            ->store('mobile', MobileRule::class)
            ->store('identityCard', CardRule::class)
            ->store('identifyBankCard', BankCardRule::class)
            ->register();
    }
}