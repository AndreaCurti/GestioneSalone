<?php

/**
 * classe per i metodi di pagamento
 */
abstract class MethodClass
{
    static function getMethodsInfos(){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        $sql = "SELECT * FROM method";
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

    static function getSingleMethodInfos($id){
        require_once 'application/libs/database.php';
        $conn = Database::getConnection();
        $sql = $conn->prepare("SELECT * FROM method WHERE id=?");
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
        throw new Exception("Metodo di pagamento non esistente");
    }
}
?>
