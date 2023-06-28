<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\PostManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }

        public function findPostsByTopicId($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." p
                    INNER JOIN topic t ON t.id_topic = p.topic_id
                    WHERE t.id_topic = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }
    }