<?php
    include_once (__DIR__."/../classes/Inventory.php");

    if(!empty($_POST)){
        session_start();
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