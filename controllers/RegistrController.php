<?php
require_once 'core/Controller.php';
require_once 'core/View.php';
require_once 'models/UserRegistr.php';

class RegistrController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->viewName = 'registr';
        $this->renderVars['title'] = 'Регистрация';
        $this->renderVars['metaTitle'] = 'PlusOne - Регистрация';
    }

    protected function postAction()
    {
        $registrData = array(
            'login'         => $_POST['login']         ?? '',
            'password'      => $_POST['password']      ?? '',
            'password-copy' => $_POST['password-copy'] ?? '',
            'birthday'      => $_POST['birthday']      ?? '',
        );

        $userRegistr = new UserRegistr();
        $newUser = $userRegistr->register($registrData);

        if (!is_null($newUser)) {
            $_SESSION['user'] = $newUser->getLogin();
            header('Location: /index.php');
        }
        else {
            $this->renderVars['errorText'] = $userRegistr->getRegistrError();
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