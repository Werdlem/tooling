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

  public function closeNcr($name, $newDate, $po){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      ncr
      set 
      initials = :name, date_closed =:newDate, status = :status
      where
      po = :po');
    $stmt->bindValue(':po', $po);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':newDate', $newDate);
    $stmt->bindValue(':status', 'CLOSED');
    $stmt->execute();
  }

  public function addComment($text, $po,$field, $newDate, $date){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      ncr
      set 
      '.$field.'= :text,'.$date.'=:newDate
      where
      po = :po');
    $stmt->bindValue(':po', $po);
    $stmt->bindValue(':text', $text);
    $stmt->bindValue(':newDate', $newDate);
    $stmt->execute();
  }

  public function getCustomerNcr($orderId){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from
      ncr
      where
      po = :orderId');
    $stmt->bindValue(':orderId', $orderId);
    $stmt->execute();
    return$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getNcrs($status){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select
      po, date_opened, date_closed
      from
      ncr
       where 
    status = :status     
      group by po
      ');
    $stmt->bindValue(':status', $status);
    $stmt->execute();
    return$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function ncrDescription($reason, $description,$newDate,$correction,$initials,$id){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      ncr
      set problem =?, p_desc = ?, date_opened = ?, correction =?, raised_by = ?, status = "OPEN" 
      where
      id = ?');
    $stmt->bindValue(1,$reason);
    $stmt->bindValue(2,$description);
    $stmt->bindValue(3,$newDate);
    $stmt->bindValue(4, $correction);
     $stmt->bindValue(5, $initials);
    $stmt->bindValue(6, $id);
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

  public function openNcr($po,$sku,$desc1,$qty,$id, $customerName){
    $pdo = Database::DB();
    $stmt=$pdo->prepare('insert into
      ncr
      (po,sku,desc1,qty,id,customer_name)
      values 
      (?,?,?,?,?,?)
      ');
    $stmt->bindValue(1, $po);
    $stmt->bindValue(2, $sku);
    $stmt->bindValue(3, $desc1);
    $stmt->bindValue(4, $qty);
    $stmt->bindValue(5, $id);
    $stmt->bindValue(6, $customerName);
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