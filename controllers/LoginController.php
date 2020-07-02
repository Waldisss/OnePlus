<?php
require_once 'core/Controller.php';
require_once 'core/View.php';
require_once 'models/UserAuth.php';

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->viewName = 'login';
        $this->renderVars['title'] = 'Авторизация';
        $this->renderVars['metaTitle'] = 'PlusOne - Авторизация';
    }

    protected function postAction()
    {
        $login = $_POST['login'] ?? null;
        $password = $_POST['password'] ?? null;

        $userAuth = new UserAuth();
        $authIsSuccessful = $userAuth->authorize($login, $password);

        if ($authIsSuccessful) {
            $_SESSION['user'] = $login;
            header('Location: /index.php');
        }
        else {
            $this->renderVars['errorText'] = 'Неправильный логин или пароль!';
        }
    }

    public function mainAction()
    {
        if ($this->isAuthorized()) {
            header('Location: /index.php');
            return;
        }

        parent::mainAction();
    }
}