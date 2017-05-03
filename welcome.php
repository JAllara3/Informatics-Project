<?php
    $header1 = "Welcome to Fast Shop";
    $menuActive = 0;
    include_once('header.php');
?>

<div>
    <h3>Manage Your Store Here!</h3>
</div>
    
    <!--Unique Body Content-->
    <div class="btn-group btn-group-justified">
        <a href="Stores.php" class="btn btn-primary btn-lg custom">Edit Stores</a>
    </div>
    <div class="btn-group btn-group-justified">
        <a href="Products.php" class="btn btn-primary btn-lg">Edit Products</a>
    </div>
    <div class="btn-group btn-group-justified">
        <a href="PlacedOrders.php" class="btn btn-primary btn-lg">Placed Orders</a>
    </div>
    
    </body>
    
    <?php $footer = 'Footer';
    include_once("footer.php");
    ?>

</html>
