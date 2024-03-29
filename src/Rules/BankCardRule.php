<?php

namespace Xgbnl\LaravelRule\Rules;

final class BankCardRule implements Rule
{
    public function validate(string $attribute, string $value, array $parameters = [], mixed $validator = null): bool
    {
        return $this->verify($value);
    }

    public function message(): string
    {
        return '银行卡格式错误，请输入正确的银行卡号';
    }

    public function verify(string $no): bool
    {
        $arr_no = str_split($no);
        $last_n = $arr_no[count($arr_no) - 1];
        krsort($arr_no);
        $i = 1;
        $total = 0;
        foreach ($arr_no as $n) {
            if ($i % 2 == 0) {
                $ix = $n * 2;
                if ($ix >= 10) {
                    $nx = 1 + ($ix % 10);
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

        return $last_n == ($total % 10);
    }
}