<?php
try{
    include_once(__DIR__ . "/classes/Inventory.php");
    include_once(__DIR__ . "/classes/Assignments.php");
    include_once(__DIR__ . "/classes/Student.php");
    include_once(__DIR__ . "/classes/Smileys.php");
    include_once(__DIR__ . "/includes/checkSession.php");
    
        $categories = Inventory::get_categories();
    
    $clothing = Inventory::getOutfit($_SESSION["student"]);
    function containsItem(array $arr, $key){
        for($i=0; $i<sizeof($arr); $i++){
            if($arr[$i]["name"]==$key){
                return true;
            }
        }
        return false;
    }
    if($_GET["p"]=="tasks"){
        $claimableAssignments = Assignments::countClaimable($_SESSION["student"]);
        $finishedAssignments = Assignments::getFinishedAssignments($_SESSION["student"]);
        $classes = Assignments::getStudentClasses($_SESSION["class"]);
    }
    if($_GET["p"]=="tasks"&&isset($_GET["c"])){
        $subjectAssignments = Assignments::getAssignments($_SESSION["student"], $_GET["c"]);
    }
    $smileys = Smileys::getSmileys();
    $lastSmileyDate = strval(Student::getLastSmileyDate($_SESSION["student"]));
    $currentDate = date("Y-m-d");
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bouwsteen leerlingen | De app om kinderen van de lagere school meer motivatie te geven </title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
</head>
<body>
    <?php echo htmlspecialchars($error); ?>
    <div class="popup">
        <div class="popup-box popup-shop">
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
            <?php foreach($subjectAssignments as $subjectAssignment): ?>
            <div class="popup-box popup-description" data-popupAssignment="<?php echo htmlspecialchars($subjectAssignment["id"]); ?>">
                
                <p class="popup-descriptionContent"><?php echo htmlspecialchars($subjectAssignment["description"]); ?></p>
                <div class="popup-buttons popup-buttons-description">
                    <div class="button-box">
                        <a href="#" class="button button-accept button-read">ok</a>
                    </div>
                </div>
                
            </div>
            
            <?php endforeach; ?>
    </div>      
    <?php if($lastSmileyDate != $currentDate): ?>
        <div class="popup popup-smileys">
            <div class="popup-box smileys__choice">
                <h2>Hoe voel je je vandaag?</h2>
                <div class="popup-buttons">
                    <div class="button-box">
                        <?php for($i=0; $i<sizeof($smileys)-1; $i++): ?>
                        <a href="" class="button btnSmiley" data-smiley="<?php echo htmlspecialchars($smileys[$i]["id"]); ?>">
                            <div class="button-smiley">
                                <svg xmlns="https://www.w3.org/2000/svg" width="44" height="44">   
                                     <?php echo '<path ' . $smileys[$i]["path"] . '/>'; ?>
                                </svg>
                                
                            </div>
                        </a>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        
            <div class="popup-box smileys__explain">
                <h2>Leg uit:</h2>
                <div class="smileys-explainText">
                    <textarea name="smileys-explainText" id="smileys-explainText" cols="30" rows="10"></textarea>
                </div>
                <div class="popup-buttons">
                    <div class="button-box">
                        <a href="#" class="button button-accept button-smileys" id="button-smileys">ok</a>
                    </div>
                </div>
            </div>
        </div>     
    <?php endif; ?>
    <header class="menu">
        <div class="coin menu--item">
            <img src="images/munt.png" alt="coin icon" class="coin--icon">
            <span class="coin--amount"><?php echo htmlspecialchars($_SESSION["studentWalletAmount"]); ?></span>
        </div>
        <a href="./login.php" class="menu--item logout">
            <img src="images/logout.svg" alt="logout">
        </a> 
    </header>
    <main>
        <div class="character main--item" data-student="<?php echo htmlspecialchars($_SESSION["student"]); ?>">
            <div class="character--pedestal character-alignment">
                <a href="#" class="button button-buy">Kopen</a>

                <?php foreach($clothing as $piece): ?>
                    <div class="character--<?php echo htmlspecialchars($piece["name"]); ?> character-alignment character-clothes">
                        <img src="<?php echo htmlspecialchars($piece["path"]); ?>" alt="character <?php echo htmlspecialchars($piece["name"]); ?>">
                    </div>
                <?php endforeach; ?>
                
                
                
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
                <div class="character--feet character-alignment character-clothes" <?php if(containsItem($clothing, "shoes")){echo "style='display:none;'";} ?>>
                    <img src="images/characters/body/feet/feet1_skintone-white1.svg" alt="character hair">
                </div>
                <img src="images/characters/extra/pedestal1.svg" alt="character pedestal">
            </div>
        </div>
        <div class="main--item">
            <div class="nav nav--open<?php if($_GET['p']=="tasks"){ echo htmlspecialchars(" nav-assignments nav-assignments--open"); } ?>">
                <a href="" class="nav--item" data-page="wardrobe"><img src="images/wardrobe.svg" alt="wardrobe"></a>
                <a href="" class="nav--item" data-page="shop"><img src="images/shop.svg" alt="shop"></a>
                <a href="" class="nav--item" data-page="tasks"><img src="images/tasks.svg" alt="tasks"></a>
            </div>
            <div class="nav nav-back nav-back--open<?php if($_GET['p']=="tasks"){ echo htmlspecialchars(" nav-assignments nav-backAssignments--open"); } ?>">
                <a href="" class="nav--back"><img src="images/goBack.svg"></a>
            </div>
            
            <?php if($_GET['p']=="wardrobe"||$_GET['p']=="shop"): ?>
                <div class="list list--open">
                    <?php if(!isset($_GET['c'])): ?>
                        <?php foreach($categories as $category): ?>
                        <a href="" class="list--item list--item-category" data-category="<?php echo htmlspecialchars($category["name"]); ?>">
                            <div class="list--item-content">
                                <img src="<?php echo htmlspecialchars($category["path"]); ?>" alt="<?php echo htmlspecialchars($category["name"]); ?>">
                            </div>
                        </a>
                        <?php endforeach; ?>
                    
                    <!-- SHOP HANDLER -->
                    <?php elseif($_GET["p"]=="shop"&&isset($_GET["c"])): ?>
                        <?php $shopItems = Inventory::get_shopItems($_GET["c"], $_SESSION["studentId"]); ?>
                        <a href="" class="list--item list--item-delete">
                            <div class="list--item-content">
                                <img src="images/nothing.svg" alt="nothing">
                            </div>
                        </a>
                        <?php if($shopItems): ?>
                            <?php foreach($shopItems as $shopItem): ?>
                                <a href="" class="list--item list--item-shop" data-name="<?php echo htmlspecialchars($shopItem["name"]); ?>" data-price="<?php echo htmlspecialchars($shopItem["price"]); ?>" data-item="<?php echo htmlspecialchars($shopItem["id"]); ?>" data-path="<?php echo htmlspecialchars($shopItem["path"]); ?>">
                                    <div class="list--item-content">
                                        <img src="<?php echo htmlspecialchars($shopItem["thumbnail"]); ?>" alt="<?php echo htmlspecialchars($shopItem["name"]); ?>">
                                        <span class="list--item-shop-price"><?php echo htmlspecialchars($shopItem["price"]); ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    
                    <!-- WARDROBE HANDLER -->
                    <?php elseif($_GET["p"]=="wardrobe"&&isset($_GET["c"])): ?>
                        <?php $wardrobeItems = Inventory::get_wardrobeItems($_SESSION["studentId"], $_GET["c"]); ?>
                        <a href="" class="list--item list--item-delete" data-item="0">
                            <div class="list--item-content">
                                <img src="images/nothing.svg" alt="nothing">
                            </div>
                        </a>

                        <?php if($wardrobeItems): ?>
                            <?php foreach($wardrobeItems as $wardrobeItem): ?>
                                <a href="" class="list--item list--item-wardrobe <?php if($wardrobeItem["is_wearing"]){echo htmlspecialchars("list--item-selected");} ?>" data-item="<?php echo htmlspecialchars($wardrobeItem["id"]); ?>" data-path="<?php echo htmlspecialchars($wardrobeItem["path"]); ?>">
                                    <div class="list--item-content">
                                        <img src="<?php echo htmlspecialchars($wardrobeItem["thumbnail"]); ?>" alt="<?php echo htmlspecialchars($wardrobeItem["name"]); ?>">
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="list list--open list-assignments list-assignments--open">
                    <!-- ASSIGNMENTS HANDLER -->
                    <?php if(!isset($_GET['c'])): ?>
                    <a href="" class="list--item list--item-autoheight list--item-assignments list--item-assignmentsCompleted" data-category="completed">
                        <div class="list--item-content">
                            <p>Voltooide opdrachten</p>
                            <?php if($claimableAssignments > 0): ?>
                                <span class="newCompleted"><?php echo htmlspecialchars($claimableAssignments); ?></span>
                            <?php endif; ?>
                        </div>
                    </a>
                    <?php foreach($classes as $class): ?>
                    <a href="" class="list--item list--item-assignments list--item-assignmentsSquare" data-category="<?php echo htmlspecialchars($class["name"]); ?>">
                        <div class="list--item-content list--item-assignmentContent">
                           <span class="list--item-assignmentsTitle"><?php echo htmlspecialchars($class["name"]); ?></span>
                        </div>
                    </a>
                    <?php endforeach; ?>
                    <?php elseif($_GET['c']=="completed"): ?>
                        <?php for($i=0; $i<sizeof($finishedAssignments); $i++): ?>
                            <?php if($i==0 || $finishedAssignments[$i]["subject"]!=$finishedAssignments[$i-1]["subject"]): ?>
                                <h2><?php echo htmlspecialchars($finishedAssignments[$i]["subject"]); ?></h2>
                            <?php endif; ?>
                            <div class="list--item list--item-autoheight  list--item-assignmentsCompleted list--item-assignmentsCompletedContent" data-assignmentContainer="<?php echo htmlspecialchars($finishedAssignments[$i]["id"]); ?>" data-assignmentReward="<?php echo htmlspecialchars($finishedAssignments[$i]["reward"]); ?>"> 
                            <p><?php echo htmlspecialchars($finishedAssignments[$i]["name"]); ?></p>
                            <span class="list--item-assignmentsCompletedContent-reward"><?php echo htmlspecialchars($finishedAssignments[$i]["reward"]); ?></span>
                            <a href="" class="list--item-assignmentsCompletedClaim" data-assignment="<?php echo htmlspecialchars($finishedAssignments[$i]["id"]); ?>">Ontvang</a>
                        </div>
                        <?php endfor; ?>
                    <?php else: ?>
                        <?php for($i=0; $i<sizeof($subjectAssignments); $i++): ?>
                            <?php if($i==0 || $subjectAssignments[$i]["due_date"]!=$subjectAssignments[$i-1]["due_date"]): ?>
                                <h2><?php echo htmlspecialchars($subjectAssignments[$i]["due_date"]); ?></h2>
                            <?php endif; ?>
                            <a class="list--item list--item-autoheight list--item-assignmentsCompleted list--item-assignmentsCompletedContent readDescription" data-descriptionId="<?php echo htmlspecialchars($subjectAssignments[$i]["id"]); ?>">
                                <p href=""><?php echo htmlspecialchars($subjectAssignments[$i]["name"]); ?></p>
                                <span class="list--item-assignmentsContent-reward"><?php echo htmlspecialchars($subjectAssignments[$i]["reward"]); ?></span>
                            </a>
                        <?php endfor; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <script src="js/menu.js"></script>
    <script src="js/shopHandler.js"></script>
    <script src="js/getCategory.js"></script>
    <script src="js/assignmentsHandler.js"></script>
    <script src="js/smileyHandler.js"></script>
</body>
</html>