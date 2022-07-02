<?php

namespace Xgbnl\LaravelRule\Validators;

use Xgbnl\LaravelRule\Attributes\Tag;

#[Tag('银行卡规则')]
class BankCardRule extends Rule
{
    public function validate(string $attribute, string $value, array $parameters = [], mixed $validator = null): bool
    {
        return $this->verify($value);
    }

    public function message(): string
    {
        return '银行卡格式不正确';
    }

    private function verify(string $no): bool
    {
        $arr_no = str_split($no);
        $last_n = $arr_no[count($arr_no) - 1];
        krsort($arr_no);
        $i     = 1;
        $total = 0;
        foreach ($arr_no as $n) {
            if ($i % 2 == 0) {
                $ix = $n * 2;
                if ($ix >= 10) {
                    $nx    = 1 + ($ix % 10);
                    $total += $nx;
                } else {
                    $total += $ix;
                }
            } else {
                $total += $n;
            }
            $i++;
        }
        $total -= $last_n;
        $total *= 9;
        if ($last_n == ($total % 10)) {
            return true;
        } else {
            return false;
        }
    }
}