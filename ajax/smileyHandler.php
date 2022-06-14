<?php
    include_once (__DIR__."/../classes/Student.php");
    include_once (__DIR__."/../classes/Smileys.php");
    try{
        if(!empty($_POST)){
            session_start();
            Smileys::updateSmileys($_POST["smileyDescription"], $_POST["smileyId"], $_SESSION["student"]);
            // Set session data
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