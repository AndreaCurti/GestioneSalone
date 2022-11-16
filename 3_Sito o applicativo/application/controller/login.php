<?php
    class Login extends Controller
    {
        /**
         * Questo metodo serve per caricare la pagina di login.
         * In caso l'utente fosse già loggato e questa pagine viene richiamata,
         * l'utente verrà sloggato e portato alla pagina di login.
         * 
         * @param String $message -> errore da stampare, default = ""
         */
        public function index($message = ""){
            session_unset();
            $this->view->errorMessage = $message;
            $this->view->render('login/index.php');
        }

        
        public function loginUser(){
            require 'application/models/login_model.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!empty($_POST["email"]) || !empty($_POST["password"])){
                    $user = new LoginClass($_POST["email"], $_POST["password"]);
                    if($user->doLogin()){
                        $this->view->locate('home');
                    }else{
                        $this->view->render('login/index.php', false,
                            array('error' => "Email o password non valida", 'lastEmail' => $_POST["email"]));
                    }
                }else{
                    $this->view->render('login/index.php', false,
                        array('error' => "Completare tutti i campi", 'lastEmail' => $_POST["email"]));
                }

            }
        }
    }
?>