<?php
if($_POST && isset($_POST["username"])&& isset($_POST["password"]))
{
    session_start();
    $_POST['username']="santa";
    $_POST['password']="rudolf";

    if($_POST["username"]=="santa" && $_POST["password"]=="rudolf")
    {
        $_SESSION['auth']=true;
        header('Location: pannello.php');
    }
}