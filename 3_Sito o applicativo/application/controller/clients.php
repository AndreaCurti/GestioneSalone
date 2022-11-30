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
            $clients =  $this->getClients();
            if($clients != false){
                $this->view->render('clients/modifyClient.php', false, array('clients' => $clients));
            }else{
                $this->locate('home/loadErrorPage');
            }
        }else{
            $this->view->render('login/index.php');
        }
    }

    public function loadDeletePage()
    {
        if(isset($_SESSION['email'])){
            $clients =  $this->getClients();
            if($clients != false){
                $this->view->render('clients/deleteClient.php', false, array('clients' => $clients));
            }else{
                $this->locate('home/loadErrorPage');
            }
        }else{
            $this->view->render('login/index.php');
        }
    }

    /**
     * Questo metodo serve per trovare tutti i clienti.
     */
    private function getClients(){
        require_once 'application/models/client_model.php';
        return ClientClass::getClientsInfos();
    }

    /**
     * Questo metodo serve per trovare le informazioni di un singolo cliente in base all'id passato.
     *
     * @param Int $id -> id del negozio
     */
    public function getSpecificClientInfo($id){
        require_once 'application/models/client_model.php';
        try {
            $shop = ClientClass::getSingleClientInfos(intval($id));
        } catch (Exception $e) {
            $shop = $e->getMessage();
        }
        echo json_encode($shop);
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
                            'lastEmail' => $_POST["email"],
                            'lastNumber' => $_POST["number"]));
                }
            }
        }else{
            $this->view->render('login/index.php');
        }
    }

    /**
     * Questo metodo viene invocato per modificare un cliente.
     * Se tutti i controlli vanno a buon fine, richiama il metodo del model per modificare un cliente.
     */
    public function modifyClient(){
        if(isset($_SESSION['email'])){
            require_once 'application/models/client_model.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                try{
                    ClientClass::modifyClient();
                    $this->locate('clients/index');
                }catch(Exception $e){
                    $this->view->render('clients/modifyClient.php', false,
                        array(
                            'clients' => $this->getClients(),
                            'error' => $e->getMessage(),
                            'lastName' => $_POST["name"],
                            'lastAddress' => $_POST["address"],
                            'lastId' => $_POST['idShop'],
                            'lastNumber' => $_POST['number']));
                }
            }
        }else{
            $this->view->render('login/index.php');
        }
    }

    /**
     * Questo metodo viene invocato per eliminare un cliente.
     * Se tutti i controlli vanno a buon fine, richiama il metodo del model per eliminare un cliente.
     */
    public function deleteClient(){
        require_once 'application/models/client_model.php';
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            try{
                ClientClass::deleteClient();
                $this->locate('clients/index');
            }catch(Exception $e){
                $clients =  $this->getClients();
                $this->view->render('clients/deleteClient.php', false,
                    array('error' => "Errore durante l'eliminazione, riprovare", 'clients' => $clients));
            }
        }
    }

}
?>