<?php
	/**
	 * classe per il controllo della email
	 */
	abstract class Email
	{

		/**
         * Torna se l'email ha tuttte le caratteristiche valide oppure no
         */
		public static function isValid($email){
			if(self::checkFilters($email)){
				if(self::checkEmailsInDB($email)){
					return true;
				}else{
					throw new Exception("Email già esistente");
				}
			}else{
				throw new Exception("Email non valida");
			}
		}

		/**
         * Torna se l'email ha tutti i caratteri validi
         */
		public static function checkFilters($email){
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}

		/**
         * Torna se l'email è già presente (false) nel database oppure no (true)
         */
		public static function checkEmailsInDB($email){
			require_once 'application/libs/database.php';
            $conn = Database::getConnection();
			$sql = $conn->prepare("SELECT * FROM user WHERE email=? ");
			$sql->bind_param("s", $email);
            $sql->execute();
            $result = $sql->get_result();
            if($result){
                if ($result->num_rows > 0) {
                    return false;
                }
            }
			return true;
		}

		/**
		 * Controlla se l'email dell'utente con id passato come parametro sia uguale a quella passata.
		 * Se torna 1 significa che l'email passata è uguale a quella presente sul database, altrimenti 0
		 *
		 * @param Int $id -> id dell'utente
		 */
		public static function isOldEmail($id, $email){
			require_once 'application/libs/database.php';
			$conn = Database::getConnection();
			$sql = $conn->prepare("SELECT * FROM user WHERE id=?");
			$sql->bind_param("s", $id);
			$sql->execute();
			$result = $sql->get_result();
			$finEm = $result->fetch_assoc()['email'];
			if($finEm == $email){
				return true;
			}
			return false;
		}
	}
?>
