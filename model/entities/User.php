<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $email;
        private $username;
        private $role;
        private $password;
        private $registrationdate;
        private $avatar;


        public function __construct($data){         
            $this->hydrate($data);        
        }

        public function __toString()
        {
                return $this->username;
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

          /**
         * Get the value of username
         */ 
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
                $this->username = $username;

                return $this;
        }

            /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                $role = json_decode($role);
                if (empty($role)) {
                        return $this->role[] = $role;
                }
                return $this;
        }

        public function hasRole($role) {
                return in_array($role, ["ROLE_ADMIN","ROLE_USER"], true);
        }

           /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        public function getRegistrationdate(){
            $formattedDate = $this->registrationdate->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setRegistrationdate($date){
            $this->registrationdate = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of avatar
         */ 
        public function getAvatar()
        {
                return $this->avatar;
        }

        /**
         * Set the value of avatar
         *
         * @return  self
         */ 
        public function setAvatar($avatar)
        {
                $this->avatar = $avatar;

                return $this;
        }

    }