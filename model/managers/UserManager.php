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
                        t.creationdate
                    FROM ".$this->tableName." u
                    INNER JOIN topic t ON t.user_id = u.id_user
                    WHERE t.id_topic = :id";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }

        public function updateAvatar($avatar, $id){

            $sql = "UPDATE ".$this->tableName." SET
                    avatar = :avatar
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::update($sql, [':avatar' => $avatar, ':id' => $id]); 
        }

        public function findHash() {
            $sql = "SELECT
                        u.password,
                        u.email
                    FROM ".$this->tableName." u 
                    WHERE u.password = ':password' AND u.email = ':email'";
            
            return $this->getOneOrNullResult(
                DAO::select($sql, [':password' => 'password', ':email' => 'email'], false), 
                $this->className
            );
        }
    }