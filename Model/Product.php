<?php


class Product
{
        private ?int $id = null;
        private string $name;
        private int $price;

    /**
     * Product constructor.
     * @param string $name
     * @param int $price
     */
    public function __construct(string $name, int $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public static function LoadProduct(int $id, string $name, int $price) : Product
    {
        $product = new Product ($name, $price);
        $product->id = $id;
        return $product;
    }

}