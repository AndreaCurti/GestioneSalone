<?php
	/**
	 * classe per il login
	 */
	class LoginClass
	{
		private $email;
		private $password;
        private $hashedPassword;

		function __construct($email, $password)
		{
			require 'application/libs/AntiCsScript.php';
			$this->email = AntiCsScript::check($email);
			$this->password = AntiCsScript::check($password); 
            $this->getHashedPass();
		}

		/**
		 * Calcola l'hash della password in sha256
		 */
		function getHashedPass(){
			require 'application/libs/password.php';
			$this->hashedPassword = Password::doHash($this->password.$this->email);
		}

		/**
		 * Viene controllato se le credenziali d'accesso sono valide,
		 * in caso di si, salva anche di che tipo è l'utente
		 */
		function doLogin(){
			require 'application/libs/database.php';
            $conn = Database::getConnection();
			$sql = $conn->prepare("SELECT * FROM user WHERE email=? AND password=?");
			$sql->bind_param("ss", $this->email, $this->hashedPassword);
            $sql->execute();
            $result = $sql->get_result();
            if($result){
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION['email'] = $row['email'];
                    return true;
                }
            }
			session_destroy();
			return false;
		} 
	}
?>
