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

class tartarus{

  public function machineCapacity($machine,$date){
    $pdo = Database::DB();
    $stmt=$pdo->prepare('select
     480-sum(duration) as capacity
    from
    prod_schedule
    where 
    machine = :machine 
    and 
    scheduleDate = :date');
    $stmt->bindValue(':machine', $machine);
    $stmt->bindValue(':date', $date);
    $stmt->execute();
     return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function findOrder($order){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from prod_schedule
      where
      order_id = :orderId');
    $stmt->bindValue(':orderId', $order);
    $stmt->execute();
    return$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getMachineData($machine,$date){
    $pdo = Database::DB();
    $stmt=$pdo->prepare('select
    *
    from
    prod_schedule
    where 
    machine = :machine 
    and 
    scheduleDate = :date');
    $stmt->bindValue(':machine', $machine);
    $stmt->bindValue(':date', $date);
    $stmt->execute();
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getSchedule(){
    $pdo = Database::DB();
    $stmt = $pdo->query('select * 
      from prod_schedule
      where scheduleDate > curdate()
      and scheduleDate < now() + interval 14 day
      order by scheduleDate asc
      ');
   
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function productionSchedule($order){
     $pdo = Database::DB();
    $stmt =$pdo->prepare('select *
      from goods_out
      where order_id = :stmt
     ');
  $stmt->bindValue(':stmt',$order);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function schedule($order,$sku, $qty, $machine, $duration,$scheduleDate,$itemId, $customer){

    $pdo = Database::DB();    
    try{
    $stmt =$pdo->prepare('insert into
      prod_schedule
      (order_id,sku, qty, machine, duration,scheduleDate,itemId, customer)
      values 
      (?,?,?,?,?,?,?,?)');
    $stmt->bindValue(1,$order);
    $stmt->bindValue(2,$sku);
    $stmt->bindValue(3,$qty);
    $stmt->bindValue(4,$machine);
    $stmt->bindValue(5,$duration);
    $stmt->bindValue(6,$scheduleDate);
    $stmt->bindValue(7, $itemId);
    $stmt->bindValue(8, $customer);
    $stmt->execute();
    }
    catch(PDOException $e){
      echo "ERROR " . $e->getMessage();     
    }
    return 'Scheduled!';
  }

  public function getCapacity($date){
    $pdo = Database::DB();
    $stmt=$pdo->prepare('select
    machine, 480-sum(duration) as minutes, sum((duration)*100)/480 as capacity
    from
    prod_schedule
    where 
    scheduleDate = :date
    group by machine');
    $stmt->bindValue(':date', $date);
    $stmt->execute();
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}