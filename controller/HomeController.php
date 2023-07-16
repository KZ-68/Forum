<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use  Model\Managers\CategoryManager;
    
    class HomeController extends AbstractController implements ControllerInterface{

        public function index(){
            
            $topicManager = new TopicManager(); 
            $categoryManager = new CategoryManager();
            
                return [
                    "view" => VIEW_DIR."home.php",
                    "data" => [
                        "topics" => $topicManager->findTopicsWithLimit(),
                        "categories" => $categoryManager->findAll()
                    ]
                ];
            }
            
        public function users(){
            $this->restrictTo("ROLE_USER");

            $manager = new UserManager();
            $users = $manager->findAll(['registrationdate', 'DESC']);

            return [
                "view" => VIEW_DIR."security/users.php",
                "data" => [
                    "users" => $users
                ]
            ];
        }

        public function deleteUser($id) {

            $userManager = new UserManager();

            $user = $userManager->findOneById($id);

            if ($_POST['deleteUser']) {
                if ($user) {
                    $userManager->removeUser($id);
                    return [
                        header('Location: index.php?ctrl=home&action=users'),
                        Session::addFlash('success', 'User has been deleted successfully !')
                    ];
                } else {
                    return [
                        header('Location: index.php?ctrl=home&action=users'),
                        Session::addFlash('error', 'User not found')
                    ];
                }  
            } 

        }
 
        public function forumRules(){
            
            return [
                "view" => VIEW_DIR."rules.php"
            ];
        }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
    }
