<?php
	/**
	 * classe per il controllo della password
	 */
	abstract class Password
	{
		/**
         * Questo metodo permette di controllare che una password 
		 * abbia tutte le caratteristiche per essere valida
         */
		public static function isValid($pass){
			$uppercase = preg_match('@[A-Z]@', $pass);
			$lowercase = preg_match('@[a-z]@', $pass);
			$number = preg_match('@[0-9]@', $pass);
			$specialChars = preg_match('@[^\w]@', $pass);
			if(!$uppercase || !$lowercase || !$number 
				|| !$specialChars || strlen($pass) < 8) {
					return false;
			}
			return true;
		}

        /**
         * Viene effettuato l'hash in sha256 della password combinata ad una salt
         * 
         * @param String $plain -> testo da hashare
         */
		public static function doHash($plain){
			return hash('sha256', $plain);
		}

		public static function doHashWithSalt($password, $email){
			return self::doHash($password.$email);
		}
	}
?>

