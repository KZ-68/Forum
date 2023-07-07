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

            $sql = "SELECT 
                        p.id_post,
                        p.topic_id,
                        p.user_id,
                        p.text,
                        p.creationdate
                    FROM ".$this->tableName." p
                    INNER JOIN topic t ON t.id_topic = p.topic_id
                    INNER JOIN user u ON u.id_user = p.user_id
                    WHERE t.id_topic = :id
                    ORDER BY creationdate ASC";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function findPostsByUserId($id){

            $sql = "SELECT
                        p.id_post,
                        p.user_id,
                        p.topic_id,
                        p.text,
                        p.creationdate,
                        u.username
                    FROM ".$this->tableName." p
                    INNER JOIN user u ON u.id_user = p.user_id
                    INNER JOIN topic t ON t.id_topic = p.topic_id
                    WHERE u.id_user = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function updatePost($text, $id){

            $sql = "UPDATE ".$this->tableName." SET
                    text = :text
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::update($sql, [':text' => $text, ':id' => $id]); 
        }

    }