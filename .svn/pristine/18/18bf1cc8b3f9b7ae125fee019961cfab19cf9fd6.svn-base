<?php

class Controller extends Database {

    public $view;
    protected $_db;

    public function __construct() {
        parent::__construct();
        $this->view = new View();
        $this->view->set('title', ucwords(str_replace('controller','',strtolower(get_called_class()))));
    }

    public function redirect($url = "") {
        echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
    }

}