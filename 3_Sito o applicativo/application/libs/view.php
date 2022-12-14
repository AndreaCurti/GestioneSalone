<?php

class View
{
    function __construct(){

    }

    /**
     * Questo metodo permette di caricare una pagina php, con header e footer
     * passando solo la path della pagina.
     * 
     * @param String $name -> la path della view da caricare
     * @param Boolean $onlyIncludeBody -> se includere o meno l'header e footer, default = false
     * @param Array $data -> le variabili da passare alla view da caricare
     * usage:  $this->view->render('<view>'[,<include>, array('<key>' => <value>)]);
     */
    public function render($name, $onlyIncludeBody = false, $data = array()){
        require 'application/views/links.php';

        if($onlyIncludeBody){
            require "application/views/" . $name;
        }else{
            /*$pos = strrpos($name,"/");
            $lastDirHeader = substr($name, 0, $pos);
            $dirHeader = 'application/views/'.$lastDirHeader.'/header.php';

            if(file_exists($dirHeader)){
                require $dirHeader;
            }else{
                require 'application/views/header.php';
            }*/
            if(isset($_SESSION['email'])){
                require 'application/views/header.php';
            }
            require "application/views/" . $name;
            require 'application/views/footer.php';
        }
    }
	
    /**
     * Permette di cercare un file alla path passata
     * 
     * @param String $path -> percorso del file da trovare
     */
	public function locate($path){
		header("Location: " . URL . $path);
	}
}


?>