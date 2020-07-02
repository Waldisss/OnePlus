<?php
require_once 'models/User.php';

class UserAuth extends Model
{
    public function authorize($login, $password)
    {
        $query = 'SELECT * FROM users WHERE login = ?';
        $vars = array($login);
        $queryResult = $this->database->executeQuery($query, 's', $vars);

        if (count($queryResult) !== 1 || !password_verify($password, $queryResult[0]['password'])) {
            return false;
        }

        return true;
    }
}