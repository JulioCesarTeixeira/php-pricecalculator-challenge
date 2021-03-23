<?php


class ProductLoader
{
    public static function getAllProducts(PDO $PDO) : array
    {
        $handle = $PDO->query('SELECT * FROM product');
        $arrayProducts = $handle->fetchAll();

        $products = [];
        foreach ($arrayProducts AS ['id' => $id, 'name' => $name, 'price' => $price]) {
            $customers[] = Product::LoadProduct(
                $id,
                $name,
                $price
            );
        }
        return $products;
    }
}