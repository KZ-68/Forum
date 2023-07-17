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
            return $this->categoriesList();
        }

        public function categoriesList() {

            $categoryManager = new CategoryManager();
            
                return [
                    "view" => VIEW_DIR."forum/categoriesList.php",
                    "data" => [
                        "categories" => $categoryManager->findAll(["categoryName", "ASC"])
                    ]
                ];

        }

        public function detailCategory($id) {
            
            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();
            
                return [
                    "view" => VIEW_DIR."forum/detailCategory.php",
                    "data" => [
                        "topicsCategory" => $topicManager->findTopicsByCategoryId($id),
                        "category" => $categoryManager->findOneById($id)
                    ]
                ];
            
        }

        public function createCategoryForm() {

            return [
                "view" => VIEW_DIR."forum/createCategory.php"
            ];

        }

        public function createCategory() {

            $categoryManager = new CategoryManager();

            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [
                "data" => [
                    $categoryManager->add(['categoryName' => $categoryName]),
                    "categories" => $categoryManager->findAll(["categoryName", "ASC"])
                ],
                "view" => VIEW_DIR."forum/categoriesList.php"
            ];
        }

        public function updateCategoryForm($id) {

            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/updateCategoryForm.php",
                "data" => [
                    "category" => $categoryManager->findOneById($id)
                ]
            ];

        }

        public function updateCategory($id) {

            $categoryManager = new CategoryManager();

            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [
                "data" => [
                    $categoryManager->updateCategory($categoryName, $id)
                ]
            ];

        }

        public function deleteCategory($id) {
            
            $categoryManager = new CategoryManager();
            $topicManager = new TopicManager();

            return [
                "data" => [
                    $topicManager->removeCategoryIdInTopics($id),
                    $categoryManager->deleteCategory($id),
                    "categories" => $categoryManager->findAll(["categoryName", "ASC"])
                ],
                "view" => VIEW_DIR."forum/categoriesList.php"
            ];
        }

        public function topicsList() {
            
            $topicManager = new TopicManager();
            
                return [
                    "view" => VIEW_DIR."forum/topicsList.php",
                    "data" => [
                        "topics" => $topicManager->findAll(["creationdate", "DESC"])
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
                        "postsUser" => $postManager->findPostsByTopicId($id),
                        "user" => $userManager->findUserByTopicId($id)
                    ]
                ];
            
        }

        public function createTopicForm($id) {

            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/createTopic.php",
                "data" => [
                    "category" => $categoryManager->findOneById($id)
                ]
            ];

        }

        public function createTopic() {
            
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            
            $userId = Session::getUser()->getId();

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $categoryId = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idTopic = $topicManager->add(['user_id' => $userId, 'category_id' => $categoryId, 'title' => $title]);

            return [
                "data" => [
                    $postManager->add(['user_id' => $userId, 'topic_id' => $idTopic, 'text' => $text])
                ],
            ];
        }

        public function updateTopicForm($id) {

            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/updateTopicForm.php",
                "data" => [
                    "topic" => $topicManager->findOneById($id)
                ]
            ];

        }

        public function updateTopic($id) {

            $topicManager = new TopicManager();
            $postManager = new PostManager();

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idTopic = $topicManager->updateTopic($title, $id);

            return [
                "data" => [
                    $postManager->updatePost($text, $idTopic)
                ]
            ];

        }

        public function deleteTopic($id) {
            
            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();

            $categoryId = $topicManager->findOneById($id);

            return [
                "data" => [
                    "topicsCategory" => $topicManager->findTopicsByCategoryId($id),
                    "category" => $categoryManager->findOneById($id),
                    $topicManager->deleteTopic($id)
                ],
                header("Location: index.php?ctrl=forum&action=detailCategory&id=".$categoryId->getCategory()->getId()."")
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

        
        public function createPost($id) {
            
            $postManager = new PostManager();
            $topicManager = new TopicManager();
            $userManager = new UserManager();

            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_SPECIAL_CHARS);
            $topicId = filter_input(INPUT_POST, 'topic_id', FILTER_SANITIZE_SPECIAL_CHARS);

            $userId = Session::getUser()->getId();

            return [
                "view" => VIEW_DIR."forum/detailTopic.php",
                "data" => [
                    $postManager->add(['user_id' => $userId, 'topic_id' => $topicId ,'text' => $text], $id),
                    "topics" => $topicManager->findOneById($id),
                    "postsUser" => $postManager->findPostsByTopicId($id),
                    "user" => $userManager->findUserByTopicId($id)
                ]
            ];
        }

        public function updatePostForm($id) {

            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR."forum/updatePostForm.php",
                "data" => [
                    "post" => $postManager->findOneById($id)
                ]
            ];

        }

        public function updatePost($id) {

            $postManager = new PostManager();

            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_SPECIAL_CHARS);

            return [
                "data" => [
                    $postManager->updatePost($text, $id)
                ]
            ];

        }

        public function deletePost($id) {
            
            $postManager = new PostManager();

            return [
                "data" => [
                    $postManager->delete($id)
                ]
            ];
        }

}
