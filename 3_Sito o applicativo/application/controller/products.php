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
            $this->view->render('products/addProduct.php');
        }else{
            $this->view->render('login/index.php');
        }
    }

    public function loadModifyPage()
    {
        if(isset($_SESSION['email'])){
            $products =  $this->getProducts();
            if($products != false){
                $this->view->render('products/modifyProduct.php', false, array('products' => $products));
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
            $products =  $this->getProducts();
            if($products != false){
                $this->view->render('products/deleteProduct.php', false, array('products' => $products));
            }else{
                $this->locate('home/loadErrorPage');
            }
        }else{
            $this->view->render('login/index.php');
        }
    }

    /**
     * Questo metodo serve per trovare tutti i prodotti.
     */
    private function getProducts(){
        require_once 'application/models/product_model.php';
        return ProductClass::getProductsInfos();
    }

    /**
     * Questo metodo serve per trovare le informazioni di un singolo prodotto in base all'id passato.
     *
     * @param Int $id -> id del prodotto
     */
    public function getSpecificProductInfo($id){
        require_once 'application/models/product_model.php';
        try {
            $product = ProductClass::getSingleProductInfos(intval($id));
        } catch (Exception $e) {
            $shop = $e->getMessage();
        }
        echo json_encode($product);
    }

    /**
     * Questo metodo viene invocato per aggiungere un prodotto.
     * Se tutti i controlli vanno a buon fine, richiama il metodo del model per aggiungere un prodotto.
     */
    public function addProduct(){
        if(isset($_SESSION['email'])){
            require_once 'application/models/product_model.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                try{
                    ProductClass::addProduct();
                    $this->locate('products/index');
                }catch(Exception $e){
                    $this->view->render('products/addProduct.php',
                        false, array('error' => $e->getMessage(),
                            'lastName' => $_POST["name"],
                            'lastCost' => $_POST["cost"]));
                }
            }
        }else{
            $this->view->render('login/index.php');
        }
    }

    /**
     * Questo metodo viene invocato per modificare un prodotto.
     * Se tutti i controlli vanno a buon fine, richiama il metodo del model per modificare un prodotto.
     */
    public function modifyProduct(){
        if(isset($_SESSION['email'])){
            require_once 'application/models/product_model.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                try{
                    ProductClass::modifyProduct();
                    $this->locate('products/index');
                }catch(Exception $e){
                    $this->view->render('products/modifyProduct.php', false,
                        array(
                            'products' => $this->getProducts(),
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
     * Questo metodo viene invocato per modificare un prodotto.
     * Se tutti i controlli vanno a buon fine, richiama il metodo del model per modificare un prodotto.
     */
    public function deleteProduct(){
        if(isset($_SESSION['email'])){
            require_once 'application/models/product_model.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                try{
                    ProductClass::deleteProduct();
                    $this->locate('products/index');
                }catch(Exception $e){
                    $this->view->render('products/deleteProduct.php', false,
                        array(
                            'products' => $this->getProducts(),
                            'error' => $e->getMessage()));
                }
            }
        }else{
            $this->view->render('login/index.php');
        }
    }
}
?>