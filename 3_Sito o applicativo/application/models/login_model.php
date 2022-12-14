<?php
	/**
	 * classe per il login
	 */
	abstract class LoginClass
	{

		/**
		 * Calcola l'hash della password in sha256
		 */
		static function getHashedPass($pass, $email){
			require 'application/libs/password.php';
			return Password::doHash($pass.$email);
		}

		/**
		 * Viene controllato se le credenziali d'accesso sono valide,
		 * in caso di si, salva anche di che tipo è l'utente
		 */
		static function doLogin(){
			require 'application/libs/database.php';
			$conn = Database::getConnection();
			if (!empty($_POST['email']) && !empty($_POST['password'])) {
				require_once 'application/libs/antiCsScript.php';
				$email = AntiCsScript::check($_POST['email']);
				$password = AntiCsScript::check($_POST['password']);
				$hashedPassword = self::getHashedPass($password, $email);
				$sql = $conn->prepare("SELECT * FROM user WHERE email=? AND password=?");
				$sql->bind_param("ss", $email, $hashedPassword);
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
				throw new Exception("Email o password non valida");
			} else {
				throw new Exception("Completare tutti i campi");
			}
		}
	}
?>
