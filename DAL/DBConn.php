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

class tooling{

  public function updateLine($customer,$description,$id,$size,$qty,$unit_price,$total_price,$ref){
  $pdo = Database::DB();
  $stmt = $pdo->prepare('update
      t_quotes
      set customer = :customer, description = :description, size = :size, qty = :qty, unit_price = :unit_price, total_price = :total_price, ref = :ref
      where
      id = :id');
  $stmt->bindValue(':customer', $customer);
  $stmt->bindValue(':description', $description);
  $stmt->bindValue(':size', $size);
  $stmt->bindValue(':qty', $qty);
  $stmt->bindValue(':unit_price', $unit_price);
  $stmt->bindValue('total_price', $total_price);
  $stmt->bindValue(':ref', $ref);
  $stmt->bindValue(':id', $id);
  $stmt->execute();

}

  public function addQuote($customer,$ref,$description,$size,$qty,$unitPrice,$totalPrice,$sales,$date,$reference){
        $pdo = Database::DB();
        $stmt=$pdo->prepare('insert 
          into t_quotes
          (customer,ref,description,size,qty,unit_price,total_price,sales,date,quote_ref)
          values(?,?,?,?,?,?,?,?,?,?) 
          ');
        $stmt->bindValue(1,$customer);
        $stmt->bindValue(2,$ref);
        $stmt->bindValue(3,$description);
        $stmt->bindValue(4, $size);
        $stmt->bindValue(5, $qty);
        $stmt->bindValue(6, $unitPrice);
        $stmt->bindValue(7, $totalPrice);
        $stmt->bindValue(8, $sales);
        $stmt->bindvalue(9, $date);
        $stmt->bindValue(10,$reference);
        $stmt->execute();
    } 

    public function getQuotesCustomers(){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select customer, quote_ref, sales
      from t_quotes 
      group by customer     
      ');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

   public function getQuotes($customer){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_quotes 
      where
      customer = :stmt    
      ');
    $stmt->bindValue(':stmt', $customer);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addPriceBreak($fluteId,$gradeId,$cost,$low,$high,$supplierId){
        $pdo = Database::DB();
        $stmt=$pdo->prepare('insert 
          into t_priceband
          (flute_id,grade_id,price,min,max,supplier_id)
          values(?,?,?,?,?,?) 
          ');
        $stmt->bindValue(1,$fluteId);
        $stmt->bindValue(2,$gradeId);
        $stmt->bindValue(3,$cost);
        $stmt->bindValue(4,$low);
        $stmt->bindValue(5,$high);
        $stmt->bindValue(6, $supplierId);
        $stmt->execute();
    } 

  public function getRecentTools(){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_tooling
      where
      added = 0
      ');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addTool($tool_ref,$location,$config,$style,$flute,$length,$width,$height,$ktok_width,$ktok_length,$date, $esc_ref, $tool_alias){
    $pdo =Database::DB();
    $stmt = $pdo->prepare('insert into
      t_tooling
      (tool_ref,location,config,style,flute,length,width,height,ktok_width,ktok_length,date, esc_ref, tool_alias)
      values(?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $stmt->bindValue(1, $tool_ref);
    $stmt->bindValue(2,$location);
    $stmt->bindValue(3,$config);
    $stmt->bindValue(4,$style);
    $stmt->bindValue(5, $flute);
    $stmt->bindValue(6, $length);
    $stmt->bindValue(7,$width);
    $stmt->bindValue(8, $height);
    $stmt->bindValue(9, $ktok_width);
    $stmt->bindValue(10, $ktok_length);
    $stmt->bindValue(11,$date);
    $stmt->bindValue(12,$esc_ref);
     $stmt->bindValue(13,$tool_alias);
    $stmt->execute();
      }

      public function toolAdded($id, $added){
    $pdo =Database::DB();
    $stmt = $pdo->prepare('update
      t_tooling
      set added = (?)
      where
      id = (?)
      ');
    $stmt->bindValue(1, $added);
    $stmt->bindValue(2,$id);
    $stmt->execute();
      }

      public function updateTool($tool_ref,$location,$config,$style,$flute,$length,$width,$height,$ktok_width,$ktok_length,$date, $esc_ref,$tool_alias, $id){
        $pdo= Database::DB();
         $stmt = $pdo->prepare('update 
          t_tooling
          set tool_ref = (?),location = (?),config = (?),style = (?),flute = (?),length = (?),width = (?),height = (?),ktok_width = (?),ktok_length = (?),date = (?), esc_ref = (?), tool_alias = (?)
          where 
          id = (?)
          ');
           
    $stmt->bindValue(1, $tool_ref);
    $stmt->bindValue(2,$location);
    $stmt->bindValue(3,$config);
    $stmt->bindValue(4,$style);
    $stmt->bindValue(5, $flute);
    $stmt->bindValue(6, $length);
    $stmt->bindValue(7,$width);
    $stmt->bindValue(8, $height);
    $stmt->bindValue(9, $ktok_width);
    $stmt->bindValue(10, $ktok_length);
    $stmt->bindValue(11,$date);
    $stmt->bindValue(12,$esc_ref);
    $stmt->bindValue(13,$tool_alias);
    $stmt->bindValue(14,$id);
    $stmt->execute();
      }

      public function getToolById($id)
      {
        $pdo = Database::DB();
        $stmt = $pdo->prepare('select *
          from t_tooling 
          where 
          id = :id');
        $stmt->bindValue(':id', $id);
         $stmt->execute();
         return $stmt->fetch(PDO::FETCH_ASSOC);
      }
      public function getTools(){
        $pdo = Database::DB();
        $stmt=$pdo->prepare("select *
          from t_tooling
          order by tool_ref asc");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function addComment($comment, $id){
        $pdo = Database::DB();
        $stmt = $pdo->prepare('insert into
          t_comments
          (comments, tool_id)
          values (?,?)
          ');
        $stmt->bindValue(1,$comment);
        $stmt->bindValue(2, $id);
        $stmt->execute();
      }

      public function getComments($id){
        $pdo = Database::DB();
        $stmt=$pdo->prepare('select *
          from t_comments
          where
          tool_id = :id
          order by date desc');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
//ADD SUPPLIER
      public function addSupplier($supplier){
        $pdo = Database::DB();
        $stmt=$pdo->prepare('insert into
          t_suppliers
          (supplier_name)
          values(:stmt)');
        $stmt->bindValue(':stmt', $supplier);
        $stmt->execute();
      }
//FETCH SUPPLIER LIST
      public function getSuppliers(){
        $pdo = Database::DB();
        $stmt=$pdo->prepare('select *
          from t_suppliers
          ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
 //FETCH SUPPLIER BOARD PRICE DETAILS
 
 public function getSupplierPrices($id){
 $pdo = Database::DB();
 $stmt = $pdo->prepare('select *
  from t_sheetboard_prices
  where 
  supplier_id = :stmt
  order by min desc');
  $stmt->bindvalue(':stmt', $id);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);  
  }   

  //RETURN ALL SUPPLIER BOARD PRICES

   public function getAllSupplierBoardPrices(){
 $pdo = Database::DB();
 $stmt = $pdo->prepare('select *
  from t_sheetboard_prices
  order by min asc');
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);  
  }

  //FETCH BOARD PRICE LIST
      public function getBoard($id){
        $pdo = Database::DB();
        $stmt=$pdo->prepare('select *
          from t_sheetboard_prices
          ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

      public function getFlute(){
        $pdo = Database::DB();
        $stmt=$pdo->prepare('select *
          from t_flute
          ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } 

      public function getGrade(){
        $pdo = Database::DB();
        $stmt=$pdo->prepare('select *
          from t_grade
          ');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      } 

  }