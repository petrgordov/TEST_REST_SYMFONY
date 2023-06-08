<?php

namespace App\Catalog;


class Pricing
{

    //расчёт цены
    public static function Price(int|float $price, string $code): int|float
    {

        $tax = self::CountryTax($code);

        return $tax == 0 ? $price : $price + self::Tax($price, $tax);

    }

    //расчёт цены со скидкой
    public static function FinalPrice(int|float $total, string $code, int $discount, int $typeDiscount): int|float
    {

        if ($discount == 0) return $total;

        //процент от суммы покупки
        if ($typeDiscount == 1) {
            return $total - ($total * $discount / 100);
        } //фиксированная сумма скидки
        elseif ($typeDiscount == 2 && $discount < $total) {
            return $total - $discount;
        }

        return self::Price($total,$code);
    }

    //расчёт налога
    public static function Tax(int|float $price, int $tax): int
    {
        return $tax == 0 ? 0 : ($price * $tax / 100);
    }

    //определение страны по taxNumber
    public static function Country(string $code): string
    {
        return substr($code, 0, 2);
    }
    //определение процента по коду tax
    public static function CountryTax(string $code): int
    {

//        Германии - 19%
//        Италии - 22%
//        Греции - 24%

        return match (self::Country($code)) {
            'DE' => 19,
            'IT' => 22,
            'GR' => 24,
            'FR' => 20,
            default => 19
        };
    }
}