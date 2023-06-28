<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\UserManager;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function findUserByTopicId($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." u
                    INNER JOIN topic t ON t.user_id = u.id_user
                    WHERE t.id_topic = :id";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }

        public function findUserByPostId($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." u
                    INNER JOIN post p ON p.user_id = u.id_user
                    WHERE p.id_post = :id";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }
    }