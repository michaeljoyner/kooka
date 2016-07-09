<?php
use App\Stock\Price;

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 7/8/16
 * Time: 11:07 AM
 */
class PricesTest extends TestCase
{
    /**
     *@test
     */
    public function a_price_can_be_instantiated_from_a_string_of_user_input()
    {
        $price = Price::fromInputString('123.25');

        $this->assertEquals(12325, $price->inCents());
    }

    /**
     *@test
     */
    public function a_price_can_be_instantiated_from_a_integer_value_of_cents()
    {
        $price = Price::fromCents(12345);

        $this->assertEquals('123.45', $price->asCurrencyString());
    }
}