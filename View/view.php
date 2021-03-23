<?php require 'includes/header.php';
var_dump($_POST)?>
    <form method="post">
        <div class="form-group">
            <label for="customer">Customers</label>
            <select class="form-control" id="customer" name="customers">
<?php  /** @var Customer $customer */
                foreach ($customers AS $customer):?>
                <option value="<?php echo $customer->getId() ?>"><?php echo $customer->getFirstname() ?></option>
                <?php endforeach; ?>
            </select>
            <label for="exampleFormControlSelect1">Products</label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option></option>
            </select>
        </div>
        <input type="hidden" name="id" value=""/>
        <button type="submit" class="btn btn-primary" id="submit" name="run">Find Best Price</button>
    </form>

<?php require 'includes/footer.php';?>