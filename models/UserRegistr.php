<?php
require_once 'User.php';

class UserRegistr extends Model
{
    private $registrError = null;

    public function register($registrData)
    {
        if (!$this->validationRegistrData($registrData)) {
            return null;
        }

        $query = 'INSERT INTO users(login, password, birthday) VALUES (?, ?, ?)';
        $vars = array(
            $registrData['login'],
            password_hash($registrData['password'], PASSWORD_DEFAULT),
            $registrData['birthday']
        );

        $this->database->executeQuery($query, 'sss', $vars);

        $newUser = new User();
        $newUser->load($vars[0]);
        return $newUser;
    }

    private function validationRegistrData($registrData)
    {
        if (!$this->validationLogin($registrData)) {
            return false;
        }
        if (!$this->validationPassword($registrData)) {
            return false;
        }
        if (!$this->validationBirthday($registrData)) {
            return false;
        }

        return true;
    }

    private function validationLogin($registrData)
    {
        if (empty($registrData['login'])) {
            $this->registrError = 'Введите логин!';
            return false;
        }

        if (!$this->isLoginUnique($registrData['login'])) {
            $this->registrError = 'Данный логин уже занят!';
            return false;
        }

        return true;
    }

    private function validationPassword($registrData)
    {
        if (empty($registrData['password'])) {
            $this->registrError = 'Введите пароль!';
            return false;
        }

        if (empty($registrData['password-copy'])) {
            $this->registrError = 'Подтвердите пароль!';
            return false;
        }

        if ($registrData['password'] !== $registrData['password-copy']) {
            $this->registrError = 'Пароли не совпадают!';
            return false;
        }

        return true;
    }

    private function validationBirthday($registrData)
    {
        if (empty($registrData['birthday'])) {
            $this->registrError = 'Введите дату рождения!';
            return false;
        }

        try {
            $birthdayDate = new DateTime($registrData['birthday']);
        }
        catch (Exception $e) {
            $this->registrError = 'Неверный формат даты!';
            return false;
        }

        $currentDate = new DateTime('now');
        if ($currentDate <= $birthdayDate) {
            $this->registrError = 'Вы ещё не родились!';
            return false;
        }

        $interval = $currentDate->diff($birthdayDate);
        $diffYear = (int)$interval->format('%y');
        if ($diffYear < 5) {
            $this->registrError = 'Вы молоды!';
            return false;
        }

        if ($diffYear > 150) {
            $this->registrError = 'Вы стары!';
            return false;
        }

        return true;
    }

    private function isLoginUnique($login) {
        $query = 'SELECT * FROM users WHERE login = ?';
        $vars = array($login);
        $queryResult = $this->database->executeQuery($query, 's', $vars);

        return (count($queryResult) === 0);
    }

    public function getRegistrError()
    {
        return $this->registrError;
    }
}