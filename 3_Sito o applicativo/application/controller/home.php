<?php
    class Home extends Controller
    {
        /**
         * Questo metodo serve per caricare la pagina home adatta.
         */

        public function index()
        {
            if(isset($_SESSION['email'])){
                $this->view->render('home/index.php');
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
    }
?>