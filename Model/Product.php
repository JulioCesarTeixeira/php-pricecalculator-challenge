<?php


use JetBrains\PhpStorm\Pure;

class Product
{
        private ?int $id;
        private string $name;
        private int $price;

    /**
     * Product constructor.
     * @param int $id
     * @param string $name
     * @param int $price
     */
    public function __construct( int $id, string $name, int $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;

    }

    #[Pure] public static function GetProduct(int $id, string $name, int $price) : Product
    {
        return new Product ($id,$name, $price);
    }

    public static function LoadProduct(PDO $pdo, int $id) : Product
    {
        $handle = $pdo->prepare('SELECT * FROM product p WHERE p.id = :id');
        $handle->bindValue('id', $id);
        $handle->execute();
        $rawData = $handle->fetch();
        return new Product (
            $rawData['id'],
            $rawData['name'],
            (int)$rawData['price']);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    #[Pure] public function getPrice(): float
    {
        return number_format($this->price/100, 2) ;
    }


}