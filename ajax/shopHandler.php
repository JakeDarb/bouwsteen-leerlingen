<?php
    include_once (__DIR__."/../classes/Inventory.php");

    if(!empty($_POST)){
        session_start();
        if($_POST['page'] == "wardrobe"){
            try{
                if(!$_POST["removeClothing"]){
                    // Update is_wearing in database
                    Inventory::changeClothes($_POST["oldAccessoriesId"], $_POST["accessoriesId"]);
                }else{
                    // Remove clothing in database
                    Inventory::removeClothing($_POST["accessoriesId"], $_POST["studentName"]);
                }

                $response = [
                    'status' => 'success',
                    'body' => $data,
                    'message' => 'Reported post'
                ];
    
                header('Content-Type: application/json');
                echo json_encode($response);
            }catch (Exception $e) {
                $response = [
                    'status' => 'Failed',
                    'body' => $e,
                    'message' => 'Something went wrong.'
                ];
                echo json_encode($response);
            }
        }else{
            try{
                // Buy item
                Inventory::buyItem($_POST['studentName'], $_POST['accessoriesId']);
                // Remove points
                Inventory::deductPoints($_POST['itemPrice'], $_POST['studentName']);
                // Set session data
                $_SESSION["studentWalletAmount"] -= $_POST['itemPrice'];
    
                $response = [
                    'status' => 'success',
                    'body' => $data,
                    'message' => 'Reported post'
                ];
    
                header('Content-Type: application/json');
                echo json_encode($response);
            }catch (Exception $e) {
                $response = [
                    'status' => 'Failed',
                    'body' => $e,
                    'message' => 'Something went wrong.'
                ];
                echo json_encode($response);
            }
        }
    }