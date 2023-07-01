<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
            return $this->listCategories();
        }

        public function listCategories() {

            $categoryManager = new CategoryManager();
            
                return [
                    "view" => VIEW_DIR."forum/listCategories.php",
                    "data" => [
                        "categories" => $categoryManager->findAll(["categoryName", "ASC"])
                    ]
                ];

        }

        public function listTopics() {
            
            $topicManager = new TopicManager();
            
                return [
                    "view" => VIEW_DIR."forum/listTopics.php",
                    "data" => [
                        "topics" => $topicManager->findAll(["creationdate", "DESC"])
                    ]
                ];
            
        }

        public function detailCategory($id) {
            
            $topicManager = new TopicManager();
            
                return [
                    "view" => VIEW_DIR."forum/detailCategory.php",
                    "data" => [
                        "topicsCategory" => $topicManager->findTopicsByCategoryId($id),
                    ]
                ];
            
        }
        
        public function detailTopic($id) {
            
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $userManager = new UserManager();
        
                return [
                    "view" => VIEW_DIR."forum/detailTopic.php",
                    "data" => [
                        "topics" => $topicManager->findOneById($id),
                        "posts" => $postManager->findPostsByTopicId($id),
                        "user" => $userManager->findUserByTopicId($id),
                    ]
                ];
            
        }

        public function detailUser($id) {
            
            $userManager = new UserManager();
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            
                return [
                    "view" => VIEW_DIR."forum/detailUser.php",
                    "data" => [
                        "users" => $userManager->findOneById($id),
                        "topicsUser" => $topicManager->findTopicsByUserId($id),
                        "postsUser" => $postManager->findPostsByUserId($id)
                    ]
                ];
            
        }

        public function createTopicForm() {

            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/createTopic.html"
            ];

        }

        public function createTopic() {

            $topicManager = new TopicManager();

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $textTopic = filter_input(INPUT_POST, 'textTopic', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [
                "data" => [
                    $topicManager->add(['title' => $username, 'textTopic' => $textTopic])
                ]
            ]
        }
}
