<?php
class Clients extends Controller
{
    /**
     * Questo metodo serve per caricare la pagina per la gestione dei clienti.
     */

    public function index()
    {
        if(isset($_SESSION['email'])){
            $this->view->render('clients/index.php');
        }else{
            $this->view->render('login/index.php');
        }
    }

    public function openLista()
    {
        if(isset($_SESSION['email'])){
            $this->view->render('home/lista.php');
        }else{
            $this->view->render('login/index.php');
        }
    }

    public function loadAddPage()
    {
        if(isset($_SESSION['email'])){
            $this->view->render('clients/addClient.php');
        }else{
            $this->view->render('login/index.php');
        }
    }

    public function loadModifyPage()
    {
        if(isset($_SESSION['email'])){
            $this->view->render('clients/modifyClient.php');
        }else{
            $this->view->render('login/index.php');
        }
    }



    /**
     * Questo metodo viene invocato per aggiungere un cliente.
     * Se tutti i controlli vanno a buon fine, richiama il metodo del model per aggiungere un cliente.
     */
    public function addClient(){
        if(isset($_SESSION['email'])){
            require_once 'application/models/client_model.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                try{
                    ClientClass::addClient();
                    $this->locate('clients/index');
                }catch(Exception $e){
                    $this->view->render('clients/addClient.php',
                        false, array('error' => $e->getMessage(), 'lastName' => $_POST["name"],
                            'lastSurname' => $_POST["surname"],
                            'lastEmail' => $_POST["email"]));
                }
            }
        }else{
            $this->view->render('login/index.php');
        }
    }
}
?>