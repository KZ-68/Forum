<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          
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
                        "topics" => $topicManager->findTopicsByCategoryId($id)
                    ]
                ];
            
        }
        
        public function detailTopic($id) {
            
            $topicManager = new TopicManager();
        
                return [
                    "view" => VIEW_DIR."forum/detailTopic.php",
                    "data" => [
                        "topics" => $topicManager->findOneById($id)
                    ]
                ];
            
        }
}
