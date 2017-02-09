<?php

interface Model
{
    public function getTitle();
}

class BaseModel
{
    protected $__title;
    protected $__userId;
    protected $__login;
    protected $__date;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->__title;
    }

    /**
     * @return int
     */
    public function getUserId(): int
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



    public function __construct()
    {
        $this->__title = 'Title';
        $this->__userId = 0;
        $this->__login = '';
        $this->__date = 0;
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
                $this->__userId = $resultInfo['id'];
                $this->__login = $resultInfo['login'];
                $this->__date = $resultInfo['date'];
            }
        }
    }

}