<?php 
session_start();

    //print_r($_POST);
    if (isset($_POST['name'])) {
        $nameuser = $_POST['name'];
        $passwords = $_POST['password'];
        if ( $nameuser === 'admin' and $passwords === 'ssit@2020'){
           $_SESSION['username'] = $nameuser;
           //echo ($_SESSION['username']);
            header('location: index.php');
            //unset($_SESSION['username']);
        }
        
        else {
            header('location: authentication/flows/basic/sign-in.php');
            $_SESSION['error'] = "Please Check Username or Password Incprrect";
        }
    }

?>