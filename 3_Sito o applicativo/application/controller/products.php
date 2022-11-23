<?php
class Products extends Controller
{
    /**
     * Questo metodo serve per caricare la pagina per la gestione dei prodotti.
     */

    public function index()
    {
        if(isset($_SESSION['email'])){
            $this->view->render('products/index.php');
        }else{
            $this->view->render('login/index.php');
        }
    }

    public function loadAddPage()
    {
        if(isset($_SESSION['email'])){
            $this->view->render('products/.php');
        }else{
            $this->view->render('login/index.php');
        }
    }

    public function loadModifyPage()
    {
        if(isset($_SESSION['email'])){
            $this->view->render('products/.php');
        }else{
            $this->view->render('login/index.php');
        }
    }

    public function loadDeletePage()
    {
        if(isset($_SESSION['email'])){
            $this->view->render('products/.php');
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