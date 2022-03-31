<?php

class Operacao{
    private $con;
    function __construct()
    {

        require_once dirname(__FILE__). './Conexao.php';
        $bd = new Conexao();
        $this->con = $bd->connect();

    }

    function createBolos($campo_2,$campo_3,$campo_4){
        $stmt = $this->con->prepare("INSERT INTO bolos_tb(nomebolo,,valorbolo,imgbolo) VALUES (?,?,?)");
        $stmt->bind_param("sss",$campo_2,$campo_3,$campo_4);
        if($stmt->execute())
            return true;
        return var_dump($stmt);

    }

    function getBolos(){
        $stmt = $this->con->prepare("Select * from bolos_tb");
        $stmt -> execute();
        $stmt -> bind_result($uid,$nomebolo,$imgbolo,$valorbolo);
        $dicas = array();

while($stmt->fetch()){
    $dica = array();
    $dica['uid']= $uid;
    $dica['nomebolo']=$nomebolo;
    $dica['imgbolo']=$imgbolo;
    $dica['valorbolo']=$valorbolo;
    array_push($dicas,$dica);

}

return $dicas;

}
    function updateBolos($campo_1,$campo_2,$campo_3,$campo_4){
    $stmt = $this->con->prepare("update bolos_tb set nomebolo = ? ,imgbolo= ?, valorbolo = ? where uid=?");
    $stmt->bind_param("sssi",$campo_2,$campo_3,$campo_4,$campo_1);
        if($stmt->execute())
            return true;
            return false;

}

     function deleteBolos($campo_1){
     $stmt = $this->con->prepare("delete from bolos_tb where uid = ?");
     $stmt->bind_param("i",$campo_1);
        if($stmt-> execute())
    return true;
    return false;

     }
    }
