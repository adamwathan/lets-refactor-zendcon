<?php

use App\Book;
use App\Coupon;
use App\FixedValueCoupon;
use App\MinimumQuantityCoupon;
use App\Order;
use App\PercentOffCoupon;

class AddCouponToOrderTest extends PHPUnit_Framework_TestCase
{
    public function test_no_discount_is_applied_if_there_is_no_coupon()
    {
        $books = [
            new Book(['price' => 500]),
            new Book(['price' => 1200]),
            new Book(['price' => 2000]),
        ];

        $order = new Order($books);

        $this->assertEquals(3700, $order->total());
    }

    public function test_a_percent_discount_is_applied_when_a_percent_off_coupon_is_used()
    {
        $books = [
            new Book(['price' => 500]),
            new Book(['price' => 1200]),
            new Book(['price' => 2000]),
        ];

        $order = new Order($books);

        $coupon = new PercentOffCoupon([
            'value' => 30,
        ]);

        $order->applyCoupon($coupon);

        $this->assertEquals(2590, $order->total());
    }

    public function test_a_fixed_discount_is_applied_when_a_fixed_value_coupon_is_used()
    {
        $books = [
            new Book(['price' => 500]),
            new Book(['price' => 1200]),
            new Book(['price' => 2000]),
        ];

        $order = new Order($books);

        $coupon = new FixedValueCoupon([
            'value' => 1000,
        ]);

        $order->applyCoupon($coupon);

        $this->assertEquals(2700, $order->total());
    }

    public function test_a_percent_discount_is_applied_when_a_minimum_quantity_coupon_is_used_and_the_minimum_quantity_is_met()
    {
        $books = [
            new Book(['price' => 500]),
            new Book(['price' => 1200]),
            new Book(['price' => 2000]),
        ];

        $order = new Order($books);

        $coupon = new MinimumQuantityCoupon(
            new PercentOffCoupon([
                'value' => 30,
            ]),
            3
        );

        $order->applyCoupon($coupon);

        $this->assertEquals(2590, $order->total());
    }

    public function test_no_discount_is_applied_when_a_minimum_quantity_coupon_is_used_and_the_minimum_quantity_is_not_met()
    {
        $books = [
            new Book(['price' => 500]),
            new Book(['price' => 1200]),
            new Book(['price' => 2000]),
        ];

        $order = new Order($books);

        $coupon = new MinimumQuantityCoupon(
            new PercentOffCoupon([
                'value' => 30,
            ]),
            4
        );

        $order->applyCoupon($coupon);

        $this->assertEquals(3700, $order->total());
    }


    public function test_a_fixed_discount_is_applied_when_a_minimum_quantity_coupon_is_used_and_the_minimum_quantity_is_met()
    {
        $books = [
            new Book(['price' => 500]),
            new Book(['price' => 1200]),
            new Book(['price' => 2000]),
        ];

        $order = new Order($books);

        $coupon = new MinimumQuantityCoupon(
            new FixedValueCoupon([
                'value' => 1000,
            ]),
            3
        );

        $order->applyCoupon($coupon);

        $this->assertEquals(2700, $order->total());
    }
}
