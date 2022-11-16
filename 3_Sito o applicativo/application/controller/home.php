<?php
    class Home extends Controller
    {
        /**
         * Questo metodo serve per caricare la pagina home adatta.
         * In caso è un amministratore, apre la pagina home per l'admin,
         * altrimenti la pagina home utente.
         */
        public function index()
        {
            if(isset($_SESSION['role'])){
                if($_SESSION['role'] == "amministratore"){
                    $this->view->render('homeAdmin/index.php');
                }else if($_SESSION['role'] == "utente"){
                    $this->view->render('homeUser/index.php');
                }
            }else{
                $this->view->render('login/index.php');
            }
        }

        public function openLista()
        {
            if(isset($_SESSION['role'])){
                if($_SESSION['role'] == "amministratore"){
                    $this->view->render('homeAdmin/lista.php');
                }else if($_SESSION['role'] == "utente"){
                    $this->view->render('homeUser/lista.php');
                }
            }else{
                $this->view->render('login/index.php');
            }
        }

        public function loadErrorPage(){
            if(isset($_SESSION['role'])){
                if($_SESSION['role'] == "amministratore"){
                    $this->view->render('homeAdmin/error.php');
                }else if($_SESSION['role'] == "utente"){
                    $this->view->render('homeUser/error.php');
                }
            }else{
                $this->view->render('login/index.php');
            }
        }
    }
?>