<?php

namespace Xgbnl\LaravelRule\Validators;

final class CardRule implements Rule
{

    public function validate(string $attribute, string $value, array $parameters = [], mixed $validator = null): bool
    {
        return $this->verify($value);
    }

    public function verify(string $value): bool
    {
        if (strlen($value) != 18) {
            return false;
        }
        // 取出本体码
        $idcard_base = substr($value, 0, 17);
        // 取出校验码
        $verify_code = substr($value, 17, 1);
        // 加权因子
        $factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
        // 校验码对应值
        $verify_code_list = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
        // 根据前17位计算校验码
        $total = 0;
        for ($i = 0; $i < 17; $i++) {
            $total += substr($idcard_base, $i, 1) * $factor[$i];
        }
        // 取模
        $mod = $total % 11;
        // 比较校验码
        return $verify_code == $verify_code_list[$mod];
    }

    public function message(): string
    {
        return '身份证格式错误,请输入正确的身份证';
    }
}