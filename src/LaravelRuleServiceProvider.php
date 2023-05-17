<?php

namespace Xgbnl\LaravelRule;

use Xgbnl\LaravelRule\Rules\BankCardRule;
use Xgbnl\LaravelRule\Rules\CardRule;
use Xgbnl\LaravelRule\Rules\ChineseNameRule;
use Xgbnl\LaravelRule\Rules\EmojiRule;
use Xgbnl\LaravelRule\Rules\Factory;
use Xgbnl\LaravelRule\Rules\PhoneRule;
use Illuminate\Support\ServiceProvider;

class LaravelRuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Factory::make()
            ->push('phone', PhoneRule::class)
            ->push('id_card', CardRule::class)
            ->push('bank_card', BankCardRule::class)
            ->push('chinese', ChineseNameRule::class)
            ->push('emoji', EmojiRule::class)
            ->extend();
    }
}