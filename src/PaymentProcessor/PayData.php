<?php

namespace App\PaymentProcessor;

use App\Entity\Order;

class PayData
{
    public int $orderNumber;
    public int $idUser;
    public int $Tax;
    public string $hashStr;
    public int $isPay=0;
    public int|float $amount;
    public array $bundleItems=[];

    public function __construct(int|float $mount,Order $order)
    {
        $this->orderNumber=$order->getId();
        $this->idUser=$order->getIdUser();
        $this->Tax=$order->getTax();
        $this->hashStr=$order->getHash();
        $this->isPay=$order->getIsPay();
        $this->amount=$mount;
    }
}