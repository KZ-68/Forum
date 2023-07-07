<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        public function findTopicsByCategoryId($id){

            $sql = "SELECT 
                        t.id_topic,
                        t.title,
                        t.category_id,
                        t.creationdate
                    FROM ".$this->tableName." t
                    INNER JOIN category c ON c.id_category = t.category_id
                    WHERE c.id_category = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function findTopicsByUserId($id){

            $sql = "SELECT
                        t.id_topic,
                        t.title,
                        t.user_id,
                        t.creationdate,
                        u.username
                    FROM ".$this->tableName." t
                    INNER JOIN user u ON u.id_user = t.user_id
                    WHERE u.id_user = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function updateTopic($title, $id){

            $sql = "UPDATE ".$this->tableName." SET
                    title = :title
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::update($sql, [':title' => $title, ':id' => $id]); 
        }

        public function deleteTopic($id){
            $sql = "DELETE FROM post
                    WHERE ".$this->tableName."_id = :id;
                    
                    DELETE FROM ".$this->tableName."
                    WHERE id_".$this->tableName." = :id
                    ";

            return 
                DAO::delete($sql, ['id' => $id]);
                     
        }
    }