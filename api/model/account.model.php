<?php 

require_once("model.php");
class AccountModel extends Model {



    public function getAccounts($email)
     {
     
        $query = $this->pdo->prepare('SELECT login,email,created_time,lastIP,pcIp FROM accounts WHERE email = ?');
        $query->execute([$email]);
        $accounts = $query->fetchAll(PDO::FETCH_OBJ);
        return $accounts;
    }
    public function getCharacters($login)
    {
    
       $query = $this->pdo->prepare('SELECT char_name, charId,online  FROM characters WHERE account_name = ?');
       $query->execute([$login]);
       $accounts = $query->fetchAll(PDO::FETCH_OBJ);
       return $accounts;
   }
   public function armor($char){
    $sql= "SELECT * FROM items JOIN armor ON items.item_id = armor.item_id  WHERE owner_id= ?";
    $query = $this->pdo->prepare($sql);
    $query->execute([$char]);
    $inv = $query->fetchAll(PDO::FETCH_OBJ);
    return $inv;
}
public function weapon($char){
    $sql= "SELECT * FROM items JOIN weapon ON items.item_id = weapon.item_id  WHERE owner_id= ?";
    $query = $this->pdo->prepare($sql);
    $query->execute([$char]);
    $inv = $query->fetchAll(PDO::FETCH_OBJ);
    return $inv;
}
public function misc($char){
    $sql= "SELECT * FROM items JOIN etcitem ON items.item_id = etcitem.item_id  WHERE owner_id= ?";
    $query = $this->pdo->prepare($sql);
    $query->execute([$char]);
    $inv = $query->fetchAll(PDO::FETCH_OBJ);
    return $inv;
}
public function getCharacter($name)
{

   $query = $this->pdo->prepare('SELECT * FROM characters WHERE char_name = ?');
   $query->execute([$name]);
   $accounts = $query->fetchAll(PDO::FETCH_OBJ);
   return $accounts;
}
public function addAccount($name, $password,$email)
{   
    $sql = "
    INSERT INTO accounts 
    (login, password, email, created_time, lastactive, accessLevel, lastIP, lastServer, pcIp, hop1, hop2, hop3, hop4)
     VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?);
    ";
    $query = $this->pdo->prepare($sql);
    $query->execute([$name, $password, $email , 0, 0,0,'','2','','','','','']);
    return $query;
       
    }
}