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

  public function qaSpec($initials,$esc_ref, $location, $tool_ref){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      t_specsheets
      set
      qaInitials = :initials, esc_ref = :esc_ref, location = :location
      where
      toolRef = :tool_ref');
    $stmt->bindValue(':initials', $initials);
    $stmt->bindValue('esc_ref', $esc_ref);
    $stmt->bindValue('location', $location);
    $stmt->bindValue(':tool_ref', $tool_ref);    
    $stmt->execute();
  }

  public function updateIdPrice($id,$price){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update
     t_priceband
     set price = :price
     where id = :id');
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
  }

  public function getFiles($qid){
     $pdo = Database::DB();
    $stmt =$pdo->prepare('select * 
      from t_uploads
      where qid = :stmt');
    $stmt->bindValue(':stmt',$qid);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addFile($qid,$destination){
    $pdo = Database::DB();
    $stmt =$pdo->prepare('insert into
      t_uploads
      (qid, filePath)
      values 
      (?,?)');
    $stmt->bindValue(1,$qid);
    $stmt->bindValue(2,$destination);
    $stmt->execute();
  }


  public function deleteQuote($quoteRef){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('delete nq, q
      from t_new_quotes as nq
      join t_quotes as q 
      on
      nq.qid = q.qid
      where nq.qid = :ref');
    $stmt->bindValue(':ref', $quoteRef);
    $stmt->execute();
  }

   public function getCustomerQuoteDetails($value){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_new_quotes q
      join t_sales s on
      q.salesId = s.salesId
      join t_customers c on
      q.customerId = c.id
      
      where Qid = :value

      ');
    $stmt->bindValue(':value', $value);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getQuoteById($id){
    $pdo = Database::DB();
    $stmt=$pdo->prepare('select *
      from t_new_quotes q
      join t_sales t on q.salesId=t.salesId
      join t_quotes qu on q.qid = qu.qid

     where q.qid = :stmt
      ');
    $stmt->bindValue(':stmt', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function requote($quoteRef, $qid){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      t_new_quotes
      set quoteRef = ?, email = 0, print = 0, result = "open", details = (NULL), amount = (NULL)
      where 
      Qid = ?
      ');
    $stmt->bindValue(1,$quoteRef);
    $stmt->bindValue(2, $qid);
    $stmt->execute();
  }

  public function closeQuoteLost($result, $details, $qid){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      t_new_quotes
      set result = ?, details = ?, amount = (NULL)
      where 
      qid = ?
      ');
    $stmt->bindValue(1,$result);
    $stmt->bindValue(2, $details);
    $stmt->bindValue(3, $qid);
    $stmt->execute();
  }

  public function closeQuoteWon($result, $details, $qid, $orderId){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      t_new_quotes
      set result = ?, amount = ?, details = (NULL), orderId =?
      where 
      qid = ?
      ');
    $stmt->bindValue(1,$result);
    $stmt->bindValue(2, $details);
    $stmt->bindValue(3, $orderId);
    $stmt->bindValue(4, $qid);
    $stmt->execute();
  }

  public function inactive($result, $reminder, $qid){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('update 
      t_new_quotes
      set result = ?, reminder = ?, details = (NULL)
      where 
      qid = ?
      ');
    $stmt->bindValue(1,$result);
    $stmt->bindValue(2, $reminder);
    $stmt->bindValue(3, $qid);
    $stmt->execute();
  }

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

//GET NOTES FOR QUOTE

public function getNotes($quoteRef){
  $pdo = Database::DB();
  $stmt=$pdo->prepare('select *
    from t_quote_notes
    where Qid = :quoteRef');
  $stmt->bindValue(':quoteRef', $quoteRef);
  $stmt->execute();
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

  //ADD NOTE TO CUSTOMER QUOTES

public function addNoteToQuote($quoteRef, $notes){
    $pdo = Database::DB();
    $stmt =$pdo->prepare('insert into
      t_quote_notes
      (Qid, notes)
      values 
      (?,?)');
    $stmt->bindValue(1,$quoteRef);
    $stmt->bindValue(2,$notes);
    //$stmt->bindValue(3,$date); 
    $stmt->execute();
  }

  //add new quote to customer
  public function newQuote($customerId, $salesId, $quoteRef, $status){
    $pdo = Database::DB();
    $stmt =$pdo->prepare('insert into
      t_new_quotes
      (customerId, salesId,quoteRef,result)
      values 
      (?,?,?,?)');
    $stmt->bindValue(1,$customerId);
    $stmt->bindValue(2,$salesId);
    $stmt->bindValue(3,$quoteRef);
    $stmt->bindValue(4,$status);
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
      Cemail = (?)
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
      from t_new_quotes
      where
            customerId = :id
      
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
      or Cemail like :value
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
      join t_new_quotes
      on
      t_customers.id = t_new_quotes.customerId
      where
      t_customers.id = :id
      or
      t_customers.customer = :id
      ');
    $stmt->bindValue(':id', $value);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getNewCustomer($value){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_customers
     where
      t_customers.id = :id
      or
      t_customers.customer = :id
      ');
    $stmt->bindValue(':id', $value);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getSalesmanOpenQuotes($value){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_new_quotes q
      join t_sales s on
      q.salesId = s.salesId
      join t_customers c on
      q.customerId = c.id
      where s.salesId = :value

      ');
    $stmt->bindValue(':value', $value);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOpenQuotes($value){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from t_new_quotes q
      join t_sales s on
      q.salesId = s.salesId
      join t_customers c on
      q.customerId = c.id
      where q.result = :value
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
      (customer,business,address_line_1,address_line_2,address_line_3, postcode,contact_no,Cemail,Cdate)
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

public function printQuote($ref, $comment_1,$comment_2,$comment_3){
    $pdo = Database::DB();
    try{
    $stmt = $pdo->prepare('update
      t_new_quotes
      set print = 1, comment_1 = :comment1, comment_2 = :comment2, comment_3 = :comment3
      where quoteRef = :ref');
    $stmt->bindValue(':ref', $ref);
    $stmt->bindValue(':comment1', $comment_1);
    $stmt->bindValue(':comment2', $comment_2);
    $stmt->bindValue(':comment3', $comment_3);
    $stmt->execute();
    echo 'Quote Printed'; 
  } 
      
      catch (PDOException $e){

        echo 'Oops, Something went wrong';
      
        }
  }
  public function quoteSent($quote_ref, $comment_1,$comment_2,$comment_3){
    $pdo = Database::DB();
    try{
    $stmt = $pdo->prepare('update
      t_new_quotes
      set email = 1, comment_1 = :comment1, comment_2 = :comment2, comment_3 = :comment3
      where quoteRef = :quote_ref');
    $stmt->bindValue(':quote_ref', $quote_ref);
    $stmt->bindValue(':comment1', $comment_1);
    $stmt->bindValue(':comment2', $comment_2);
    $stmt->bindValue(':comment3', $comment_3);
    $stmt->execute();
    echo 'Email Sent Successfully'; 
  } 
      
      catch (PDOException $e){

        echo 'Oops, Something went wrong';
      
        }
  }

  public function addLine($quoteRef,$unit,$date){
    try{
  $pdo = Database::DB();
  $stmt = $pdo->prepare('insert into
      t_quotes
      (quote_ref, unit,dateCreate)
      VALUES (?, ?, ?)
      ');
  $stmt->bindValue(1,$quoteRef);
  $stmt->bindValue(2,$unit);
  $stmt->bindValue(3, $date);
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

  public function updateLine($description,$id,$size,$qty,$unit_price,$unit,$ref,$salesId,$customerId,$date,$qid){
  $pdo = Database::DB();
  $stmt = $pdo->prepare('update
      t_quotes
      set description = :description, size = :size, qty = :qty, unit_price = :unit_price, unit = :unit, ref = :ref,salesId = :salesId, customer = :customerId, date = :date, qid = :qid
      where
      id = :id');
  $stmt->bindValue(':description', $description);
  $stmt->bindValue(':size', $size);
  $stmt->bindValue(':qty', $qty);
  $stmt->bindValue(':unit_price', $unit_price);
  $stmt->bindValue('unit', $unit);
  $stmt->bindValue(':ref', $ref);
  $stmt->bindValue(':id', $id);
  $stmt->bindValue(':salesId', $salesId);
  $stmt->bindValue(':customerId', $customerId);
  $stmt->bindValue(':date', $date);
  $stmt->bindValue(':qid', $qid);
  $stmt->execute();

}

  public function addQuote($customer,$ref,$description,$size,$qty,$unitPrice,$totalPrice,$salesId,$date,$reference,$qid){
        $pdo = Database::DB();
        $stmt=$pdo->prepare('insert 
          into t_quotes
          (customer,ref,description,size,qty,unit_price,total_price,salesId,date,quote_ref,Qid)
          values(?,?,?,?,?,?,?,?,?,?,?) 
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
        $stmt->bindValue(11,$qid);
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
      from t_new_quotes nq      
      join      
      t_quotes q
      on nq.qid = q.qid    
      where
      nq.quoteRef = :stmt
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

      public function getReport($sales,$status,$dateFrom,$dateTo)
      {
        $pdo = Database::DB();
        $stmt = $pdo->prepare('select *
          from t_new_quotes q
          join t_customers c on
          q.customerId = c.id
          where q.salesId = :sales and
        q.result = :status and
          q.dateClose between :dateFrom and :dateTo' );
        $stmt->bindValue(':sales', $sales);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':dateFrom', $dateFrom);
        $stmt->bindValue(':dateTo', $dateTo);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function getTools(){
        $pdo = Database::DB();
        $stmt=$pdo->prepare("select *
          from t_tooling
          order by tool_ref asc");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }

       public function getProTools(){
        $pdo = Database::DB();
        $stmt=$pdo->prepare("select tool_ref, productRef as alias, tool_alias, config, location 
          from t_tooling t
         left join
            t_tool_alias a on
            t.tool_ref = a.productAlias
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
  order by min asc');
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