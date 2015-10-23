<?php

namespace App;

class PercentOffCoupon
{
    use AttributeAccess;

    public function discount($order)
    {
        return $order->grossTotal() * ($this->value / 100);
    }
}
