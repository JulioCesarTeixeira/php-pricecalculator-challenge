<?php


class ProductLoader
{
//    public static function getAllProducts(PDO $PDO) : array
//    {
//        $handle = $PDO->query('SELECT * FROM product p ORDER BY p.name');
//        $arrayProducts = $handle->fetchAll();
//
//        $products = [];
//        foreach ($arrayProducts AS ['id' => $id, 'name' => $name, 'price' => $price]) {
//            $products[] = Product::GetProduct(
//                $id,
//                $name,
//                $price
//            );
//        }
//        return $products;
//    }

    public static function getAllProducts(PDO $PDO, $category = null): array
    {
        if($category === null){
            $handle = $PDO->query('SELECT * FROM product p ORDER BY p.name');
        } else {
            $handle = $PDO->prepare('SELECT * FROM product p WHERE category = :category ORDER BY p.name');
            $handle->bindValue(':category', $category);
            $handle->execute();
            }
        $arrayProducts = $handle->fetchAll();

        $products = [];
        foreach ($arrayProducts AS ['id' => $id, 'name' => $name, 'price' => $price, 'category' => $category]) {
            $products[] = Product::GetProduct(
                $id,
                $name,
                $price,
                $category
            );
        }
        return $products;
    }

    public static function getAllCategories(PDO $PDO): array
    {
        $handle = $PDO->query('SELECT DISTINCT p.category FROM product p WHERE p.category IS NOT NULL ;');
        return $handle->fetchAll();
    }
}