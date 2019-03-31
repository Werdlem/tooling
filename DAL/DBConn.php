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

  public function insertPrices($brown, $white,$black,$red,$green, $orange, $yellow, $blue, $purple, $gold, $silver, $limegreen, $pink,$id){  
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update
      t_prices_new
      set brown = ?, white=?, black =?, red = ?, green = ?, orange = ?, yellow=?, blue = ?, purple = ?, gold = ?, silver = ?, limegreen = ?, pink = ?
      where
      tool_id = ?
      ');
    
    $stmt->bindValue(1,$brown);
    $stmt->bindValue(2,$white);
    $stmt->bindValue(3,$black);
    $stmt->bindValue(4,$red);
    $stmt->bindValue(5,$green);
    $stmt->bindValue(6,$orange);
    $stmt->bindValue(7,$yellow);
    $stmt->bindValue(8,$blue);
    $stmt->bindValue(9,$purple);
    $stmt->bindValue(10,$gold);
    $stmt->bindValue(11,$silver);
    $stmt->bindValue(12,$limegreen);
    $stmt->bindValue(13,$pink);
    $stmt->bindValue(14,$id);
    $stmt->execute();   
   }

//get website prices
  public function getPrices($tool_id){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_prices_new
      where
      tool_id = :stmt
      ');
    $stmt->bindValue(':stmt', $tool_id);
    $stmt->execute(); 
    if($stmt->rowCount()<1){
      $stmt = $pdo->prepare('insert into
      t_prices_new
      (tool_id)
      VALUES (?)
      ');
  $stmt->bindValue(1,$tool_id);
  $stmt->execute();
  }
  else
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_prices_new
      where
      tool_id = :stmt
      ');
    $stmt->bindValue(':stmt', $tool_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
  //add line to website price table
  public function addLineWebPrice($id){
  try{
  $pdo = Database::DB();
  $stmt = $pdo->prepare('insert into
      t_prices
      (tool_id)
      VALUES (?)
      ');
  $stmt->bindValue(1,$id);
  $stmt->execute();
  $last_id = $pdo->lastInsertId();
  echo $last_id;
    }
    catch (PDOException $e){
}
}
  //add new quote to customer

  public function newQuote($customerId, $salesId, $quoteRef){
    $pdo = Database::DB();
    $stmt =$pdo->prepare('insert into
      t_new_quotes
      (customerId, salesId,quoteRef)
      values 
      (?,?,?)');
    $stmt->bindValue(1,$customerId);
    $stmt->bindValue(2,$salesId);
    $stmt->bindValue(3,$quoteRef);
    $stmt->execute();
  }
  //update customer
  public function updateCustomer ($customer,$business,$addressLine1,$addressLine2,$addressLine3,$postCode,$contact_no,$email,$id){
    try{
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      t_customers
      set
      customer = (?), 
      business = (?),
      address_line_1 = (?),
      address_line_2 = (?),
      address_line_3 = (?),
      postcode = (?),
      contact_no = (?),
      email = (?)
      where id = (?)
     ');
    $stmt->bindValue(1, $customer);
    $stmt->bindValue(2,$business);
    $stmt->bindValue(3, $addressLine1);
    $stmt->bindValue(4,$addressLine2);
    $stmt->bindValue(5,$addressLine3);
    $stmt->bindValue(6, $postCode);
    $stmt->bindValue(7, $contact_no);
    $stmt->bindValue(8, $email);
    $stmt->bindValue(9, $id);    
    $stmt->execute();
  }
   catch (PDOException $e)
    {
      die("ERROR");
    }
        echo "Customer updated Successfully";
   }

   public function getPastQuotes($value){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_quotes
      where
            customer = :id
      group by quote_ref   
      ');
    $stmt->bindValue(':id', $value);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function searchAllCustomers($value){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_customers
      where
      customer like :value 
      or business like :value
      or email like :value
      or postcode like :value

      ');
    $stmt->bindValue(':value', '%'.$value."%");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getAllCustomers(){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select * 
      from t_customers
      ');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getCustomers($value){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_customers
      where
      id = :id
      or
      customer = :id
      ');
    $stmt->bindValue(':id', $value);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getOpenQuotes($value){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_new_quotes q
      join t_sales s on
      q.salesId = s.salesId
      join t_customers c on
      q.customerId = c.id
      
      where q.email = 1 
      or q.print = 1

      ');
    $stmt->bindValue(':value', $value);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addCustomer ($customer,$business,$addressLine1,$addressLine2,$addressLine3,$postCode,$contact_no,$email,$date){
    try{
    $pdo = Database::DB();
    $stmt = $pdo->prepare('insert into 
      t_customers
      (customer,business,address_line_1,address_line_2,address_line_3, postcode,contact_no,email,date)
      values (?,?,?,?,?,?,?,?,?)');
    $stmt->bindValue(1, $customer);
    $stmt->bindValue(2,$business);
    $stmt->bindValue(3, $addressLine1);
    $stmt->bindValue(4,$addressLine2);
    $stmt->bindValue(5,$addressLine3);
    $stmt->bindValue(6, $postCode);
    $stmt->bindValue(7, $contact_no);
    $stmt->bindValue(8, $email);
    $stmt->bindValue(9, $date);    
    $stmt->execute();
  }
    catch (PDOException $e)
    {
      die("1062 Duplicate Entry");
    }
        echo "Customer added Successfully";
   }

  public function getSalesMan(){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_sales');
    $stmt->execute();
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

public function printQuote($ref){
    $pdo = Database::DB();
    try{
    $stmt = $pdo->prepare('update
      t_new_quotes
      set print = 1
      where quoteRef = :ref');
    $stmt->bindValue(':ref', $ref);
    $stmt->execute();
    echo 'Quote Printed'; 
  } 
      
      catch (PDOException $e){

        echo 'Oops, Something went wrong';
      
        }
  }
  public function quoteSent($quote_ref){
    $pdo = Database::DB();
    try{
    $stmt = $pdo->prepare('update
      t_new_quotes
      set email = 1
      where quoteRef = :quote_ref');
    $stmt->bindValue(':quote_ref', $quote_ref);
    $stmt->execute();
    echo 'Email Sent Successfully'; 
  } 
      
      catch (PDOException $e){

        echo 'Oops, Something went wrong';
      
        }
  }

  public function addLine($quoteRef){
    try{
  $pdo = Database::DB();
  $stmt = $pdo->prepare('insert into
      t_quotes
      (quote_ref)
      VALUES (?)
      ');
  $stmt->bindValue(1,$quoteRef);
  $stmt->execute();
  $last_id = $pdo->lastInsertId();
  echo $last_id;
    }
    catch (PDOException $e){
}
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

  public function updateLine($description,$id,$size,$qty,$unit_price,$total_price,$ref,$salesId,$customerId,$date){
  $pdo = Database::DB();
  $stmt = $pdo->prepare('update
      t_quotes
      set description = :description, size = :size, qty = :qty, unit_price = :unit_price, total_price = :total_price, ref = :ref,salesId = :salesId, customer = :customerId, date = :date
      where
      id = :id');
  $stmt->bindValue(':description', $description);
  $stmt->bindValue(':size', $size);
  $stmt->bindValue(':qty', $qty);
  $stmt->bindValue(':unit_price', $unit_price);
  $stmt->bindValue('total_price', $total_price);
  $stmt->bindValue(':ref', $ref);
  $stmt->bindValue(':id', $id);
  $stmt->bindValue(':salesId', $salesId);
  $stmt->bindValue(':customerId', $customerId);
  $stmt->bindValue(':date', $date);
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

    public function getPendingQuotes(){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_new_quotes q
      join t_sales s on
      q.salesId = s.salesId
      join t_customers c on
      q.customerId = c.id
      where q.email = 0 
      and q.print = 0

      ');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

   public function getQuotes($customer){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_quotes q
      where
      q.quote_ref = :stmt
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

  public function addTool($tool_ref,$location,$config,$style,$flute,$length,$width,$height,$ktok_width,$ktok_length,$date, $esc_ref, $tool_alias,$loadpoint,$custom){
    $pdo =Database::DB();
    $stmt = $pdo->prepare('insert into
      t_tooling
      (tool_ref,location,config,style,flute,length,width,height,ktok_width,ktok_length,date, esc_ref, tool_alias,loadpoint,custom)
      values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
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
    $stmt->bindValue(14,$loadpoint);
    $stmt->bindValue(15,$custom);
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