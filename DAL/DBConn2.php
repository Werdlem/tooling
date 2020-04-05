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

  public function machineCapacity($capacity,$machine,$date){
    $pdo = Database::DB();
    $stmt=$pdo->prepare('select
     :capacity-sum(duration) as capacity
    from
    prod_schedule
    where 
    department = :machine 
    and 
    scheduleDate = :date');
    $stmt->bindValue(':capacity', $capacity);
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

  public function getSchedule($department,$capacity){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *, (SUM(DURATION)*100)/:capacity AS capacity,
     :capacity - sum(duration) AS remaining
      from prod_schedule
      where
      scheduleDate >= curdate() 
      and department = :stmt 
      and scheduleDate < now() + interval 14 day
      group by scheduleDate 
      ');   
   $stmt->bindValue(':stmt', $department);
   $stmt->bindValue(':capacity', $capacity);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getScheduleDetails($date){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from prod_schedule
      where
      scheduleDate = :stmt
      ');   
   $stmt->bindValue(':stmt', $date);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  public function productionSchedule($order){
     $pdo = Database::DB();
    $stmt =$pdo->prepare('select *
      from goods_out go
      left join
      t_tooling t 
      on
      go.sku = t.tool_ref
      or 
      go.sku = t.tool_alias
      where go.order_id = :stmt
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
      (order_id,sku, qty, department, duration,scheduleDate,itemId, customer)
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

  public function getCapacity($date, $dep){
    $pdo = Database::DB();
    $stmt=$pdo->prepare('select
    *, 1440-sum(duration) as minutes, sum((duration)*100)/1440 as capacity
    from
    prod_schedule
    where 
    scheduleDate = :date
    and
    department = :department
   ');
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':department', $dep);
    $stmt->execute();
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}