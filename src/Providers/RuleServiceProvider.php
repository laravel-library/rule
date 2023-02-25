<?php

namespace Xgbnl\LaravelRule\Providers;

use Illuminate\Support\ServiceProvider;
use Xgbnl\LaravelRule\Validators\{ChineseNameRule, Factory, PhoneRule, BankCardRule, CardRule};

class RuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Factory::make()
            ->store('phone', PhoneRule::class)
            ->store('id_card', CardRule::class)
            ->store('bank_card', BankCardRule::class)
            ->store('chinese', ChineseNameRule::class)
            ->register();
    }
}