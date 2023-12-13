<?Php
use MyApp\Session;
use MyApp\Helper\Helper;
class Validation{
    public static function isLoggedIn(){
        if(Session::get_session('user_id')){
            return true;
        }
       return false;
    }
    public static function isAdmin(){
        if(self::isLoggedIn()){
            if(Session::get_session('user_role')==='admin'){
                return true;
            }
        }
        return false;
    }
    public static function getUserId(){
        if(self::isLoggedIn()){
            return Session::get_session('user_id');
        }
        return false;
    }
    
    public static function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
        if(self::isLoggedIn()){
            Helper::redirect($redirectLocation);
        }
    }

    public static function ifItIsMethod($method=null){
        if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
            return true;
        }
        return false;
    }
}
?>