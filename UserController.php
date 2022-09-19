<?php

include "Crud.php";
include "Session.php";


class UserController{
   
    private $crud;
    public function __construct(){
        $this->crud = new Crud();
    }

    public function login($username,$password){
        $sql = "SELECT * FROM users where username = '".$username."' and password = '".md5($password)."'";
        $user = $this->crud->read($sql);
        if(count($user)){

            Session::start();
            Session::set('active_user',$user);

            header('Location: admin/list-movies.php');

        }else{
            return false;
        }
    }






}

























?>