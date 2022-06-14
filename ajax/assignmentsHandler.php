<?php
    include_once (__DIR__."/../classes/Assignments.php");
    try{
        if(!empty($_POST)){
            session_start();
            Assignments::addPoints($_POST["reward"], $_SESSION["student"]);
            Assignments::claimAssignmentReward($_POST["assignment"], $_SESSION["student"]);
            // Set session data
            $_SESSION["studentWalletAmount"] += $_POST['reward'];
            $response = [
                'status' => 'success',
                'body' => $data,
                'message' => 'Reported post'
            ];

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }catch (Exception $e) {
        $response = [
            'status' => 'Failed',
            'body' => $e,
            'message' => 'Something went wrong.'
        ];
        echo json_encode($response);
    }