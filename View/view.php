<?php require 'includes/header.php'; ?>
<?php require 'includes/logout.php';
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header("Location:../index.php");
    exit;
} ?>

<?php
if (!empty($_SESSION['customer']) && !empty($_SESSION['product'])): ?>
    <?php echo $customerName . "</b> <br>";
    echo $productName . "</b> <br>";
    echo $productPrice . "</b> <br>";
    echo $finalPrice . "</b> <br>";
    echo $bulkDiscount . "</b> <br>";
    echo "<br>";
    ?>
<?php endif; ?>

    <div class="mx-auto col-12">
        <form method="post">
            <div class="form-group">
                <div>
                    <label for="customer">Customers</label>
                    <select class="form-control col-4" id="customer" name="customer">
                        <option value="">Select your Customer</option>
                        <?php /** @var Customer $customer */
                        foreach ($customers as $customer):?>
                            <option value="<?php echo $customer->getId() ?>"><?php echo $customer->getFirstname() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="product">Products</label>
                    <select class="form-control col-4" id="product" name="product">
                        <option value="">Select your Product</option>
                        <?php /** @var Product $product */
                        foreach ($products as $product):?>
                            <option value="<?php echo $product->getId() ?>"><?php echo $product->getName() . ": $" . $product->getPrice() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="product">Categories</label>
                    <a href="?allProducts" class="btn btn-danger d-block col-4">All Products</a>
                    <?php /** @var Product $product */
                    foreach ($categories as $category):?>
                        <a href="?category=<?php echo $category['category'] ?>"
                           class="btn btn-info d-block col-4 mt-2"><?php echo $category['category'] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="submit" name="run">Find Best Price</button>
        </form>
    </div>
<?php require 'includes/footer.php'; ?>