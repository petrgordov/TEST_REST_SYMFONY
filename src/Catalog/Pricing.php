<?php

namespace App\Catalog;


class Pricing
{

    //расчёт цены
    public static function BasePrice(int $price, int $tax): int
    {
        return $tax == 0 ? $price : $price + self::Tax($price, $tax);
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
}