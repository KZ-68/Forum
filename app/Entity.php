<?php
    namespace App;

    abstract class Entity{

        protected function hydrate($data){
        // $data contient un tableau associatif qui est un enregistrement de la bdd (qui provient d'un fetch() ou fetchAll())
        
        // $field est le nom de la colonne dans la bdd et $value est la valeur associée (pour cet entregistrement/ligne)
            foreach($data as $field => $value){

                //field = marque_id
                //fieldarray = ['marque','id']
                /* explode() (comme split() dans d'autres languages) permet de transformer un string en tableau/array, en séparant les parties 
                du string en fonction d'un délimiteur*/ 
                $fieldArray = explode("_", $field);

                // le if des clés étrangères (foreign keys)
                // si l'élément d'index 1 (le deuxième élément) du tableau $fieldArray existe ET est == "id" (donc si on a le patern truc_id)
                if(isset($fieldArray[1]) && $fieldArray[1] == "id"){
                    $manName = ucfirst($fieldArray[0])."Manager";
                    $FQCName = "Model\Managers".DS.$manName;
                    
                    $man = new $FQCName();
                    $value = $man->findOneById($value);
                }
                //fabrication du nom du setter à appeler (ex: setMarque)
                $method = "set".ucfirst($fieldArray[0]);
               
                if(method_exists($this, $method)){
                    $this->$method($value);
                }

            }
        }

        public function getClass(){
            return get_class($this);
        }
    }