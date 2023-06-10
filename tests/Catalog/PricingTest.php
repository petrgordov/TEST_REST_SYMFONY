<?php

namespace App\Tests\Catalog;

use App\Catalog\Pricing;
use PHPUnit\Framework\TestCase;

class PricingTest extends TestCase
{
    public function testGetCountryByTaxNumber(): void
    {
        $taxNumbers=[
            'GR12345678912'=>'GR',
            'FR12345678912'=>'FR'
        ];

        foreach ($taxNumbers as $n=>$c)
        {
            if(Pricing::Country($n)!=$c) $this->assertTrue(false);
        }

        $this->assertTrue(true);

    }

    public function testFinalPrice(): void
    {
        $taxNumbers=[
            'GR12345678912'=>['price'=>100,'discount'=>10,'typediscount'=>1,'res'=>111.6],
            'FR12345678912'=>['price'=>100,'discount'=>20,'typediscount'=>2,'res'=>96]
        ];


        foreach ($taxNumbers as $code=>$arr)
        {
            $price=Pricing::FinalPrice($arr['price'],$code,$arr['discount'],$arr['typediscount']);

            if($price!=$arr['res']){
                echo $price." taxNumber:".$code;
                var_dump($arr);
                $this->assertTrue(false);
            }

        }
        $this->assertTrue(true);
    }

}
