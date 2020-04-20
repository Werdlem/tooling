<?php
require_once('settings.php');
class Database
{  

    private static $conn  = null;
     
    public static function DB()
    {       
		if (!isset(self::$conn)) {
			
          self::$conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
		  self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
           return self::$conn;
    }
}

class ncr{

  public function getOpenNcrs(){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select
      po, date_opened
      from
      ncr
      group by po');
    $stmt->execute();
    return$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function ncrDescription($reason, $description,$newDate,$id){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      ncr
      set problem =?, p_desc = ?, date_opened = ?    
      where
      id = ?');
    $stmt->bindValue(1,$reason);
    $stmt->bindValue(2,$description);
    $stmt->bindValue(3,$newDate);
    $stmt->bindValue(4, $id);
    $stmt->execute();
  }

  public function deleteNcr($id){
    $pdo = Database::DB();
    $stmt=$pdo->prepare('delete
      from
      ncr
      where
      id = :id');
    $stmt->bindValue(':id',$id);
    $stmt->execute();
  }

  public function openNcr($po,$sku,$desc1,$qty,$id){
    $pdo = Database::DB();
    $stmt=$pdo->prepare('insert into
      ncr
      (po,sku,desc1,qty,id)
      values 
      (?,?,?,?,?)
      ');
    $stmt->bindValue(1, $po);
    $stmt->bindValue(2, $sku);
    $stmt->bindValue(3, $desc1);
    $stmt->bindValue(4, $qty);
    $stmt->bindValue(5, $id);
    $stmt->execute();
  }

  public function findOrder($order){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from goods_out
      where
      order_id = :orderId');
    $stmt->bindValue(':orderId', $order);
    $stmt->execute();
    return$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  }