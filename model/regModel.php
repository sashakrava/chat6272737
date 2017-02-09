<?php
require_once './model/baseModel.php';

/**
 * Created by PhpStorm.
 * User: Vyacheslav
 * Date: 30/01/2017
 * Time: 12:59
 */
class RegModel extends BaseModel
{

    public function __construct()
    {
        $this->__title = 'Регистрация';
        $this->__userId = 0;
        $this->__login = '';
        $this->__date = 0;
    }

    public function reg($login, $password) : bool
    {
        $login = trim(htmlspecialchars(stripslashes($login)));
        $password = trim(htmlspecialchars(stripslashes($password)));

        $query = 'SELECT count(id) FROM users WHERE login = "' . mysqli_real_escape_string(Core::getMysqli(), $login) . '"';
        $res = Core::getMysqli()->query($query);
        if (!$res)
            return false;
        $countRes = mysqli_fetch_assoc($res);
        if ($countRes['count(id)'] > 0)
            return false;
        $query = 'INSERT INTO users(login, password, date) VALUES '.
            '("' . mysqli_real_escape_string(Core::getMysqli(), $login) . '", ' .
            '"' . mysqli_real_escape_string(Core::getMysqli(), $password) . '",' . time() . ')';
        return Core::getMysqli()->query($query);
    }

}