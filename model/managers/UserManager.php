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

            $sql = "SELECT 
                        u.id_user,
                        u.username,
                        t.title,
                        t.user_id,
                        t.creationdate,
                        t.textTopic
                    FROM ".$this->tableName." u
                    INNER JOIN topic t ON t.user_id = u.id_user
                    WHERE t.id_topic = :id";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }
    }