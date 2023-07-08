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
            $userManager = new UserManager();

            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $passwordKey = password_hash($password, PASSWORD_DEFAULT);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [
                "data" => [
                    $userManager->add(['username' => $username, 'password' => $passwordKey, 'email' => $email])
                ]
            ];

        }

        public function loginForm() {

            return [
                "view" => VIEW_DIR."security/login.html"
            ];

        }

        public function login() {
            
            $userManager = new UserManager();
            
            $passwordLogin = $_POST['password'];
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $hash = $userManager->checkPass($username);

            if (!password_verify($passwordLogin, $hash)) { 
                exit("Nom d'utilisateur ou mot de passe erroné"); 
            } 
            else {
                return [
                    "view" => VIEW_DIR."home.php"
                ];
            }
            
        }
    }