<?php
class Services extends Controller
{
    /**
     * Questo metodo serve per caricare la pagina per la gestione dei clienti.
     */

    public function index()
    {
        if(isset($_SESSION['email'])){
            $this->view->render('services/index.php');
        }else{
            $this->view->render('login/index.php');
        }
    }

    public function openList()
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
            $this->view->render('services/addService.php');
        }else{
            $this->view->render('login/index.php');
        }
    }

    public function loadModifyPage()
    {
        if(isset($_SESSION['email'])){
            $services =  $this->getServices();
            if($services != false){
                $this->view->render('services/modifyService.php', false, array('services' => $services));
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
            $services =  $this->getServices();
            if($services != false){
                $this->view->render('services/deleteService.php', false, array('services' => $services));
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
    private function getServices(){
        require_once 'application/models/service_model.php';
        return ServiceClass::getServicesInfos();
    }

    /**
     * Questo metodo serve per trovare le informazioni di un singolo cliente in base all'id passato.
     *
     * @param Int $id -> id del negozio
     */
    public function getSpecificServiceInfo($id){
        require_once 'application/models/service_model.php';
        try {
            $shop = ServiceClass::getSingleServiceInfos(intval($id));
        } catch (Exception $e) {
            $shop = $e->getMessage();
        }
        echo json_encode($shop);
    }

    /**
     * Questo metodo viene invocato per aggiungere un cliente.
     * Se tutti i controlli vanno a buon fine, richiama il metodo del model per aggiungere un cliente.
     */
    public function addService(){
        if(isset($_SESSION['email'])){
            require_once 'application/models/service_model.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                try{
                    ServiceClass::addService();
                    $this->locate('services/index');
                }catch(Exception $e){
                    $this->view->render('services/addService.php',
                        false, array('error' => $e->getMessage(), 'name' => $_POST["name"],
                            'cost' => $_POST["cost"]));
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
    public function modifyService(){
        if(isset($_SESSION['email'])){
            require_once 'application/models/service_model.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                try{
                    ServiceClass::modifyService();
                    $this->locate('services/index');
                }catch(Exception $e){
                    $this->view->render('services/modifyService.php', false,
                        array(
                            'services' => $this->getServices(),
                            'error' => $e->getMessage(),
                            'lastName' => $_POST["name"],
                            'lastCost' => $_POST["cost"]));
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
    public function deleteService(){
        require_once 'application/models/service_model.php';
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            try{
                ServiceClass::deleteService();
                $this->locate('services/index');
            }catch(Exception $e){
                $services =  $this->getServices();
                $this->view->render('services/deleteService.php', false,
                    array('error' => "Errore durante l'eliminazione, riprovare", 'services' => $services));
            }
        }
    }
}
?>