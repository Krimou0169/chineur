<?php
class User
{
    //déclaration des variables qui alimenteront un user
    private $login;    
    private $email;
    private $password;
    private $is_valid;
    private $user_key;



    public function __construct($login, $email, $password, $isValid, $userKey) // des paramètres
    {
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
        $this->is_valid = $isValid;
        $this->user_key = $userKey;
    }

    //getters et setters
    public function getLogin()
    {
        return $this->login;
    }
    public function setLogin($login)
    {
        $this->login = $login;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getIsValid()
    {
        return $this->is_valid;
    }
    public function setIsValid($isValid)
    {
        $this->is_valid = $isValid;
    }
    public function getUserKey()
    {
        return $this->user_key;
    }
    public function setUserKey($userKey)
    {
        $this->user_key= $userKey;
    }
 
}

