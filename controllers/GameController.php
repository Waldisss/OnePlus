<?php
require_once 'core/Controller.php';
require_once 'models/User.php';

class GameController extends Controller
{
    /**
     * @var User $user
     */

    private $user = null;

    public function __construct()
    {
        parent::__construct();

        $this->viewName = 'game';
        $this->renderVars['title'] = 'Плюс Один';
        $this->renderVars['metaTitle'] = 'PlusOne';
    }

    protected function postAction()
    {
        if (isset($_POST['addOne'])) {
            $this->user->incPoints();

            if (isset($_POST['isAjax']) && $_POST['isAjax'] === "true") {
                $this->isAjaxRequest = true;
                echo $this->user->getPoints();
                return;
            }

            header('Location: /index.php');
        }

        if (isset($_POST['exit'])) {
            $_SESSION['user'] = '';
            header('Location: /login.php');
        }
    }

    public function mainAction()
    {
        if (!$this->isAuthorized()) {
            header('Location: /login.php');
            return;
        }

        $this->user = new User();
        $this->user->load($_SESSION['user']);

        $this->renderVars['points'] = $this->user->getPoints();

        parent::mainAction();
    }
}