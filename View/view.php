<?php require 'includes/header.php';?>
    <form>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Customers</label>
            <select class="form-control" id="exampleFormControlSelect1">
<?php  /** @var Customer $customer */
                foreach ($customers AS $customer):?>
                <option value="<?php echo $customer->getId() ?>"><?php echo $customer->getFirstname() ?></option>
                <?php endforeach; ?>
            </select>
            <label for="exampleFormControlSelect1">Products</label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
            </select>
        </div>
        <input type="hidden" name="ID" value=""/>
        <button type="submit" class="btn btn-primary" id="submit" name="run">Find Best Price</button>
    </form>

<?php require 'includes/footer.php';?>