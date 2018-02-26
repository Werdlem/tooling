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

  public function getRecentTools(){
    $pdo = Database::DB();
    $stmt = $pdo->prepare('select *
      from tooling
      order by id desc 
      limit 5
      ');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addTool($tool_ref,$location,$config,$style,$flute,$length,$width,$height,$ktok_width,$ktok_length,$date, $esc_ref){
    $pdo =Database::DB();
    $stmt = $pdo->prepare('insert into
      tooling
      (tool_ref,location,config,style,flute,length,width,height,ktok_width,ktok_length,date, esc_ref)
      values(?,?,?,?,?,?,?,?,?,?,?,?)');
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
    $stmt->execute();
      }

      public function updateTool($tool_ref,$location,$config,$style,$flute,$length,$width,$height,$ktok_width,$ktok_length,$date, $esc_ref,$id){
        $pdo= Database::DB();
         $stmt = $pdo->prepare('update 
          tooling
          set tool_ref = (?),location = (?),config = (?),style = (?),flute = (?),length = (?),width = (?),height = (?),ktok_width = (?),ktok_length = (?),date = (?), esc_ref = (?)
          where 
          id = (?)
          ');
              #$stmt->bindValue(1, $tool_id);
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
     $stmt->bindValue(13 ,$id);
    $stmt->execute();
      }

      public function getToolById($id)
      {
        $pdo = Database::DB();
        $stmt = $pdo->prepare('select *
          from tooling 
          where 
          id = :id');
        $stmt->bindValue(':id', $id);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function getTools(){
        $pdo = Database::DB();
        $stmt=$pdo->prepare("select *
          from tooling
          order by tool_ref asc");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      public function addShout($shout, $id){
        $pdo = Database::DB();
        $stmt = $pdo->prepare('insert into
          comments
          (comments, tool_id)
          values (?,?)
          ');
        $stmt->bindValue(1,$shout);
        $stmt->bindValue(2, $id);
        $stmt->execute();
      }

      public function getShouts($id){
        $pdo = Database::DB();
        $stmt=$pdo->prepare('select *
          from comments
          where
          tool_id = :id
          order by date desc');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      
}