<?php require 'includes/header.php'; ?>
<?php
echo "You chose a <b>" . $productName. "</b> <br>";
echo "The normal price of your product would be: " . $productPrice."<br>";
echo "However, with our Price is Right you only have to pay : " . $finalPrice."<br>";
echo "<br>";
?>

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
            <?php echo $productName ?>
            <?php echo '$'. $productPrice ?>
        </div>
        <button type="submit" class="btn btn-primary" id="submit" name="run">Find Best Price</button>
    </form>


<?php require 'includes/footer.php'; ?>