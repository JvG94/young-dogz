<?php

class PagesController extends Controller {

    public function index() {
        $this->view->set('title', 'test');
        $this->view->render();
    }

    public function contact() {
        if (is('post')) {
            $email = $_POST['email'];
            $text = $_POST['text'];
            if (true) {
                $this->view->render('pages/contact_success');
            }
            else {
                $this->view->render('pages/contact_failed');
            }
        }
        else {
            return $this->view->render();
        }
    }

    public function contact_success() {
        return $this->view->render();
    }

    public function admin_index() {
        $this->view->layout = 'admin';
        $this->view->render();
    }

}