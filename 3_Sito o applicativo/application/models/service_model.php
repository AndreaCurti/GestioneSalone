<?php

/**
 * classe per i servizi
 */
abstract class ServiceClass
{
    static function addService(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        if(!empty($_POST['name']) && !empty($_POST['cost'])){
            require_once 'application/libs/antiCsScript.php';
            $name = AntiCsScript::check($_POST['name']);
            $service = AntiCsScript::check($_POST['cost']);

            $sql = $conn->prepare("INSERT INTO service(name, cost, active) VALUES (?, ?, 1)");
            $sql->bind_param("si",$name, $service);
            $sql->execute();
        }else{
            throw new Exception("Completare tutti i campi");
        }
    }

    static function getServicesInfos(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        $sql = "SELECT * FROM service";
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

    static function getSingleServiceInfos($id){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        $sql = $conn->prepare("SELECT * FROM service WHERE id=?");
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
        throw new Exception("Servizio non esistente");
    }

    static function modifyService(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        if(!empty($_POST['name']) && !empty($_POST['cost'])){
            require_once 'application/libs/antiCsScript.php';
            $id =AntiCsScript::check($_POST['idService']);
            $name = AntiCsScript::check($_POST['name']);
            $cost = AntiCsScript::check($_POST['cost']);
            $sql = $conn->prepare("UPDATE service SET name = ?, cost = ? WHERE id = ?");
            $sql->bind_param("sii", $name, $cost, $id);
            $sql->execute();
            if($sql->affected_rows <= 0){
                throw new Exception("Errore durante la modifica");
            }
        }else{
            throw new Exception("Completare tutti i campi");
        }
    }

    static function deleteService(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        if(!empty($_POST["idService"])){
            require_once 'application/libs/antiCsScript.php';
            $id = AntiCsScript::check($_POST["idService"]);
            $sql = $conn->prepare("DELETE FROM service WHERE id = ?");
            $sql->bind_param("i", $id);
            $sql->execute();
        }else{
            throw new Exception("Nessun servizo selezionato");
        }
    }
}
?>
