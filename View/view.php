<?php require 'includes/header.php'; ?>
<?php require 'includes/logout.php';?>
<?php
if (!empty($_SESSION['customer']) && !empty($_SESSION['product'])): ?>

    <p>Hey there <b><?php echo $customerName; ?></b></p>
    <p>You selected <b><?php echo $productName; ?></b></p>
    <p>The normal price of your product would be: <b>$ <?php echo $productPrice; ?></b></p>
    <p>With our Price is Right you only have to pay: <b>$ <?php echo $finalPrice; ?></b></p>
    <p>However, if you cannot get enough of it and wish to purchase the product in bulk, the price per unit would be:
        <b>$ <?php echo $bulkDiscount; ?></b></p>

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

<?php if (!empty($_SESSION['customer']) && !empty($_SESSION['product'])): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Product</th>
            <th scope="col">Full Price</th>
            <th scope="col">Fixed Discount</th>
            <th scope="col">Variable Discount</th>
            <th scope="col">Final Price</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $productName ?></td>
            <td><?php echo $productPrice ?></td>
            <td><?php echo $finalPrice ?></td>
            <td><?php echo $finalPrice ?></td>
            <td><?php echo $finalPrice ?></td>
        </tr>
        </tbody>
    </table>
<?php endif; ?>
<?php require 'includes/footer.php'; ?>