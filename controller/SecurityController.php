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
                "view" => VIEW_DIR."security/register.php"
            ];

        }

        public function register() {
            $userManager = new UserManager();
            $session = new Session();

            // Je filtre les saisies du formulaire
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirmPass = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Je cherche dans la base de données les utilisateurs existants par leur email et leur pseudonyme
            $emailExist = $userManager->findUserByEmail($email); 
            $usernameExist = $userManager->findUserByUsername($username);

            // Si les champs sont valides :
            if ($_POST["register"]) {
                if ($username && $email && $password && $confirmPass) {
                    // Je vérifie que l'email et le pseudonyme n'est pas déjà présent en bdd
                    if ($emailExist) {
                        // Dans le cas contraire, j'affiche un message d'erreur générique.
                        return [
                            header("Location: index.php?ctrl=security&action=registerForm"),
                            $session->addFlash('error',"Email adress or Username already exist")
                        ];
                    } else if ($usernameExist) {
                        return [
                            header("Location: index.php?ctrl=security&action=registerForm"),
                            $session->addFlash('error',"Email adress or Username already exist")
                        ];
                    } else {
                        $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
                        /* Je vérifie que le mot de passe est identique au second, qu'il contient au moins une Majuscule, minuscule, un chiffre, 
                        un caractère spécial et qu'il est minimum 8 caractères (Regex) */
                        if ($password == $confirmPass && preg_match($password_regex, $password)) {
                            // Et si tout est bon, j'insère en base de donnée en utilisant password_hash sur le mot de passe.
                            $userManager->add(['username' => $username, 'password' => password_hash($password, PASSWORD_DEFAULT), 'email' => $email, 'role' => json_encode("ROLE_USER")]);
                            return [
                                header("Location: index.php?ctrl=security&action=loginForm")
                            ];
                        } else {
                            return [
                                header("Location: index.php?ctrl=security&action=registerForm"),
                                $session->addFlash('error', "The password need a minimum of one uppercase, lowercase, digit, special character and a length of 8 characters")
                            ];
                        }
                        
                    }
                } 
            }
            
        }

        public function loginForm() {

            return [
                "view" => VIEW_DIR."security/login.php"
            ];

        }

        public function login() {
            
            $userManager = new UserManager();
            $session = new Session();
            
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $user = $userManager->findUserByUsername($username);

            if ($username && $password) {
                if ($user) {
                    $hash = $user->getPassword(); 
                    if (password_verify($password, $hash)) {
                        
                        return [
                            $user->setRole($user->getRole()),
                            $session->setUser($user),
                            header("Location: index.php?ctrl=home&action=home")
                        ];
                            
                    } else {
                        return [
                            header("Location: index.php?ctrl=security&action=loginForm"),
                            $session->addFlash('error',"Incorrect or inexistant password")
                        ];
                    }

                } else {
                        return [
                            header("Location: index.php?ctrl=security&action=loginForm"),
                            $session->addFlash('error',"Username or password not found")
                        ];
                }
            }
                        
        }

        public function logout() {
            $session = new Session();
            if ($session->getUser() || $session->isAdmin()) {
                unset($_SESSION['user']);
                return [
                    header("Location: index.php?ctrl=security&action=loginForm")
                ];
            }
        }

        public function viewProfile($id) {
            
            $userManager = new UserManager();
            
                return [
                    "view" => VIEW_DIR."security/viewProfile.php",
                    "data" => [
                        "user" => $userManager->findOneById($id),
                    ]
                ];
        }


    }