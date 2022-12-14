<?php
    class Login extends Controller
    {
        /**
         * Questo metodo serve per caricare la pagina di login.
         * In caso l'utente fosse già loggato e questa pagine viene richiamata,
         * l'utente verrà sloggato e portato alla pagina di login.
         */
        public function index(){
            session_unset();
            $this->view->render('login/index.php');
        }


        public function loginUser(){
            require 'application/models/login_model.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                try{
                    LoginClass::doLogin();
                    $this->view->locate('home');
                }catch(Exception $e){
                    $this->view->render('login/index.php', false, array('error' => $e->getMessage(), 'lastEmail' => $_POST["email"]));
                }
            }
        }
    }
?>