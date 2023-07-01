<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    
    class SecurityController extends AbstractController implements ControllerInterface {

        public function index(){

        }

        public function registerForm() {

            return [
                "view" => VIEW_DIR."security/register.html"
            ];

        }

        public function register() {
            $password = $_POST['password'];

            $userManager = new UserManager();

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $passwordKey = password_hash($password, PASSWORD_DEFAULT);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [
                "data" => [
                    $userManager->add(['username' => $username, 'password' => $passwordKey, 'email' => $email])
                ]
            ];

        }
    }