<?php

namespace App;

class Order
{
    private $books;
    private $coupon;

    public function __construct($books)
    {
        $this->books = collect($books);
    }

    public function applyCoupon($coupon)
    {
        $this->coupon = $coupon;
    }

    public function total()
    {
        return $this->grossTotal() - $this->calculateDiscount();
    }

    public function grossTotal()
    {
        return $this->books->sum('price');
    }

    public function calculateDiscount()
    {
        if (! isset($this->coupon)) {
            return 0;
        }
        return $this->coupon->discount($this->grossTotal());
    }
}
