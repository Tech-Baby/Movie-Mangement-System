<?php

class Session{


public static function start(){
 if(empty($_SESSION)) session_start();




}

public static function set($session_name,$value){
    $_SESSION[$session_name] = $value;
}


public static function get($session_name){
    if(isset($_SESSION[$session_name])){
        return $_SESSION[$session_name];
    }else{
        return false;
    }
}

public static function destroy($session_name){
    if(isset($_SESSION[$session_name])) unset($_SESSION[$session_name]);

}

public static function exists($session_name){

    if(!isset($_SESSION[$session_name])) return false;
    return true;

}

}















?>