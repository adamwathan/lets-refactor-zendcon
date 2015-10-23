<?php

namespace App;

class Coupon
{
    use AttributeAccess;

    public function discount($totalPrice)
    {
        if ($this->is_percent) {
            return $totalPrice * ($this->value / 100);
        }

        return $this->value;
    }
}
