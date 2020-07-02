<?php
require_once 'core/View.php';

class Controller
{
    protected $view;
    protected $renderVars;
    protected $viewName;
    protected $layoutName;

    public function __construct()
    {
        $this->view = new View();
        $this->renderVars = array();
        $this->layoutName = 'layout';

        session_start();
    }

    protected function renderPage()
    {
        $this->renderVars['content'] = $this->view->render($this->viewName, $this->renderVars);
        return $this->view->render($this->layoutName, $this->renderVars);
    }

    protected function postAction()
    {

    }

    protected function getAction()
    {

    }

    protected function isAuthorized()
    {
        return !empty($_SESSION['user']);
    }

    public function mainAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->postAction();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->getAction();
        }

        echo $this->renderPage();
    }
}