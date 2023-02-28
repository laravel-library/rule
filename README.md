## laravel-rule

### install

```shell
composer require xgbnl/laravel-rule
```

### use

```php
public function rules(): array
{
    return [
        'name' => 'chinese',
        'phone' => 'phone',
        'idCard' => 'id_card',
        'bankCard' => 'bank_card',
    ];
}
```