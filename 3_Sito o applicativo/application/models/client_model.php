<?php

/**
 * classe per i clienti
 */
abstract class ClientClass
{
    static function addClient(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email'])
            && !empty($_POST['number'])){
            require_once 'application/libs/antiCsScript.php';
            require_once 'application/libs/email.php';
            $name = AntiCsScript::check($_POST['name']);
            $surname = AntiCsScript::check($_POST['surname']);
            $email = AntiCsScript::check($_POST['email']);
            $number = AntiCsScript::check($_POST['number']);
            if(Email::isValidClient($email)){
                $sql = $conn->prepare("INSERT INTO client(name, surname, email, phone) VALUES (?, ?, ?, ?)");
                $sql->bind_param("ssss",$name, $surname, $email, $number);
                $sql->execute();
            }else{
                throw new Exception("L'email non è valida oppure è già in utilizzo");
            }
        }else{
            throw new Exception("Completare tutti i campi");
        }
    }

    static function getClientsInfos(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        $sql = "SELECT * FROM client";
        $result = $conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    static function getSingleClientInfos($id){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        $sql = $conn->prepare("SELECT * FROM client WHERE id=?");
        $sql->bind_param("i",$id);
        $sql->execute();
        $result = $sql->get_result();
        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        throw new Exception("Cliente non esistente");
    }

    static function modifyClient(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        if(!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email'])  && !empty($_POST['number'])){
            require_once 'application/libs/antiCsScript.php';
            $id =AntiCsScript::check($_POST['idClient']);
            $name = AntiCsScript::check($_POST['name']);
            $surname = AntiCsScript::check($_POST['surname']);
            $email = AntiCsScript::check($_POST['email']);
            $number = AntiCsScript::check($_POST['number']);
            $sql = $conn->prepare("UPDATE client SET name = ?, surname = ?, email = ?, phone = ?  WHERE id = ?");
            $sql->bind_param("sssii", $name, $surname, $email, $number, $id);
            $sql->execute();
            if($sql->affected_rows <= 0){
                throw new Exception("Errore durante la modifica");
            }
        }else{
            throw new Exception("Completare tutti i campi");
        }
    }

    static function deleteClient(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        if(!empty($_POST["idClient"])){
            require_once 'application/libs/antiCsScript.php';
            $id = AntiCsScript::check($_POST["idClient"]);
            $sql = $conn->prepare("DELETE FROM client WHERE id = ?");
            $sql->bind_param("i", $id);
            $sql->execute();
        }else{
            throw new Exception("Nessun cliente selezionato");
        }
    }
}
?>
