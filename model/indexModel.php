<?php
require_once './model/baseModel.php';
/**
 * Created by PhpStorm.
 * User: Vyacheslav
 * Date: 30/01/2017
 * Time: 12:54
 */
class IndexModel extends BaseModel
{

    private $__userId;
    private $__login;
    private $__date;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->__userId;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->__login;
    }

    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->__date;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->__title;
    }


    public function __construct()
    {
        $this->__userId = 0;
        $this->__login = '';
        $this->__date = 0;
        $this->__title = 'Chat';

    }

    public function userAuth($userId, $token)
    {
        $userId = intval($userId);
        $token = trim(htmlspecialchars(stripslashes($token)));

        $query = 'SELECT * FROM users WHERE '.
            'users.id = "' . mysqli_real_escape_string(Core::getMysqli(), $userId) . '" and ' .
            'users.token = "' . mysqli_real_escape_string(Core::getMysqli(), $token) . '"';
        if ($result = Core::getMysqli()->query($query)) {
            if (mysqli_num_rows($result) > 0) {
                $resultInfo = mysqli_fetch_assoc($result);
                $this->__id = $resultInfo['id'];
                $this->__login = $resultInfo['login'];
                $this->__date = $resultInfo['date'];
            }
        }
    }
    public function getDataLast()
    {
        //var_dump(Core::getMysqli());

        if ($result = Core::getMysqli()->query('SELECT chat.id, chat.date, chat.text, users.login FROM chat, users WHERE users.id = chat.id_author LIMIT 10'))
        {
            $out = array();
            while($row = $result->fetch_assoc())
                array_push($out, $row);
            return $out;
        }
    }

    public function pasteMess($message)
    {
        if ($this->__userId == 0)
            return false;
        $message = trim(htmlspecialchars(stripslashes($message)));
        $query = 'INSERT INTO chat(id_author, text, date) VALUES('.$this->__userId.',"'. mysqli_real_escape_string(Core::getMysqli(), $message).'",'.time().')';
        return Core::getMysqli()->query($query);
    }
}