<?php
require_once './model/baseModel.php';
class AuthModel extends BaseModel
{
    protected $__token;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->__token;
    }

    public function __construct()
    {
        $this->__title = 'Auth';
        $this->__userId = 0;
        $this->__login = '';
        $this->__date = 0;
        $this->__token = '';
    }

    public function auth($login, $password)
    {
        $login = trim(htmlspecialchars(stripslashes($login)));
        $password = trim(htmlspecialchars(stripslashes($password)));

        $query = 'SELECT * FROM users WHERE '.
            'login = "' . mysqli_real_escape_string(Core::getMysqli(), $login) . '" and ' .
            'password = "' . mysqli_real_escape_string(Core::getMysqli(), $password) . '"';

        //var_dump($query);
        if ($result = Core::getMysqli()->query($query))
        {
            if (mysqli_num_rows($result) > 0)
            {
                $resultInfo = mysqli_fetch_assoc($result);
                $this->__userId = $resultInfo['id'];
                $tokenTime = time();
                $this->__token = md5($login . $tokenTime);
                if ($this->__userId > 0)
                {
                    $query = 'UPDATE users SET token="' . $this->__token . '", token_time="' . $tokenTime .'" WHERE id=' . $this->__userId;
                    return Core::getMysqli()->query($query);
                }
            }
        }
        return false;
    }

}
