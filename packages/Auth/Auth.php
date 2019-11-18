<?php


namespace Akuren\Auth;


use Akuren\Crypting\Crypt;
use Akuren\Session\Session;
use App\Models\User;

class Auth implements AuthInterface
{



    /**
     * @param array $username
     * @param array $password
     * @return mixed
     */
    public static function login (array $username, array $password)
    {
        $tableaux = [];
        $attribute = [];
        $attributes = [];
        $tableau = [];
        foreach ( $username as $k => $v){
            $tableaux[] = "$k";
            $attribute[] = $v;
        }

        foreach ( $password as $k => $v){
            $tableau[] = "$k";
            $attributes[] = $v;
        }

        $name = implode(' ' , $tableaux);
        $nameValue  = implode(' ' , $attribute);
        $passValue = implode(',', $attributes);

        $user = User::where([$name  =>  $nameValue])->first();

        if (Crypt::make($passValue) ===  $user->password){
            Session::logged($user->id);
            return true;
        }
        else{
            return false;
        }

    }

    /**
     * @return mixed
     */
    public static function user ()
    {
        session_start();
        if (isset($_SESSION['auth'])){
            $id = $_SESSION['auth'];
            if (isset($id)){
                $user = User::where(['id'  => $id])->first();
                return $user;
            }else{
                return  false;
            }
        }



    }

}