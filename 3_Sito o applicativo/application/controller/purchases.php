<?php
class Purchases extends Controller
{

    public function index()
    {
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
}
?>