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

        public function findTopicsId($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." t
                    INNER JOIN category c ON c.id_category = t.category_id
                    WHERE t.id_topic = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function findTopicsByCategoryId($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." t
                    INNER JOIN category c ON c.id_category = t.category_id
                    WHERE c.id_category = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function findTopicsByUserId($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." t
                    INNER JOIN user u ON u.id_user = t.user_id
                    WHERE u.id_user = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }
    }