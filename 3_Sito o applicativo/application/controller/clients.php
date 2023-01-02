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
     * Questo metodo serve per caricare la pagina di scelta di un cliente.
     */
    public function loadChooseWhichClient(){
        if(isset($_SESSION['email'])){
            $clients =  $this->getClients();
            if($clients != false){
                $this->view->render('clients/chooseWhichClient.php', false, array('clients' => $clients));
            }else{
                $this->locate('home/loadErrorPage');
            }
        }else{
            $this->view->locate('login/index');
        }
    }

    /**
     * Questo metodo serve per caricare la pagina per la gestionedegli acquisti di un cliente.
     */
    public function loadManagePurchases(){
        if(isset($_SESSION['email'])){
            if(isset($_SESSION['selectedClientId'])){
                $this->view->render('clients/managePurchases.php');
            }else{
                $this->loadChooseWhichClient();
            }
        }else{
            $this->view->locate('login/index');
        }
    }

    /**
     * Questo metodo viene invocato per la selezione di un cliente.
     * Se tutti i controlli vanno a buon fine, richiama il metodo del model per selezionare un cliente.
     */
    public function chooseWhichClient(){
        if(isset($_SESSION['email'])){
            require_once 'application/models/client_model.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                try{
                    ClientClass::chooseWhichClient();
                    $this->locate('clients/loadManagePurchases');
                }catch(Exception $e){
                    $clients =  $this->getClients();
                    if($clients != false){
                        $this->view->render('clients/chooseWhichClient.php', false, array('clients' => $clients));
                    }else{
                        $this->locate('home/loadErrorPage');
                    }
                }
            }
        }else{
            $this->view->locate('login/index');
        }
    }

    /**
     * Questo metodo serve per caricare la pagina per immettere l'acquisto di un prodotto
     */
    public function loadAddProductPurchase(){
        if(isset($_SESSION['email'])){
            if(isset($_SESSION['selectedClientId'])){

                require_once 'application/models/product_model.php';
                $products = ProductClass::getProductsInfos();

                require_once 'application/models/method_model.php';
                $methods = MethodClass::getMethodsInfos();

                $this->view->render('clients/addProductPurchase.php', false, array('products' => $products, 'methods' => $methods));
            }else{
                $this->loadChooseWhichClient();
            }
        }else{
            $this->view->locate('login/index');
        }
    }

    /**
     * Questo metodo serve per caricare la pagina per immettere l'acquisto di un servizio
     */
    public function loadAddServicePurchase(){
        if(isset($_SESSION['email'])){
            if(isset($_SESSION['selectedClientId'])){

                require_once 'application/models/service_model.php';
                $services = ServiceClass::getServicesInfos();

                require_once 'application/models/method_model.php';
                $methods = MethodClass::getMethodsInfos();

                $this->view->render('clients/addServicePurchase.php', false, array('services' => $services, 'methods' => $methods));
            }else{
                $this->loadChooseWhichClient();
            }
        }else{
            $this->view->locate('login/index');
        }
    }

    /**
     * Questo metodo serve per aggiungere il pagamento di un prodotto
     */
    public function addProductPurchase(){
        if(isset($_SESSION['email'])){
            if(isset($_SESSION['selectedClientId'])){
                require_once 'application/models/client_model.php';
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    try{

                        ClientClass::addProductPurchase();
                        $this->locate('clients/loadManagePurchases');

                    }catch(Exception $e){
                        require_once 'application/models/product_model.php';
                        $products = ProductClass::getProductsInfos();

                        require_once 'application/models/method_model.php';
                        $methods = MethodClass::getMethodsInfos();

                        $this->view->render('clients/addProductPurchase.php',
                            false, array('error' => $e->getMessage(),
                                'products' => $products,
                                'methods' => $methods));
                    }
                }
            }else{
                $this->loadChooseWhichClient();
            }
        }else{
            $this->view->render('login/index.php');
        }
    }

    /**
     * Questo metodo serve per aggiungere il pagamento di un servizio
     */
    public function addServicePurchase(){
        if(isset($_SESSION['email'])){
            if(isset($_SESSION['selectedClientId'])){
                require_once 'application/models/client_model.php';
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    try{

                        ClientClass::addServicePurchase();
                        $this->locate('clients/loadManagePurchases');

                    }catch(Exception $e){
                        require_once 'application/models/service_model.php';
                        $services = ServiceClass::getServicesInfos();

                        require_once 'application/models/method_model.php';
                        $methods = MethodClass::getMethodsInfos();

                        $this->view->render('clients/addServicePurchase.php',
                            false, array('error' => $e->getMessage(),
                                'services' => $services,
                                'methods' => $methods));
                    }
                }
            }else{
                $this->loadChooseWhichClient();
            }
        }else{
            $this->view->render('login/index.php');
        }
    }

    /**
     * Questo metodo serve per caricare la pagina dove mostra gli acquisti dei prodotti effettuati dal cliente
     */
    public function loadProductsPurchased(){
        if(isset($_SESSION['email'])){
            if(isset($_SESSION['selectedClientId'])){

                require_once 'application/models/client_model.php';
                $productPurchased = ClientClass::getProductsPurchased();

                $this->view->render('clients/productPurchased.php', false, array('productPurchased' => $productPurchased));
            }else{
                $this->loadChooseWhichClient();
            }
        }else{
            $this->view->locate('login/index');
        }
    }

    /**
     * Questo metodo serve per caricare la pagina dove mostra gli acquisti dei prodotti effettuati dal cliente
     */
    public function loadServicesPurchased(){
        if(isset($_SESSION['email'])){
            if(isset($_SESSION['selectedClientId'])){

                require_once 'application/models/client_model.php';
                $servicePurchased = ClientClass::getServicesPurchased();

                $this->view->render('clients/servicePurchased.php', false, array('servicePurchased' => $servicePurchased));
            }else{
                $this->loadChooseWhichClient();
            }
        }else{
            $this->view->locate('login/index');
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
     * @param Int $id -> id del cliente
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