<?php


use JetBrains\PhpStorm\Pure;

class BestPrice
{
   private CONST HUNDRED_PERCENT = 100;

    #[Pure] public static function CalcFinalPrice(Customer $cus, Product $pro, GroupDiscount $group): float|int
    {

        $customerVariable = $cus->getVariableDiscount();
        $customerFixed = $cus->getFixedDiscount();
        $groupVariable = $group->getVariableDiscount();
        $groupFixed = $group->getFixedDiscount();
        $price = $pro->getPrice();

        if ($groupFixed < $price * ($groupVariable) / self::HUNDRED_PERCENT) {
            $groupFixed = null;
        } else {
            $groupVariable = null;
        }

        if ($customerFixed < $price * ($customerVariable) / self::HUNDRED_PERCENT) {
            $customerFix = null;
        } else {
            $customerVariable = null;
        }

        if ($groupVariable > $customerVariable) {
            $customerVariable = null;
        } else {
            $groupVariable = null;
        }

        $bestPrice = ($price - $customerFixed - $groupFixed)*((self::HUNDRED_PERCENT-$customerVariable)/self::HUNDRED_PERCENT)*((self::HUNDRED_PERCENT-$groupVariable)/self::HUNDRED_PERCENT);
        return number_format(max($bestPrice,0), 2) ;
    }

}