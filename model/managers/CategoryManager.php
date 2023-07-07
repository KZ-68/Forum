<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\CategoryManager;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";


        public function __construct(){
            parent::connect();
        }

        public function updateCategory($categoryName, $id){

            $sql = "UPDATE ".$this->tableName." SET
                    categoryName = :categoryName
                    WHERE id_".$this->tableName." = :id
                    ";

            return DAO::update($sql, [':categoryName' => $categoryName, ':id' => $id]); 
        }
    }