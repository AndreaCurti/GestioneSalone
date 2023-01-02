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

    /**
     * Questo metodo serve per selezionare un cliente.
     */
    static function chooseWhichClient(){
        if(!empty($_POST["idClient"])){
            require_once 'application/libs/antiCsScript.php';
            $id = AntiCsScript::check($_POST["idClient"]);
            $_SESSION['selectedClientId'] = $id;
            $_SESSION['selectedClientName'] = self::getSingleClientInfos($id)[0]['name'];
            $_SESSION['selectedClientSurname'] = self::getSingleClientInfos($id)[0]['surname'];
        }else{
            throw new Exception("No client selected");
        }
    }

    static function addProductPurchase(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        if(!empty($_POST['idProduct']) && !empty($_POST['idMethod'])){
            require_once 'application/libs/antiCsScript.php';
            $product = AntiCsScript::check($_POST['idProduct']);
            $method = AntiCsScript::check($_POST['idMethod']);
            $clientId = $_SESSION['selectedClientId'];
                
            $sql = $conn->prepare("INSERT INTO client_buys_product(client_id, product_id, method_id, date) VALUES (?, ?, ?, CURDATE())");
                
            $sql->bind_param("iii",$clientId, $product, $method);
                
            $sql->execute();
        }else{
            throw new Exception("Completare tutti i campi");
        }
    }

    static function addServicePurchase(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        if(!empty($_POST['idService']) && !empty($_POST['idMethod'])){
            require_once 'application/libs/antiCsScript.php';
            $service = AntiCsScript::check($_POST['idService']);
            $method = AntiCsScript::check($_POST['idMethod']);
            $clientId = $_SESSION['selectedClientId'];
                
            $sql = $conn->prepare("INSERT INTO client_buys_service(client_id, service_id, method_id, date) VALUES (?, ?, ?, CURDATE())");
                
            $sql->bind_param("iii",$clientId, $service, $method);
                
            $sql->execute();
        }else{
            throw new Exception("Completare tutti i campi");
        }
    }

    static function getProductsPurchased(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();

        $client = $_SESSION['selectedClientId'];

        $sql = $conn->prepare("SELECT p.name as product_name, p.cost as product_cost, m.name as method_name, cbp.date as date FROM client_buys_product as cbp INNER JOIN product as p ON p.id = cbp.product_id INNER JOIN method as m ON m.id = cbp.method_id where client_id=?");

        $sql->bind_param("i", $client);
        
        $sql->execute();

        $result = $sql->get_result();
        
        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    static function getServicesPurchased(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();

        $client = $_SESSION['selectedClientId'];

        $sql = $conn->prepare("SELECT s.name as service_name, s.cost as service_cost, m.name as method_name, cbs.date as date FROM client_buys_service as cbs INNER JOIN service as s ON s.id = cbs.service_id INNER JOIN method as m ON m.id = cbs.method_id where client_id=?");

        $sql->bind_param("i", $client);
        
        $sql->execute();

        $result = $sql->get_result();
        
        $data = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
}
?>
