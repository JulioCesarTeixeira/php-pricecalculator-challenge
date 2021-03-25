<?php


use JetBrains\PhpStorm\Pure;

class BestPrice
{
   private CONST HUNDREDPERCENT = 100;

    #[Pure] public static function CalcFinalPrice(Customer $cus, Product $pro, GroupDiscount $group): float|int
    {



        $customerVariable = $cus->getVariableDiscount();
        $customerFixed = $cus->getFixedDiscount();
        $groupVariable = $group->getVariableDiscount();
        $groupFixed = $group->getFixedDiscount();
        $price = $pro->getPrice();

        if ($groupFixed < $price * ($groupVariable) / self::HUNDREDPERCENT) {
            $groupFixed = null;
        } else {
            $groupVariable = null;
        }

        if ($customerFixed < $price * ($customerVariable) / self::HUNDREDPERCENT) {
            $customerFix = null;
        } else {
            $customerVariable = null;
        }

        if ($groupVariable > $customerVariable) {
            $customerVariable = null;
        } else {
            $groupVariable = null;
        }

        $bestPrice = ($price - $customerFixed - $groupFixed)*((self::HUNDREDPERCENT-$customerVariable)/self::HUNDREDPERCENT)*((self::HUNDREDPERCENT-$groupVariable)/self::HUNDREDPERCENT);
        return number_format(max($bestPrice, 0), 2) ;
    }

}