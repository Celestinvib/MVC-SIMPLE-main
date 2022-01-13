<?php
include_once 'helpers/request.php';


class ControlSuperheroes {

    private $supers;
    
    function __construct() {
        // Per gestinar els superherois s'ha de tenir el superpoder de ser
        // un usuari registrat!
        if (!isset($_SESSION['username'])) {
            header('Location: index.php?control=ControlLogin');
            exit;
        }         
              
        // Creem el model amb el que treballarem en aquest controlador
        include_once 'models/Superheroes.php';
        $this->supers = new Superheroes();

        
    }

    // mètode que es crida per defecte si no especifiquem cap mètode en el paràmetre 
    // operacio
    
    
  /*  public function index() {
        // Recuperem la llista de tots els superherois
        $res = $this->supers->getAll();
        include_once 'vistes/templates/header.php';       
        include_once 'vistes/superheroes/llistat.php';
        include_once 'vistes/templates/footer.php';
    } */


    public function index() {
        // No mostrarem tots els superherois de cop
        // els paginarem
        
        // El número de pàgina ens vindrà per paràmetre GET
        // En cas que no hi sigui mostrarem la primera pàgina
        if(isset($_GET['page'])) $numPagina=$_GET['page'];
        else $numPagina=1; 
        // Cada pàgina mostrarà 5 registres
        $numRegsPag=5;
        // Obtenim el número màxim de pàgines
        $total_pags = $this->supers->numPages($numRegsPag);
        // Si el número de pàgina és incorrecta mostrem la primera
        if($numPagina<=0 || $numPagina>$total_pags) $numPagina=1; 

        // Obtenim els superpoders de la pàgina indicada
        $res = $this->supers->getPage($numPagina,$numRegsPag);  
        include_once 'vistes/templates/header.php';       
        include_once 'vistes/superheroes/llistat.php';
        include_once 'vistes/templates/footer.php';
    }

    
    
    // Per afegir un superheroi 2 passos: 
    // - Mostrar el formulari d'alta
    // - Desar les dades del formulari en la BD


    // Mètode per mostrar el formulari per donar d'alta un nou superheroi
    public function showformnew() {

        include_once 'vistes/templates/header.php';
        
        include_once 'vistes/superheroes/formnew.php';
        include_once 'vistes/templates/footer.php';
    }

    // mètode per controlar l'emmagatzemar un superheroi a la BD
    public function store() {
        
        
        // Recuperem els camps del formulari
        $heroname = obtenir_camp('heroname');     
        $realname = obtenir_camp('realname');
        $gender = obtenir_camp('gender');
        $race = obtenir_camp('race');     

        
        if($heroname=="" || $realname=="" 
            || $gender=="" || $race=="") {

            $_SESSION['heroname'] = $heroname;
            $_SESSION['realname'] = $realname;
            $_SESSION['gender'] = $gender;
            $_SESSION['race'] = $race;
            $_SESSION['missatge'] = "Camps obligatoris!!";
                            
            header('Location: index.php?control=ControlSuperheroes&operacio=showformnew');
            exit;

        }
                 
        // Al model li diem que afegeix un nou superheroi        
        $res = $this->supers->add($heroname, $realname, $gender, $race);
        $res = true;
        if ($res) {
            $_SESSION['missatge'] = "alta correcta. Opció deshabilitada";
        } else {
            $_SESSION['missatge'] = "Alta incorrecta";
        }        
       
        header("Location: index.php?control=ControlSuperheroes");
    }
    
    // Per actualitzar un superheroi 2 passos: 
    // - Mostrar el formulari d'actualització amb les dades actuals del superheroi
    // - Desar les dades del formulari en la BD


