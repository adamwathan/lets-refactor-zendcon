<?php

namespace App;

class Order
{
    private $books;
    private $coupon;

    public function __construct($books)
    {
        $this->books = $books;
    }

    public function applyCoupon($coupon)
    {
        $this->coupon = $coupon;
    }

    public function total()
    {
        $totalPrice = 0;

        foreach ($this->books as $book) {
            $totalPrice += $book->price;
        }

        if (isset($this->coupon)) {
            if ($this->coupon->is_percent) {
                $discount = $totalPrice * ($this->coupon->value / 100);
            } else {
                $discount = $this->coupon->value;
            }
        } else {
            $discount = 0;
        }

        return $totalPrice - $discount;
    }
}
