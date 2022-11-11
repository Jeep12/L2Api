<?php

// require_once("view/api-view.php");

// require_once("model/account.model.php");
require_once('api/view/api-view.php');
require_once("api/model/account.model.php");

class ApiLinegeII
{
    private $view;
    private $data;
    private $accountsModel;


    public function __construct() 
    {
        $this->accountsModel = new AccountModel();
        $this->view = new APIView();
        $this->data = file_get_contents("php://input");
    }
    public function get_data()
    {
        return json_decode($this->data);
    }








    public function getAccounts($params) {
        $id = $params[':ID'];
        $search = $this->accountsModel->getAccounts($id);
        if ($search) {
            $this->view->response($search, 200);
        } else {
            $this->view->response("No se encontro nada", 404);
        }

    }



    public function getChars($params) {
        $id = $params[':ID'];
        $search = $this->accountsModel->getCharacters($id);
        if ($search) {
            $this->view->response($search, 200);
        } else {
            $this->view->response("No se encontro nada", 404);
        }

    }



    public function getInv($params){
        $id = $params[':ID'];
 
        $armor = $this->accountsModel->armor($id);
        $weapon = $this->accountsModel->weapon($id);
        $misc = $this->accountsModel->misc($id);
        $inventario  = array_merge($armor, $weapon,$misc);
        if ($inventario) {
            $this->view->response($inventario, 200);
        } else {
            $this->view->response("No se encontro nada", 404);
        }
    }



    public function getChar ($params){
        $id = $params[':ID'];
        $search = $this->accountsModel->getCharacter($id);
        if ($search) {
            $this->view->response($search, 200);
        } else {
            $this->view->response("No se encontro nada", 404);
        }
    }



    public function addAccount (){
        $account = $this->get_data();
        $passwordBase = base64_encode(pack('H*', sha1($account->password)));

        $sendOk = $this->accountsModel->addAccount($account->login, $passwordBase, $account->email);
        
        if ($sendOk) {
            $this->view->response("Se insertó correctamente", 200);
        } else {
            $this->view->response("Hubo un error", 500);
        }
    }
    // $sql = "
    // INSERT INTO `accounts` 
    // (`login`, `password`, `email`, `created_time`, `lastactive`, `accessLevel`, `lastIP`, `lastServer`, `pcIp`, `hop1`, `hop2`, `hop3`, `hop4`)
    //  VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);
    // ";
    // $query = $this->pdo->prepare($sql);
    // $query->execute([$name, $password, $email , 0, 0,0,NULL,2,NULL,NULL,NULL,NULL,NULL]);
    // return $query;
       

 

}
