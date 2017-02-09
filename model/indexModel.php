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
    public function __construct()
    {
        $this->__title = 'Chat';
        $this->__userId = 0;
        $this->__login = '';
        $this->__date = 0;

    }


    public function getAllMess()
    {
        if ($result = Core::getMysqli()->query('SELECT chat.id, chat.date, chat.text, users.login FROM chat, users WHERE users.id = chat.id_author LIMIT 50'))
        {
            $out = array();
            while($row = $result->fetch_assoc())
                array_push($out, $row);
            return $out;
        }
    }

    public function getLastMess($date)
    {
        $query = 'SELECT chat.id, chat.date, chat.text, users.login FROM chat, users WHERE users.id = chat.id_author and chat.date > ' . intval($date);

//        var_dump($query);
        if ($result = Core::getMysqli()->query($query))
        {
            if (mysqli_num_rows($result) > 0)
            {
                $out = array();
                while($row = $result->fetch_assoc())
                    array_push($out, $row);
                return $out;
            }
        }

        return false;
    }

    public function pasteMess($message) : bool
    {
        if ($this->__userId == 0)
            return false;
        $message = trim(htmlspecialchars(stripslashes($message)));
        $query = 'INSERT INTO chat(id_author, text, date) VALUES('.
            $this->__userId.',"'. mysqli_real_escape_string(Core::getMysqli(), $message).'",'.time().')';
        return Core::getMysqli()->query($query);
    }
}