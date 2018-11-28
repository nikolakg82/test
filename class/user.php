<?php
class User
{
    protected $_userData;

    //Messages from validation forms
    protected $_validateMessages;

    //Database object PDO
    protected $_db;

    //Setters
    public function setUserData($arrData)
    {
        if(!is_array($arrData))
            throw new Exception('No valid user data');

        $this->_userData = $arrData;

        return $this;
    }

    //Gets
    public function getUserData()
    {
        return $this->_userData;
    }

    public function getValidateMessages()
    {
        return $this->_validateMessages;
    }

    public function getDb()
    {
        return $this->_db;
    }

    /**
     * Method register user, if user not exist return false
     * @param $arrData
     * @return bool
     */
    public function registerUser($arrData)
    {
        $boolReturn = false;

        $arrInsertData[':email'] = $arrData['email'];
        $arrInsertData[':name'] = $arrData['name'];
        $arrInsertData[':password'] = md5($arrData['password']);

        $sth = $this->getDb()->prepare('INSERT INTO users SET email = :email, name = :name, password = :password');
        $sth->execute($arrInsertData);

        if($sth->rowCount() > 0)
            $boolReturn = true;

        return $boolReturn;
    }

    /**
     * Check if user exist in database
     *
     * @param $strEmail
     * @return bool
     */
    public function isUserExist($strEmail)
    {
        $boolReturn = false;

        $arrSqlData[':email'] = $strEmail;

        $sth = $this->getDb()->prepare('SELECT id FROM users WHERE email = :email');
        $sth->execute($arrSqlData);

        if($sth->rowCount() > 0)
            $boolReturn = true;

        return $boolReturn;
    }

    /**
     * Validation forms, if validation not ok return false
     *
     * @param $arrData
     * @return bool
     */
    public function validateData($arrData)
    {
        $boolReturn = true;

        foreach ($arrData as $key => $val)
        {
            if(isset($val) && !empty($val))
            {
                if($key == 'email')
                {
                    if (!filter_var($val, FILTER_VALIDATE_EMAIL))
                    {
                        $this->_validateMessages[$key] = 'Invalid email address';
                        $boolReturn = false;
                    }
                }
                elseif ($key == 'repeat_password')
                {
                    if($val != $arrData['password'])
                    {
                        $this->_validateMessages[$key] = 'Wrong repeat password';
                        $boolReturn = false;
                    }
                }
            }
            else
            {
                $this->_validateMessages[$key] = 'Field is empty';
                $boolReturn = false;
            }
        }

        return $boolReturn;
    }

    /**
     * Login user, if user exist start session and return true else return false
     * @param $arrData
     * @return bool
     */
    public function loginUser($arrData)
    {
        $boolReturn = false;

        $arrSqlData[':email'] = $arrData['email'];
        $arrSqlData[':password'] = md5($arrData['password']);

        $sth = $this->getDb()->prepare('SELECT id, email, name FROM users WHERE email = :email AND password = :password LIMIT 1');
        $sth->execute($arrSqlData);

        if($sth->rowCount() > 0)
        {
            $this->setUserData($sth->fetch(PDO::FETCH_ASSOC));
            $boolReturn = true;

            session_name("APPFrontend");
            session_start();

            $_SESSION['APPFrontendUser'] = serialize($this->getUserData());
        }

        return $boolReturn;
    }

    /**
     * if session exist get user data from session
     *
     * @return $this
     */
    public function getUserFromSession()
    {
        //Start session
        if(isset($_COOKIE['APPFrontend']))
        {
            session_name("APPFrontend");
            session_start();
        }

        if(isset($_SESSION['APPFrontendUser']))
            $this->setUserData(unserialize($_SESSION['APPFrontendUser']));

        return $this;
    }

    /**
     * Logout user, unset cookie and session, and redirect to home page
     */
    public function logoutUser()
    {
        unset($_SESSION['APPFrontendUser']);

        setcookie('APPFrontend', "", time() - 50, "/");
        unset($_COOKIE['APPFrontend']);

        header('Location: /');
    }

    /**
     *
     * @param $strSearchWord
     * @return array
     */
    public function searchUser($strSearchWord)
    {
        $arrData = array();
        $arrSqlData[':search'] = "%$strSearchWord%";
        $sth = $this->getDb()->prepare('SELECT id, email, name FROM users WHERE email LIKE :search OR name LIKE :search');
        $sth->execute($arrSqlData);

        if($sth->rowCount() > 0)
            $arrData = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $arrData;
    }

    /**
     * Set database connection
     *
     * User constructor.
     */
    public function __construct()
    {
        $arrDbData = require(APP_CONFIG . 'db.config.php');

        $this->_db = new PDO('mysql:host=' . $arrDbData['hostname'] . ';dbname=' . $arrDbData['name'], $arrDbData['username'], $arrDbData['password']);
    }
}