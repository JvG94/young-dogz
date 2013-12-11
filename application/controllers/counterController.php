<?php

class CounterController extends Controller {

    public function admin_index() {
        $order = new OrderModel(get_param(2));
        if (!$order->id) {
            throw new Exception('Not found');
        }
        
        $this->view->set([
            'order' => $order,
            'menus' => [
                [
                    'id' => 1,
                    'price' => 2,
                    'title' => 'Vis'
                ],
                [
                    'id' => 2,
                    'price' => 2.5,
                    'title' => 'Friet'
                ]
            ]
        ]);
        $this->view->render();
    }

    public function admin_add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $menuId = $_POST['menuId'];
        }

        $this->view->set('items', $_SESSION['order']);
        $this->view->element('counter/list');
    }

    public function admin_remove() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['order'][$_POST['id']])) {
                $_SESSION['order'][$_POST['id']]['amount']--;
                if ($_SESSION['order'][$_POST['id']]['amount'] < 1) {
                    unset($_SESSION['order'][$_POST['id']]);
                }
            }
        }

        $this->view->set('items', $_SESSION['order']);
        $this->view->element('counter/list');
    }

    public function admin_delete() {
        $_SESSION['order'] = array();
    }

}