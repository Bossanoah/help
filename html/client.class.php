<?php
require "Model.class.php";
 class  User{
    // on cree les attributs de la classe user
    private $id_user;
    private $nom_user;
    private $prenom_user;
    private $email_user;
    private $motdepasse;
    private $num_tel;
    private $date_inscript;
    private $statut;
    private $ville;
    // $public static $user;
    // on cree le constructeur de user
    public function __construct($id_user,$nom_user,$prenom_user,$email_user,$motdepasse,$adresse,$num_tel,$date_inscript,$statut,$ville){
        $this -> id_user = $id_user;
        $this -> nom_user = $nom_user;
        $this -> prenom_user = $prenom_user;
        $this -> email_user = $email_user;
        $this -> motdepasse = $id_user;
        $this -> num_tel = $num_tel;
        $this -> date_inscript = $date_inscript;
        $this -> statut = $statut;
        $this -> ville= $ville;
       //self::$user[] =  $this;
       // for ($i= 0 ; $i <count(user::$user); $i++) :// nom de la classe suivie de lattribut concerner
    }

    public function getid_user(){ return $this->id_user; }
    public function getmotdepasse(){ return $this ->motdepasse; }
    public function setmotdepasse($motdepasse){ $this->motdepasse = $motdepasse}

    public function listeclient(){
        $req = $this->getDB()->prepare("SELECT * FROM user ORDER BY id_user DESC");
        $req ->execute();
        $user = $req 
    }
 }

?>