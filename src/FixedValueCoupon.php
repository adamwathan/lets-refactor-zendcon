<?php

namespace App;

class FixedValueCoupon
{
    use AttributeAccess;

    public function discount($order)
    {
        return $this->value;
    }
}
