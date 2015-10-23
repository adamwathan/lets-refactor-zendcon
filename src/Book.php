<?php

namespace App;

class Book
{
    public $price;

    public function __construct($attributes)
    {
        $this->price = $attributes['price'];
    }
}
