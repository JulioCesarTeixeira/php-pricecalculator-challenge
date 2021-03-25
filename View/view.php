<?php require 'includes/header.php'; ?>

    <form method="post">
        <div class="form-group">

            <label for="customer">Customers</label>
            <select class="form-control col-2" id="customer" name="customer">
                <option value="" >Select your Customer</option>
                <?php /** @var Customer $customer */
                foreach ($customers as $customer):?>
                    <option value="<?php echo $customer->getId()?>"><?php echo $customer->getFirstname() ?></option>
                <?php endforeach; ?>
            </select>

            <label for="product">Products</label>
            <select class="form-control col-2" id="product" name="product">
                <option value="" >Select your Product</option>
                <?php /** @var Product $product */
                foreach ($products as $product):?>
                    <option value="<?php echo $product->getId() ?>"><?php echo $product->getName() . ": $" . $product->getPrice() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" id="submit" name="run">Find Best Price</button>
    </form>

<?php
echo $customerName."<br>";
echo $productName."<br>" ;
echo $productPrice."<br>";
echo $finalPrice."<br>";
?>

<?php require 'includes/footer.php'; ?>