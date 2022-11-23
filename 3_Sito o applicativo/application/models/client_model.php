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
            && !empty($_POST['password']) && !empty($_POST['confPassword'])){
            require_once 'application/libs/antiCsScript.php';
            require_once 'application/libs/password.php';
            require_once 'application/libs/email.php';
            $name = AntiCsScript::check($_POST['name']);
            $surname = AntiCsScript::check($_POST['surname']);
            $email = AntiCsScript::check($_POST['email']);
            $password = AntiCsScript::check($_POST['password']);
            $confPassword = AntiCsScript::check($_POST['confPassword']);
            if(strcmp($password, $confPassword) == 0){
                if(Password::isValid($password)){
                    if(Email::isValid($email)){
                        $hashedpass = Password::doHashWithSalt($password, $email);
                        $sql = $conn->prepare("INSERT INTO user(name, surname, email, password, role, super, active, shop_id) VALUES (?, ?, ?, ?, 'utente', NULL, 1, NULL)");
                        $sql->bind_param("ssss",$name, $surname, $email, $hashedpass);
                        $sql->execute();
                    }else{
                        throw new Exception("L'email non è valida oppure è già in utilizzo");
                    }
                }else{
                    throw new Exception("La password deve contenere almeno:<br>- 8 Caratteri<br>-1 Maiuscola<br>-1 Minuscola<br>-1 Cifra<br>-1 Carattere speciale");
                }
            }else{
                throw new Exception("Le due password inserite non corrispondono");
            }
        }else{
            throw new Exception("Completare tutti i campi");
        }
    }
}
?>
