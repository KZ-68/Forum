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

        public function changeAvatar($id) {
            
            $userManager = new UserManager();
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            $avatar = filter_input(INPUT_POST, 'avatar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [
                "data" => [
                    $userManager->updateAvatar($avatar, $id),
                    "users" => $userManager->findOneById($id),
                    "topicsUser" => $topicManager->findTopicsByUserId($id),
                    "postsUser" => $postManager->findPostsByUserId($id)
                ],
                "view" => VIEW_DIR."forum/detailUser.php"
            ];
        }

        public function createCategoryForm() {

            return [
                "view" => VIEW_DIR."forum/createCategory.html"
            ];

        }

        public function createCategory() {

            $categoryManager = new CategoryManager();

            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [
                "data" => [
                    $categoryManager->add(['categoryName' => $categoryName])
                ]
            ];
        }

        public function createTopicForm() {

            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/createTopic.php",
                "data" => [
                    "category" => $categoryManager->findAll()
                ]
            ];

        }

        public function createTopic($id) {

            $topicManager = new TopicManager();

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $textTopic = filter_input(INPUT_POST, 'textTopic', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [
                "data" => [
                    $topicManager->add(['category_id' => $categoryId, 'title' => $title, 'textTopic' => $textTopic], $id)
                ]
            ];
        }

}
