<?php
require_once 'core/Model.php';

class User extends Model
{
    protected $id = null;
    protected $login = null;
    protected $birthday = null;
    protected $points = null;

    public function load($login)
    {
        $query = 'SELECT * FROM users WHERE login = ?';
        $vars = array($login);
        $queryResult = $this->database->executeQuery($query, 's', $vars);

        if (count($queryResult) !== 1) {
            return false;
        }

        $this->id = $queryResult[0]['id'];
        $this->login = $queryResult[0]['login'];
        $this->birthday = $queryResult[0]['birthday'];
        $this->points = $queryResult[0]['points'];

        return true;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPoints()
    {
        return $this->points;
    }

    public function incPoints()
    {
        if (is_null($this->id))
            return;

        $this->points += 1;

        $query = 'UPDATE users SET points = points + 1 WHERE id = ?';
        $vars = array($this->id);
        $this->database->executeQuery($query, 'i', $vars);
    }

}