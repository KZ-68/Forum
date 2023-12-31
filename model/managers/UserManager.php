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

        public function checkPass($username) {
            $sql = "SELECT u.password
                    FROM ".$this->tableName." u 
                    WHERE u.username = :username";
            
            return $this->getOneOrNullResult(
                DAO::select($sql, ['username' => $username], false), 
                $this->className
            );
        }

        public function findUserByEmail($email) {
            $sql = "SELECT 
                        u.id_user,
                        u.email,
                        u.username,
                        u.role,
                        u.password,
                        u.registrationdate,
                        u.avatar
                    FROM ".$this->tableName." u
                    WHERE u.email = :email";
                    
            return $this->getOneOrNullResult(
            DAO::select($sql, ['email' => $email], false), 
            $this->className
            );
        }

        public function findUserByUsername($username) {
            $sql = "SELECT 
                        u.id_user,
                        u.email,
                        u.username,
                        u.role,
                        u.password,
                        u.registrationdate,
                        u.avatar
                    FROM ".$this->tableName." u
                    WHERE u.username = :username";
                    
            return $this->getOneOrNullResult(
            DAO::select($sql, ['username' => $username], false), 
            $this->className
            );
        }

        public function removeUser($id) {

            $sql = "UPDATE ".$this->tableName." SET
                    email = NULL,
                    username = 'Deleted User',
                    role = NULL,
                    password = NULL,
                    registrationDate = NULL,
                    avatar = 'sbcf-default-avatar.png'
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::update($sql, [':id' => $id]); 
        }

        public function updatePassword($password, $id) {

            $sql = "UPDATE ".$this->tableName." SET
                    password = :password
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::update($sql, [':password' => $password, ':id' => $id]); 
        }

        public function updateUsername($username, $id) {

            $sql = "UPDATE ".$this->tableName." SET
                    username = :username
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::update($sql, [':username' => $username, ':id' => $id]); 
        }

        public function updateEmail($email, $id) {

            $sql = "UPDATE ".$this->tableName." SET
                    email = :email
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::update($sql, [':email' => $email, ':id' => $id]); 
        }

    }