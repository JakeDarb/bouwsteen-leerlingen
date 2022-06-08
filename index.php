<?php
    include_once(__DIR__ . "/classes/Inventory.php");
    include_once(__DIR__ . "/includes/checkSession.php");
    $categories = Inventory::get_categories();
    $clothing = Inventory::getOutfit($_SESSION["student"]);
?>
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
    <div class="popup">
        <div class="popup-buy">
            <p>Ben je zeker dat je <span class="item-name"></span> wil kopen voor <span class="item-price"></span> munten?</p>
            <div class="popup-buttons">
                <div class="button-box">
                    <a href="#" class="button button-decline">nee</a>
                </div>
                <div class="button-box">
                    <a href="#" class="button button-accept">ja</a>
                </div>
            </div>
        </div>
    </div>      
    <header class="menu">
        <div class="coin menu--item">
            <img src="images/munt.png" alt="coin icon" class="coin--icon">
            <span class="coin--amount"><?php echo $_SESSION["studentWalletAmount"]; ?></span>
        </div>
        <a href="./login.php" class="menu--item logout">
            <img src="images/logout.svg" alt="logout">
        </a> 
    </header>
    <main>
        <div class="character main--item" data-student="<?php echo $_SESSION["student"]; ?>">
            <div class="character--pedestal character-alignment">
                <a href="#" class="button button-buy">Kopen</a>
                
                    <div class="character--hats character-alignment character-clothes">
                        <?php for($i=0; $i<sizeof($clothing); $i++): ?>
                            <?php if($clothing[$i]["name"]=="hats"): ?>
                                <img src="<?php echo $clothing[$i]["path"]; ?>" alt="character <?php echo $clothing[$i]["name"]; ?>">
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <div class="character--facewear character-alignment character-clothes">
                        <?php for($i=0; $i<sizeof($clothing); $i++): ?>
                            <?php if($clothing[$i]["name"]=="facewear"): ?>
                                <img src="<?php echo $clothing[$i]["path"]; ?>" alt="character <?php echo $clothing[$i]["name"]; ?>">
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <div class="character--shirts character-alignment character-clothes">
                        <?php for($i=0; $i<sizeof($clothing); $i++): ?>
                            <?php if($clothing[$i]["name"]=="shirts"): ?>
                                <img src="<?php echo $clothing[$i]["path"]; ?>" alt="character <?php echo $clothing[$i]["name"]; ?>">
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <div class="character--pants character-alignment character-clothes">
                        <?php for($i=0; $i<sizeof($clothing); $i++): ?>
                            <?php if($clothing[$i]["name"]=="pants"): ?>
                                <img src="<?php echo $clothing[$i]["path"]; ?>" alt="character <?php echo $clothing[$i]["name"]; ?>">
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <div class="character--shoes character-alignment character-clothes">
                        <?php for($i=0; $i<sizeof($clothing); $i++): ?>
                            <?php if($clothing[$i]["name"]=="shoes"): ?>
                                <img src="<?php echo $clothing[$i]["path"]; ?>" alt="character <?php echo $clothing[$i]["name"]; ?>">
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                
                <div class="character--hair character-alignment character-clothes">
                    <img src="images/characters/body/hair/hairstyle1_brown.svg" alt="character hair">
                </div>
                <div class="character--brows character-alignment character-clothes">
                    <img src="images/characters/body/brows/brows1_brown.svg" alt="character hair">
                </div>
                <div class="character--eyes character-alignment character-clothes">
                    <img src="images/characters/body/eyes/eyes1_green.svg" alt="character hair">
                </div>
                <div class="character--noses character-alignment character-clothes">
                    <img src="images/characters/body/noses/noses1_skintone-white1.svg" alt="character hair">
                </div>
                <div class="character--mouths character-alignment character-clothes">
                    <img src="images/characters/body/mouths/mouths1_skintone-white1.svg" alt="character hair">
                </div>
                <div class="character--face character-alignment character-clothes">
                    <img src="images/characters/body/faces/face1_skintone-white1.svg" alt="character hair">
                </div>
                <div class="character--neck character-alignment character-clothes">
                    <img src="images/characters/body/necks/neck1_skintone-white1.svg" alt="character hair">
                </div>
                <div class="character--arms character-alignment character-clothes">
                    <img src="images/characters/body/arms/arms1_skintone-white1.svg" alt="character hair">
                </div>
                <div class="character--torsos character-alignment character-clothes">
                    <img src="images/characters/body/torsos/torsos1_skintone-white1.svg" alt="character hair">
                </div>
                <div class="character--legs character-alignment character-clothes">
                    <img src="images/characters/body/legs/legs1_skintone-white1.svg" alt="character hair">
                </div>
                <div class="character--feet character-alignment character-clothes">
                    <img src="images/characters/body/feet/feet1_skintone-white1.svg" alt="character hair">
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
                        <a href="" class="list--item list--item-category" data-category="<?php echo $category["name"] ?>">
                            <div class="list--item-content">
                                <img src="<?php echo $category["path"] ?>" alt="<?php echo $category["name"] ?>">
                            </div>
                        </a>
                        <?php endforeach; ?>
                    
                    <!-- SHOP HANDLER -->
                    <?php elseif($_GET["p"]=="shop"&&isset($_GET["c"])): ?>
                        <?php $shopItems = Inventory::get_shopItems($_GET["c"], $_SESSION["studentId"]); ?>
                        <a href="" class="list--item">
                            <div class="list--item-content">
                                <img src="" alt="nothing">
                            </div>
                        </a>
                        <?php if($shopItems): ?>
                            <?php foreach($shopItems as $shopItem): ?>
                                <a href="" class="list--item list--item-shop" data-name="<?php echo $shopItem["name"] ?>" data-price="<?php echo $shopItem["price"] ?>" data-item="<?php echo $shopItem["id"] ?>" data-path="<?php echo $shopItem["path"] ?>">
                                    <div class="list--item-content">
                                        <img src="<?php echo $shopItem["thumbnail"] ?>" alt="<?php echo $shopItem["name"] ?>">
                                        <span class="list--item-shop-price"><?php echo $shopItem["price"] ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    
                    <!-- WARDROBE HANDLER -->
                    <?php elseif($_GET["p"]=="wardrobe"&&isset($_GET["c"])): ?>
                        <?php $wardrobeItems = Inventory::get_wardrobeItems($_SESSION["studentId"], $_GET["c"]); ?>
                        <a href="" class="list--item <?php if(!$clothing){
                            echo "list--item-selected";}else{
                                for($i=0; $i<sizeof($clothing); $i++){
                                    if(!$clothing[$i]["name"]=="pants"){
                                        echo "list--item-selected";
                                    }
                                }
                            } ?>" data-item="0">
                            <div class="list--item-content">
                                <img src="" alt="nothing">
                            </div>
                        </a>

                        <?php if($wardrobeItems): ?>
                            <?php foreach($wardrobeItems as $wardrobeItem): ?>
                                <a href="" class="list--item list--item-wardrobe <?php if($wardrobeItem["is_wearing"]){echo "list--item-selected";} ?>" data-item="<?php echo $wardrobeItem["id"] ?>" data-path="<?php echo $wardrobeItem["path"] ?>">
                                    <div class="list--item-content">
                                        <img src="<?php echo $wardrobeItem["thumbnail"] ?>" alt="<?php echo $wardrobeItem["name"] ?>">
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                <?php else: ?>
                
                <?php endif; ?>
            </div>
        </div>
    </main>
    <!--<script src="js/ajax_getParameters.js"></script>-->
    <script src="js/menu.js"></script>
    <script src="js/shopHandler.js"></script>
    <script src="js/getCategory.js"></script>
</body>
</html>