<?php

namespace Xgbnl\LaravelRule\Providers;

use Illuminate\Support\ServiceProvider;
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
            ->store('id_card', CardRule::class)
            ->store('bank_card', BankCardRule::class)
            ->register();
    }
}