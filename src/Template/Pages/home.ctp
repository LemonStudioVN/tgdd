<?php 

 $this->layout = false;

 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
    <?= $this->Html->css('vendor/owl.carousel.css') ?>
    <?= $this->Html->css('vendor/magnific-popup.css') ?>
    <?= $this->Html->css('style.css') ?>
    
    <!-- favicon -->
    <?= $this->Html->meta('favicon','favicon.icon',['type'=>'icon']) ?>
    <title>Westeros | Home</title>
</head>
<body>
    <!-- HEADER -->
    <?= $this->Element('Client/header') ?>
    <!-- /HEADER -->

    <!-- MOBILE MENU COVER -->
    <?= $this->Element('Client/mobileCover') ?>
    <!-- /MOBILE MENU COVER -->

    <!-- MOBILE MENU -->
    <?= $this->Element('Client/mobileMenu') ?>
    <!-- /MOBILE MENU -->

    <!-- MAIN MENU -->
    <?= $this->Element('Client/mainMenu') ?>
    <!-- /MAIN MENU -->

    <!-- BANNER -->
    <?= $this->Element('Client/banner') ?>
    <!-- /BANNER -->

    <!-- ADVERTISING -->
    <?= $this->Element('Client/advertising') ?>
    <!-- /ADVERTISING -->

    <!-- PRODUCT SHOWCASE FEATURED PRODUCT-->
    <?= $this->Element('Client/featuredProduct') ?>
    <!-- /PRODUCT SHOWCASE FEATURED PRODUCT-->

    <!-- PRODUCT SHOWCASE BEST SELLING -->
    <?= $this->Element('Client/bestSelling') ?>
    <!-- /PRODUCT SHOWCASE BEST SELLING -->

    <!-- INSTITUTIONAL -->   
    <?= $this->Element('Client/institutional') ?>
    <!-- /INSTITUTIONAL -->

    <!-- LATEST BLOG POSTS -->
    <?= $this->Element('Client/lastedBlog') ?>
    <!-- /LATEST BLOG POSTS -->

    <!-- BILLBOARD -->
    <?= $this->Element('Client/billboard') ?>
    <!-- /BILLBOARD -->

    <!-- BRANDS -->
    <?= $this->Element('Client/brand') ?>
    <!-- /BRANDS -->

    <!-- FOOTER -->
    <?= $this->Element('Client/footer') ?>
    <!-- /FOOTER -->

    <!-- SVG FILE -->
    <?= $this->Element('Client/svg') ?>
    <!-- /SVG FILE -->

<!-- jQuery -->
<script src="js/vendor/jquery-1.11.1.min.js"></script>
<!-- XM Accordion -->
<script src="js/vendor/jquery.xmaccordion.min.js"></script>
<!-- Owl Carrousel -->
<script src="js/vendor/owl.carousel.min.js"></script>
<!-- Magnific Popup -->
<script src="js/vendor/jquery.magnific-popup.min.js"></script>
<!-- imgLiquid -->
<script src="js/vendor/imgLiquid-min.js"></script>
<!-- Header -->
<script src="js/header.js"></script>
<!-- Menu -->
<script src="js/menu.js"></script>
<!-- Home -->
<script src="js/home.js"></script>
</body>
</html>