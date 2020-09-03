<?php

class session
{
    public static function SetUid($uid)
    {
        session_start();
        $_SESSION["uid"] = $uid;
    }


    public static function SetUidEmpresa($idEmpresa)
    {
        session_start();
        $_SESSION["empresa"] = $idEmpresa;
    }


    public static function GetUidEmpresa()
    {
        if (isset($_SESSION["empresa"])) {
            return $_SESSION["empresa"];
        }else{
            return false;
        }
        
    }

    public static function GetUid()
    {
        if (isset($_SESSION["uid"])) {
            return $_SESSION["uid"];
        }else{
            return false;
        }
        
    }
}
