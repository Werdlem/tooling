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

  public function getOpenQuotes($value){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_quotes q
      join
      t_sales s on
      q.salesId = s.salesId
      where
      sent = :value
      group by quote_ref');
    $stmt->bindValue(':value', $value);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addCustomer ($customer,$business,$address,$contact_no,$email,$salesId,$date,$quote_ref){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('insert into 
      t_quotes
      (customer,business,address,contact_no,email,salesId,date,quote_ref)
      values (?,?,?,?,?,?,?,?)');
    $stmt->bindValue(1, $customer);
    $stmt->bindValue(2,$business);
    $stmt->bindValue(3, $address);
    $stmt->bindValue(4,$contact_no);
    $stmt->bindValue(5,$email);
    $stmt->bindValue(6,$salesId);
    $stmt->bindValue(7, $date);
    $stmt->bindValue(8,$quote_ref);
    $stmt->execute();
  }

  public function getSalesMan(){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_sales');
    $stmt->execute();
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function quoteSent($quote_ref){
    $pdo = Database::DB();
    try{
    $stmt = $pdo->prepare('update
      t_quotes
      set sent = 1
      where quote_ref = :quote_ref');
    $stmt->bindValue(':quote_ref', $quote_ref);
    $stmt->execute();
    echo 'Email Sent Successfully'; 
  } 
      
      catch (PDOException $e){

        echo 'Oops, Something went wrong';
      
        }
  }

  public function addLine($customer,$description,$id,$size,$qty,$unit_price,$total_price,$ref,$sales,$quote_ref,$date){
  $pdo = Database::DB();
  $stmt = $pdo->prepare('insert into
      t_quotes
      (customer, description,  size, qty, unit_price, total_price, ref,salesId,quote_ref,date)
      values(?,?,?,?,?,?,?,?,?,?)
      ');
  $stmt->bindValue(1, $customer);
  $stmt->bindValue(2, $description);
  $stmt->bindValue(3, $size);
  $stmt->bindValue(4, $qty);
  $stmt->bindValue(5, $unit_price);
  $stmt->bindValue(6, $total_price);
  $stmt->bindValue(7, $ref);
  $stmt->bindValue(8, $sales);
  $stmt->bindValue(9, $quote_ref);
  $stmt->bindValue(10, $date);
  $stmt->execute();

}

  public function deleteLine($id){
    $pdo= Database::DB();
    $stmt = $pdo->prepare('delete
      from t_quotes
      where 
      id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
  }

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

  public function addQuote($customer,$ref,$description,$size,$qty,$unitPrice,$totalPrice,$salesId,$date,$reference,$business,$address,$email,$contact_no){
        $pdo = Database::DB();
        $stmt=$pdo->prepare('insert 
          into t_quotes
          (customer,ref,description,size,qty,unit_price,total_price,salesId,date,quote_ref,business, address, email, contact_no)
          values(?,?,?,?,?,?,?,?,?,?,?,?,?,?) 
          ');
        $stmt->bindValue(1,$customer);
        $stmt->bindValue(2,$ref);
        $stmt->bindValue(3,$description);
        $stmt->bindValue(4, $size);
        $stmt->bindValue(5, $qty);
        $stmt->bindValue(6, $unitPrice);
        $stmt->bindValue(7, $totalPrice);
        $stmt->bindValue(8, $salesId);
        $stmt->bindvalue(9, $date);
        $stmt->bindValue(10,$reference);
        $stmt->bindValue(11,$business);
        $stmt->bindValue(12,$address);
        $stmt->bindValue(13,$email);
        $stmt->bindValue(14,$contact_no);
        $stmt->execute();
    } 

    public function getQuotesCustomers(){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_quotes q
      join t_sales s on
      q.salesId = s.salesId
      where sent = 0
      group by q.customer     
      ');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

   public function getQuotes($customer){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_quotes q
      join t_sales s on
      q.salesId = s.salesId
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