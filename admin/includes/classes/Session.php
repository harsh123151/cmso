<?php
namespace MyApp;
class Session{
    public static function start_session(){
        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }
        
    }

    public static function set_session($key,$value){
        self::start_session();
        $_SESSION[$key] = $value;
    }

    public static function get_session($key){
        self::start_session();
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        return false;
    }

    public static function end_session(){
        session_unset();
        session_destroy();
        
    }

    public static function get_session_id(){
        self::start_session();
        return session_id();
    }
}
?>