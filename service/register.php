<?php

include 'connect.php';

if($_POST){

    //POST DATA
    $username = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['username'] ?? '';

    $response = [];

    //Cek username didalam databse
    $userQuery = $connect->prepare("SELECT * FROM registeruser where email = ?");
    $userQuery->execute(array($username));

    // Cek username apakah ada tau tidak
    if($userQuery->rowCount() != 0){
        // Beri Response
        $response['status']= false;
        $response['message']='Akun sudah digunakan';
    } else {
        $insertAccount = "INSERT INTO registeruser (email,password, username) values (:email,:password,:username)";
        $statement = $connect->prepare($insertAccount);

        try{
            //Eksekusi statement db
            $statement->execute([
                ':email' => $username,
                ':password' => md5($password),
                ':username' => $name
            ]);

            //Beri response
            $response['status']= true;
            $response['message']='Akun berhasil didaftar';
            $response['data'] = [
                'email' => $username,
                'username' => $name,
                
            ];
        } catch (Exception $e){
            die($e->getMessage());
        }

    }
    
    //Jadikan data JSON
    $json = json_encode($response, JSON_PRETTY_PRINT);

    //Print JSON
    echo $json;
}