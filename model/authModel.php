<?php
require_once './model/baseModel.php';
class AuthModel extends BaseModel
{
    private $__id;
    private $__token;

    public function __construct()
    {

    }

    public function getTitle()
    {
        return "Authorization";
    }

    public function getToken()
    {
        return $this->__token;
    }

    public function getUserId()
    {
        return $this->__id;
    }

    public function auth($login, $password)
    {
        $login = trim(htmlspecialchars(stripslashes($login)));
        $password = trim(htmlspecialchars(stripslashes($password)));

        $query = 'SELECT id, date FROM users WHERE '.
            'users.login = "' . mysqli_real_escape_string(Core::getMysqli(), $login) . '" and ' .
            'users.password = "' . mysqli_real_escape_string(Core::getMysqli(), $password) . '"';
//        var_dump($query);
        if ($result = Core::getMysqli()->query($query))
        {
            if (mysqli_num_rows($result) > 0)
            {
                $resultInfo = mysqli_fetch_assoc($result);
                self::$__id = $resultInfo['id'];
                $tokenTime = time();
                $this->__token = md5($login . $tokenTime);
                if ($this->__id > 0)
                {
                    $query = 'UPDATE users SET token="' . self::$__token . '", token_time="' . $tokenTime .'" WHERE id=' . self::$__id;
                    return Core::getMysqli()->query($query);
                }
            }
        }
        return false;
    }

}
