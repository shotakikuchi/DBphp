<?php
    class BaseController{
     private $toChat;
     private $toLogin;
     private $toRegister;

     public function toRegister(){
         header('Location: ./register.php');
     }
     public function toLogin(){
         header('Location: ./login.php');
     }

     public function toChat(){
         header('Location: ./chat.php');
     }

     public function redirect(){
         header('Location:'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
     }
    }
?>