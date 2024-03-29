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
  public function getReview($orderId){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select nr.review, nr.reviewed_by, nr.date_reviewed
      from
      ncr_review nr
      left join
      ncr n on 
      nr.po = n.po
      where
      nr.po = :orderId
      group by nr.po');
    $stmt->bindValue(':orderId', $orderId);
    $stmt->execute();
    return$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getInvestigation($orderId){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select nr.investigation, nr.initials, nr.date_closed
      from
      ncr_review nr
      left join
      ncr n on 
      nr.po = n.po
      where
      nr.po = :orderId
      group by nr.po');
    $stmt->bindValue(':orderId', $orderId);
    $stmt->execute();
    return$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function closeNcr($name, $newDate, $po){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      ncr
      set 
      closed_by = :name, date_closed =:newDate, status = :status
      where
      po = :po');
    $stmt->bindValue(':po', $po);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':newDate', $newDate);
    $stmt->bindValue(':status', 'CLOSED');
    $stmt->execute();
  }

   public function closeInvestigation($po,$text, $newDate){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('insert into 
      ncr_review
      (po, investigation, date_closed)
      values
      (?,?,?)
      ');
    $stmt->bindValue(1, $po);
    $stmt->bindValue(2, $text);
    $stmt->bindValue(3, $newDate);
    $stmt->execute();

   }
  

  public function review($text, $newDate,$po){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      ncr_review
      set
      review = :text, date_reviewed =:newDate
      where
      po = :po');
    $stmt->bindValue(':text', $text);
    $stmt->bindValue(':newDate', $newDate);
    $stmt->bindValue(':po', $po);
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

  public function updateNCR($field,$details,$id){
    try{
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      ncr
      set '.$field.' = :details, status = "OPEN" 
      where
      id = :id');
    $stmt->bindValue(':details',$details);
    $stmt->bindValue('id', $id);
    $stmt->execute();
    }    
    catch (PDOException $e)
    {
      echo $e;
    }
        echo $id;
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

  public function openNcr($po,$sku,$desc1,$qty,$id, $customerName,$status){
    try{
    $pdo = Database::DB();
    $stmt=$pdo->prepare('insert into
      ncr
      (po,sku,desc1,qty,id,customer_name, status)
      values 
      (?,?,?,?,?,?,?)
      ');
    $stmt->bindValue(1, $po);
    $stmt->bindValue(2, $sku);
    $stmt->bindValue(3, $desc1);
    $stmt->bindValue(4, $qty);
    $stmt->bindValue(5, $id);
    $stmt->bindValue(6, $customerName);
    $stmt->bindValue(7,$status);
    $stmt->execute();
  }    
    catch (PDOException $e)
    {
      echo $e;
    }
        
  }

   public function openNcrEntirePo($id,$po,$sku,$desc1,$customerName,$status,$issue,$action,$initials){
    try{
    $pdo = Database::DB();
    $stmt=$pdo->prepare('insert into
      ncr
      (id,po,sku,p_desc,customer_name,status,problem,correction,raised_by)
      values 
      (?,?,?,?,?,?,?,?,?)
      ');
    $stmt->bindValue(1, $id);
    $stmt->bindValue(2, $po);
    $stmt->bindValue(3, $sku);
    $stmt->bindValue(4, $desc1);
    $stmt->bindValue(5, $customerName);
    $stmt->bindValue(6, $status);
    $stmt->bindValue(7,$issue);
    $stmt->bindValue(8, $action);
    $stmt->bindValue(9, $initials);
    $stmt->execute();
  }    
    catch (PDOException $e)
    {
      echo $e;
    }
    echo ('success');
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