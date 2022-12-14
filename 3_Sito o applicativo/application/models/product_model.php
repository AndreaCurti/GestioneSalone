<?php

/**
 * classe per i prodotti
 */
abstract class ProductClass
{
    static function addProduct(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        if(!empty($_POST['name']) && !empty($_POST['cost'])){
            require_once 'application/libs/antiCsScript.php';
            $name = AntiCsScript::check($_POST['name']);
            $cost = AntiCsScript::check($_POST['cost']);
            $sql = $conn->prepare("INSERT INTO product(name, cost, active) VALUES (?, ?, 1)");
            $sql->bind_param("si",$name, $cost);
            $sql->execute();
        }else{
            throw new Exception("Completare tutti i campi");
        }
    }

    static function getProductsInfos(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        $sql = "SELECT * FROM product";
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

    static function getSingleProductInfos($id){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        $sql = $conn->prepare("SELECT * FROM product WHERE id=?");
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
        throw new Exception("Prodotto non esistente");
    }

    static function modifyProduct(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        if(!empty($_POST['name']) && !empty($_POST['cost'])){
            require_once 'application/libs/antiCsScript.php';
            $id =AntiCsScript::check($_POST['idProduct']);
            $name = AntiCsScript::check($_POST['name']);
            $surname = AntiCsScript::check($_POST['cost']);
            $sql = $conn->prepare("UPDATE product SET name = ?, cost = ? WHERE id = ?");
            $sql->bind_param("sii", $name, $cost, $id);
            $sql->execute();
            if($sql->affected_rows <= 0){
                throw new Exception("Errore durante la modifica");
            }
        }else{
            throw new Exception("Completare tutti i campi");
        }
    }
}
?>
