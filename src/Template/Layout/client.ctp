<?php 

 $this->layout = false;

 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->charset() ?>   
    <?= $this->Html->meta('view',['name'=>'viewport','content'=>'width=device-width, minimum-scale=1.0, maximum-scale=1.0']) ?>
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

    <!-- CONTENT -->
    <?= $this->fetch('content') ?>
    <!-- /CONTENT -->

    <!-- FOOTER -->
    <?= $this->Element('Client/footer') ?>
    <!-- /FOOTER -->

    <!-- SVG FILE -->
    <?= $this->Element('Client/svg') ?>
    <!-- /SVG FILE -->

    <!-- jQuery -->
    <?= $this->Html->script('vendor/jquery-1.11.1.min.js') ?>
    <!-- XM Accordion -->
    <?= $this->Html->script('vendor/jquery.xmaccordion.min.js') ?>
    <!-- Owl Carrousel -->
    <?= $this->Html->script('vendor/owl.carousel.min.js') ?>
    <!-- Magnific Popup -->
    <?= $this->Html->script('vendor/jquery.magnific-popup.min.js') ?>
    <!-- imgLiquid -->
    <?= $this->Html->script('vendor/imgLiquid-min.js') ?>
    <!-- Header -->
    <?= $this->Html->script('header.js') ?>
    <!-- Menu -->
    <?= $this->Html->script('menu.js') ?>
    <!-- Home -->
    <?= $this->Html->script('home.js') ?>

</body>
</html>