    // Mètode per mostrar el formulari d'actualització d'un superheroi
    public function showformupdate() {
        // Via GET ens passaran el codi de l'heroi que volem modificar
        // Comprovem l'existència del paràmetre
               if(!isset($_GET['codi'])) {
                $_SESSION['missatge'] = "Has de triar un superheroi!";
                header("Location: index.php?control=ControlSuperheroes");
                exit;
        }
        // Recuperem de la BD el super que volem modificar 
        $codi = $_GET['codi'];     
        $actual = $this->supers->get($codi);
        // Si el id de l'heroi no és correcte i no s'ha pogut recuperar
        // no continuem!
         if (!$actual) {   
            $_SESSION['missatge'] = "Aquest superheroi no existeix!";
            header("Location: index.php?control=ControlSuperheroes");
            exit;
        }            
        // Quan es carregui el formulari per primer cop
        // volem que es mostrin les dades actuals del superheroi.
        //      En cas que ja existeixin, voldrà dir que s'ha recarregat aquest formulari
        //      d'actualització perque les dades dels controls del formulari no són correctes

            $_SESSION['heroname'] = $actual['heroname'];
            $_SESSION['realname'] = $actual['realname'];
            $_SESSION['gender'] = $actual['gender'];
            $_SESSION['race'] = $actual['race'];
            
            $_SESSION['missatge'] = "Superheroi recuperat!!";
       
        // Mostrem el formulari..
        include_once 'vistes/templates/header.php';
        include_once 'vistes/superheroes/formupdate.php';
        include_once 'vistes/templates/footer.php';      
        
    }

    public function update() {
        // Via GET ens passaran el codi de l'heroi que volem modificar
        // Comprovem l'existència del paràmetre
       if(!isset($_GET['codi'])) {
                $_SESSION['missatge'] = "Has de triar un superheroi!";
                header("Location: index.php?control=ControlSuperheroes");
                exit;
        }
        // Recuperem de la BD el super que volem modificar 
        $codi = $_GET['codi'];     
        $actual = $this->supers->get($codi);
        // Si el id de l'heroi no és correcte i no s'ha pogut recuperar
        // no continuem!
         if (!$actual) {   
            $_SESSION['missatge'] = "Aquest superheroi no existeix!";
            header("Location: index.php?control=ControlSuperheroes");
            exit;
        }
        // Recuperem els camps del formulari
        $heroname = obtenir_camp('heroname'); 
        $realname = obtenir_camp('realname');
        $gender = obtenir_camp('gender');
        $race = obtenir_camp('race');     
        // Comprovem les restriccions associades a cada camp     
        if($heroname=="" || $realname=="" 
            || $gender=="" || $race=="") {

            $_SESSION['heroname'] = $heroname;
            $_SESSION['realname'] = $realname;
            $_SESSION['gender'] = $gender;
            $_SESSION['race'] = $race;
            $_SESSION['missatge'] = "Camps obligatoris!!";
                            
            header('Location: index.php?control=ControlSuperheroes&operacio=showformupdate');
            exit;
            }     
        // Modifiquem les dades del superheroi guardant possibles canvis en la BD
         $res = $this->supers->update($codi, $heroname, $realname, $gender, $race);
       if ($res)
            $_SESSION['missatge'] = "Superheroi actualitzat.";
        else
            $_SESSION['missatge'] = "Superheroi no s'ha pogut actualitzat!";
       
        header("Location: index.php?control=ControlSuperheroes");
        exit;
                     
    }




    // Mètode per esborrar un superherou
    public function delete() {
        // Via GET ens passaran el codi de l'heroi que volem esborrar
        // Comprovem l'existència del paràmetre
        if(!isset($_GET['codi'])) {
                $_SESSION['missatge'] = "Has de triar un superheroi!";
                header("Location: index.php?control=ControlSuperheroes");
                exit;
        }
        // Recuperem de la BD el super que volem modificar 
        $codi = $_GET['codi'];     
        $actual = $this->supers->get($codi);
        // Si el id de l'heroi no és correcte i no s'ha pogut recuperar
        // no continuem!
        if (!$actual) {   
            $_SESSION['missatge'] = "Aquest superheroi no existeix!";
            header("Location: index.php?control=ControlSuperheroes");
            exit;
        }    
        // eborrem el superheroi de la BD
        $res = $this->supers->delete($codi);
        //$res = true; (Esto lo he comentado porqu sino la estructura de abajo no tiene sentido) 
        if ($res)
            $_SESSION['missatge'] = "Superheroi eliminat.";
        else
            $_SESSION['missatge'] = "Superheroi no s'ha pogut esborrar!";
       
        header("Location: index.php?control=ControlSuperheroes");
    }

    

    
    
    
}

?>
