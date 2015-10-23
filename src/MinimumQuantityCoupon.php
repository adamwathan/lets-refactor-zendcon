<?php

namespace App;

class MinimumQuantityCoupon
{
    private $coupon;
    private $minimum_quantity;

    public function __construct($coupon, $minimum_quantity)
    {
        $this->coupon = $coupon;
        $this->minimum_quantity = $minimum_quantity;
    }

    public function discount($order)
    {
        if ($order->quantity() < $this->minimum_quantity) {
            return 0;
        }
        return $this->coupon->discount($order);
    }
}
