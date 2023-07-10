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
            
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $user = $userManager->findUserByUsername($username);

            if ($user) {
                $userManager->checkPass($username);
                password_verify($password, $user->getPassword()); 
                // On récupère le mot de passe
            } else {
                exit("Username not found !");
            }

            if ($userManager->checkPass($username) && password_verify($password, $user->getPassword())) {
                $session = new Session;
                return [
                    $session->setUser($user),
                    "view" => VIEW_DIR."forum/categoriesList.php"
                ];
            } else {
                exit("Incorrect Password !");
            }
            
        }
    }