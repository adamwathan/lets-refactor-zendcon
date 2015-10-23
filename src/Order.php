<?php

namespace App;

class Order
{
    private $books;
    private $coupon;

    public function __construct($books)
    {
        $this->books = collect($books);
        $this->coupon = new FixedValueCoupon(['value' => 0]);
    }

    public function applyCoupon($coupon)
    {
        $this->coupon = $coupon;
    }

    public function total()
    {
        return $this->grossTotal() - $this->calculateDiscount();
    }

    public function quantity()
    {
        return $this->books->count();
    }

    public function grossTotal()
    {
        return $this->books->sum('price');
    }

    private function calculateDiscount()
    {
        return $this->coupon->discount($this);
    }
}
