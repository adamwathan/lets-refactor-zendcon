<?php

use App\Book;
use App\Coupon;
use App\Order;

class AddCouponToOrderTest extends PHPUnit_Framework_TestCase
{
    function test_an_order_with_no_coupon_is_not_discounted()
    {
        $books = collect([
            new Book(['price' => 2000]),
            new Book(['price' => 3000]),
            new Book(['price' => 4000]),
        ]);

        $order = new Order($books);

        $this->assertEquals(9000, $order->total());
    }

    function test_a_discount_is_applied_when_a_coupon_is_added_to_an_order()
    {
        $books = collect([
            new Book(['price' => 2000]),
            new Book(['price' => 3000]),
            new Book(['price' => 4000]),
        ]);

        $coupon = new Coupon([
            'value' => 1000,
            'is_percent' => false,
        ]);

        $order = new Order($books);

        $order->applyCoupon($coupon);

        $this->assertEquals(8000, $order->total());
    }

    function test_an_order_is_discounted_by_a_percentage_when_a_percent_off_coupon_is_applied()
    {
        $books = collect([
            new Book(['price' => 2000]),
            new Book(['price' => 3000]),
            new Book(['price' => 4000]),
        ]);

        $coupon = new Coupon([
            'value' => 30,
            'is_percent' => true,
        ]);

        $order = new Order($books);

        $order->applyCoupon($coupon);

        $this->assertEquals(6300, $order->total());
    }
}
