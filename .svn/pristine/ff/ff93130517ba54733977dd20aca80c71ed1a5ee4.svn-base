<?php

class UsersController extends Controller {

    /**
     * If there isn't any user logged in renders the login view, else the user index is shown.
     */
    public function index() {
        if (!isset($_SESSION['user']['id'])) {
            $this->view->render('users/login');
        }
        else {
            $user = new UserModel($_SESSION['user']['id']);
            $this->view->set('user', $user);
            $this->view->render();
        }
    }

    /**
     * If the posted email is unique and it is an valid email. Returns "valid" true or false in JSON.
     */
    public function unique_email() {
        if (is('post')) {
            $email = $_POST['email'];
            $valid = true;
            if (is_email($email)) {
                if (!$this->is_unique($email)) {
                    $valid = false;
                }
            }
            else {
                $valid = false;
            }

            echo json_encode(['valid' => $valid]);
        }
    }

    /**
     * If the email is valid. Returns "valid" true or false in JSON.
     */
    public function validate_email() {
        if (is('post')) {
            $email = $_POST['email'];
            echo json_encode(['valid' => is_email($email)]);
        }
    }

    /**
     * users/login
     * Check if the user is already logged in. If true redirect the user to the index.
     * Then check if there is something posted to the server and search for the user with the given credentials.
     * If the user filled in the correct credentials log the user in, and insert a new login.
     */
    public function login() {
        if (isset($_SESSION['user']['id'])) {
            $this->redirect('/users/index');
        }
        else {
            if (is('post')) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user = new UserModel();
                $user->find(array(
                    'conditions' => array(
                        'email' => $email,
                        'password' => $password
                    )
                ));
                if ($user->id) {
                    $userLogin = new UserLoginModel();
                    $userLogin->ip = $_SERVER['REMOTE_ADDR'];
                    $userLogin->timestamp = date(TIMESTAMP_FORMAT);
                    $userLogin->create();
                    $userLogin->update();
                    $_SESSION['user']['id'] = $user->id;
                    $_SESSION['user']['role'] = $user->role;
                    $_SESSION['user']['email'] = $user->email;
                    echo json_encode(['success' => true]);
                }
                else {
                    echo json_encode(['success' => false]);
                }
            }
            else {
                $this->view->render();
            }
        }
    }

    /**
     * Unsets the user session and then redirects the user back to the login.
     */
    public function logout() {
        unset($_SESSION['user']);
        $this->redirect('/users/login');
    }

    public function register() {
        if (is('post')) {

            $user = new UserModel();

            $user->email = $_POST['email'];
            $user->firstName = $_POST['firstName'];
            $user->insertion = $_POST['insertion'];
            $user->lastName = $_POST['lastName'];
            $user->gender = $_POST['gender'];
            $user->city = $_POST['city'];
            $user->postalCode = $_POST['postalCode'];
            $user->address = $_POST['address'];
            $user->phone = $_POST['phone'];
            $user->newsletter = $_POST['newsletter'];

            $user->modified = date('Y-m-d H:i:s');

            $user->create();
            if ($user->update()) {
                return $this->view->element('users/register_success');
            }

            return $this->view->element('users/register_failed');
        }

        return $this->view->render();
    }

    /**
     * Checks if the given email is unique in the database.
     * @param string $email
     * @return bool
     */
    private function is_unique($email) {
        $user = new UserModel();
        $user->find(['conditions' => ['email' => $email]]);
        return (bool) !$user->id;
    }

}

