<?php
    $header1 = "Welcome to Fast Shop";
    $menuActive = 0;
    include_once('header.php');
?>
<title>Welcome to Fast Shop</title>

<body background = "fBG.jpg">

<div>
    <h3 align="center"><strong>Manage Your Store Here!</strong></h3>
</div>
    
    <!--Unique Body Content-->
    <div class="btn-group btn-group-justified">
        <a href="Stores.php" class="btn btn-primary btn-lg custom">Edit Stores</a>
    </div>
    <div class="btn-group btn-group-justified">
        <a href="Categories.php" class="btn btn-primary btn-lg">Edit Categories</a>
    </div>
    <div class="btn-group btn-group-justified">
        <a href="Products.php" class="btn btn-primary btn-lg">Edit Products</a>
    </div>
    
    </body>
    
    <?php $footer = 'Footer';
    include_once("footer.php");
    ?>

</html>
