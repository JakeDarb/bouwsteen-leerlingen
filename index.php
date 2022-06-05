<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bouwsteen leerlingen | De app om kinderen van de lagere school meer motivatie te geven </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        include_once(__DIR__ . "/classes/Inventory.php");
        $categories = Inventory::get_categories();
    ?>
    <header class="menu">
        <div class="coin menu--item">
            <img src="images/munt.png" alt="coin icon" class="coin--icon">
            <span class="coin--amount">50</span>
        </div>
        <a href="#" class="menu--item logout">
            <img src="images/logout.svg" alt="logout">
        </a> 
    </header>
    <main>
        <div class="character main--item">
            <div class="character--pedestal character-alignment">
                <div class="character--hair character-alignment character-clothes">
                    <img src="images/characters/body/hair/hairstyle1_brown.svg" alt="character hair">
                </div>
                <div class="character--face character-alignment character-clothes">
                    <img src="images/characters/body/faces/face1_skintone-white1.svg" alt="character hair">
                </div>
                <div class="character--neck character-alignment character-clothes">
                    <img src="images/characters/body/necks/neck1_skintone-white1.svg" alt="character hair">
                </div>
                <div class="character--shirt character-alignment character-clothes">
                    <img src="images/characters/clothing/shirts/shirt1_blue.svg" alt="character hair">
                </div>
                <div class="character--arms character-alignment character-clothes">
                    <img src="images/characters/body/arms/arms1_skintone-white1.svg" alt="character hair">
                </div>
                <div class="character--pants character-alignment character-clothes">
                    <img src="images/characters/clothing/pants/pants1_brown.svg" alt="character hair">
                </div>
                <div class="character--legs character-alignment character-clothes">
                    <img src="images/characters/body/legs/legs1_skintone-white1.svg" alt="character hair">
                </div>
                <div class="character--shoes character-alignment character-clothes">
                    <img src="images/characters/clothing/shoes/sneakers1_purple.svg" alt="character hair">
                </div>
                <img src="images/characters/extra/pedestal1.svg" alt="character pedestal">
            </div>
        </div>
        <div class="main--item">
            <div class="nav nav--open">
                <a href="" class="nav--item" data-page="wardrobe"><img src="images/wardrobe.svg" alt="wardrobe"></a>
                <a href="" class="nav--item" data-page="shop"><img src="images/shop.svg" alt="shop"></a>
                <a href="" class="nav--item" data-page="tasks"><img src="images/tasks.svg" alt="tasks"></a>
            </div>
            
            <div class="list list--open">
                <?php if($_GET['p']=="wardrobe"||$_GET['p']=="shop"): ?>
                    <?php if(!isset($_GET['c'])): ?>
                        <?php foreach($categories as $category): ?>
                        <a href="" class="list--item list--item-selected" data-category="<?php echo $category["name"] ?>">
                            <div class="list--item-content">
                                <img src="<?php echo $category["path"] ?>" alt="<?php echo $category["name"] ?>">
                            </div>
                        </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php else: ?>
                
                <?php endif; ?>
            </div>
        </div>
    </main>
    <!--<script src="js/ajax_getParameters.js"></script>-->
    <script src="js/menu.js"></script>
    <script src="js/getCategory.js"></script>
</body>
</html>