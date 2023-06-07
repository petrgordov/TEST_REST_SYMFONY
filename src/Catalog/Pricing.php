<?php

namespace App\Catalog;


class Pricing
{

    //расчёт цены
    public static function BasePrice(int &$price, string $code): void
    {

        $tax=self::CountryTax($code);

        $price=$tax == 0 ? $price : $price + self::Tax($price, $tax);

    }

    //расчёт цены со скидкой
    public static function FinalPrice(int $total, int $discount, int $typeDiscount): int
    {

        if ($discount == 0) return $total;

        //процент от суммы покупки
        if ($typeDiscount == 1) {
            return $total - ($total * $discount / 100);
        } //фиксированная сумма скидки
        elseif ($typeDiscount == 2 && $discount < $total) {
            return $total - $discount;
        }

        return $total;
    }

    //расчёт налога
    public static function Tax(int $price, int $tax): int
    {
        return $tax == 0 ? 0 : ($price * $tax / 100);
    }

    //определение процента по коду tax
    public static function CountryTax(string $code): int
    {

//        Германии - 19%
//        Италии - 22%
//        Греции - 24%

        $index=substr($code,0,2);

        return match ($index) {
            'DE'=>19,
            'IT'=>22,
            'GR'=>24,
            default=>0
        };
    }
}