<?php
include_once 'Model.php';

class Superheroes extends Model{
    
   protected $taula="heroes"; 

   // Afegir a la BD un nou superheroi
    public function add($heroname,$realname,$gender,$race) {

       	$sql ="insert into heroes(heroname,realname,gender,race) values 
      			 (:heroname,:realname,:gender,:race)";
      	$ordre = $this->bd->prepare($sql);	 
      	$ordre->bindValue(':heroname',$heroname);
      	$ordre->bindValue(':realname',$realname);
      	$ordre->bindValue(':gender',$gender);
      	$ordre->bindValue(':race',$race);
      
      	$res = $ordre->execute(); 
        return $res;
    }

    // Actualitzar les dades d'un superheroi
    public function update($codi,$heroname,$realname,$gender,$race) {
       	$sql ="update heroes set heroname=:heroname,realname=:realname, gender=:gender, race=:race where id=:codi";
      	$ordre = $this->bd->prepare($sql);	 
        $ordre->bindValue(':codi',$codi);
      	$ordre->bindValue(':heroname',$heroname);
        $ordre->bindValue(':realname',$realname);
        $ordre->bindValue(':gender',$gender);
        $ordre->bindValue(':race',$race);
      	
        $res = $ordre->execute(); 
        return $res;

    }
      
        

}

?>
