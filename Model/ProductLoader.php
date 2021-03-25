<?php


class ProductLoader
{
    public static function getAllProducts(PDO $PDO) : array
    {
        $handle = $PDO->query('SELECT * FROM product ORDER BY name');
        $arrayProducts = $handle->fetchAll();

        $products = [];
        foreach ($arrayProducts AS ['id' => $id, 'name' => $name, 'price' => $price]) {
            $products[] = Product::GetProduct(
                $id,
                $name,
                $price
            );
        }
        return $products;
    }
}