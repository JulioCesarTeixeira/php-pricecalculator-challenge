<?php


class Discount
{
    private int $groupFixDis = 0;
    private int $groupVarDis = 0;


    /**
     * discount constructor.
     * @param Pdo $pdo
     * @param $id
     */
    public function __construct(Pdo $pdo, $id)
    {
        $this->calcGroupDiscounts($pdo, $id);

    }


    private function calcGroupDiscounts(Pdo $pdo, $id): void
    {

        $query = $pdo->prepare('SELECT cg.parent_id, cg.fixed_discount, cg.variable_discount FROM customer_group cg WHERE cg.id = :id');
        $query->bindValue( 'id',$id);
        $query->execute();
        $rawDiscount = $query->fetch();


        $this->groupFixDis += $rawDiscount['fixed_discount'];
        if($this->groupVarDis < $rawDiscount['variable_discount']){
            $this->groupVarDis = $rawDiscount['variable_discount'];
        }

        if(!empty($rawDiscount['parent_id'])){
            $this->calcGroupDiscounts( $pdo, $rawDiscount['parent_id']);
        }

    }

    /**
     * @return int
     */
    public function getGroupVarDis(): int
    {
        return $this->groupVarDis;
    }

    /**
     * @return int
     */
    public function getGroupFixDis(): int
    {
        return $this->groupFixDis;
    }


}