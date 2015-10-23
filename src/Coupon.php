<?php

namespace App;

class Coupon
{
    use AttributeAccess;

    public function discount($total)
    {
        if ($this->is_percent) {
            return $total * ($this->value / 100);
        }
        return $this->value;
    }
}
