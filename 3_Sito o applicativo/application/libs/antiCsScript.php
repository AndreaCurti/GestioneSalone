<?php
	/**
	 * classe adatta per controllare che non ci siano script injectati in campi di testo
	 */
	abstract class AntiCsScript
	{
            /**
             * Questo metodo permette di rimuovere spazi vuoti, gli slash, 
             * e caratteri speciali da una stringa
             * 
             * @param String $data -> la stringa da controllare
             */
            public static function check($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
	}
?>