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

class productSpec{

  #add tool to the tool alias db table

  public function addAlias($productRef, $productAlias){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('insert into
      t_tool_alias
      (productRef, productAlias)
      values(?,?)');
    $stmt->bindValue(1, $productRef);
    $stmt->bindValue(2, $productAlias);   
    $stmt->execute();
  }

   public function qaSpec($initials,$tool_ref){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      t_specsheets
      set
      qaInitials = :initials
      where
      toolRef = :tool_ref');
    $stmt->bindValue(':initials', $initials);
    $stmt->bindValue(':tool_ref', $tool_ref);    
    $stmt->execute();
  }

  public function getSpecSheet($toolRef){
    $pdo = Database::DB();
    $stmt =$pdo->prepare('select *
      from
      t_specsheets sp
      LEFT JOIN 
    t_uploads up
    on 
sp.toolRef = up.specRef
      where toolRef = :toolRef');
    $stmt->bindValue(':toolRef', $toolRef);
        $stmt->execute();
        return$stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getSpecSheetList(){
    $pdo = Database::DB();
    $stmt =$pdo->prepare('select *
      from
      t_specSheets sp
      left join
      t_tooling t
      on
      sp.toolRef = t.tool_ref');
        $stmt->execute();
        return$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

    public function getSpecById($id){
    $pdo = Database::DB();
    $stmt =$pdo->prepare('select *
      from t_specsheets sp
      LEFT JOIN 
    t_uploads up
    on 
sp.toolRef = up.specRef
      where 
      id = :id');
    $stmt->bindValue(':id', $id);
        $stmt->execute();
        return$stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getSpecUploadsById($id){
    $pdo = Database::DB();
    $stmt =$pdo->prepare('select *
    from  
    t_uploads 
    where
      specRef = :id');
    $stmt->bindValue(':id', $id);
        $stmt->execute();
        return$stmt->fetchAll(PDO::FETCH_ASSOC);
  }



  public function getPendingSpecs(){
    $pdo = Database::DB();
    $stmt =$pdo->prepare('select *
      from t_specsheets sp
      LEFT JOIN 
    t_uploads up
    on 
sp.toolRef = up.specRef
       where 
      dateAdded is null');
        $stmt->execute();
        return$stmt->fetchAll(PDO::FETCH_ASSOC);
  }

   public function addFile($specRef,$destination){
    $pdo = Database::DB();
    $stmt =$pdo->prepare('insert into
      t_uploads
      (specRef, filePath)
      values 
      (?,?)');
    $stmt->bindValue(1,$specRef);
    $stmt->bindValue(2,$destination);
    $stmt->execute();
  }
 
   public function addSpec($customerName, $toolRef,$alias,$description,$length,$width,$height,$deckle,$chop,$config,$style,$flute,$material,$furtherComments,$productRange, $initials,$loadpoint, $custom){
    try{
    $pdo = Database::DB();
    $stmt = $pdo->prepare('insert into 
      t_specSheets
      (customerName, toolRef,alias,description,length,width,height,deckle,chop,config,style,flute,material,furtherComments, productRange, initials, loadpoint, custom)
      values
      (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
      ');
    $stmt->bindValue(1, $customerName);
    $stmt->bindValue(2, $toolRef);
    $stmt->bindValue(3, $alias);
    $stmt->bindValue(4, $description);
    $stmt->bindValue(5, $length);
    $stmt->bindValue(6, $width);
    $stmt->bindValue(7, $height);
    $stmt->bindValue(8, $deckle);
    $stmt->bindValue(9, $chop);
    $stmt->bindValue(10, $config);
    $stmt->bindValue(11, $style);
    $stmt->bindValue(12, $flute);
    $stmt->bindValue(13, $material);
    $stmt->bindValue(14, $furtherComments);
    $stmt->bindValue(15, $productRange);
    $stmt->bindValue(16, $initials);
    $stmt->bindValue(17, $loadpoint);
    $stmt->bindValue(18, $custom);
    $stmt->execute();
   }
   catch(PDOExcption $e)
   {
    die ($e);
  }
        echo 'Success!';
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

  public function ncrDescription($reason, $description,$newDate,$correction,$initials,$id){
    try{
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
    catch (PDOException $e)
    {
      die("1062 Duplicate Entry");
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