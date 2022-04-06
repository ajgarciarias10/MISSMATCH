<?php 
  require_once('header.php');
  require_once('DBSettings.php');
  ini_set('display_errors', 1);
  
  
  $sql= "SELECT * FROM mismatch_response where user_id = " . $_SESSION['user_id'];
  $resultado = $dbh->getQuery($sql);
  $rows = $resultado->fetchAll();
  $user_id = $_SESSION['user_id'];
  //CASO DE QUE ESTE  VACIA LA TABLA RESPUESTAS
    if(count($rows) == 0)
    {
        $sql="SELECT 	topic_id FROM mismatch_topic";
        $res = $dbh->getQuery($sql);
        $rows=$res->fetchAll();
        
        $sql = "INSERT INTO `mismatch_response` (user_id, topic_id) " .
               "VALUES(:user, :topic_id);";
        $stmt =  $con->prepare($sql); 
        foreach($rows as $row){
            $topic = $row['topic_id'];
            $params = array(':topic_id' => $topic,
                           ':user' => $user_id,
                           );
            $stmt->execute($params);
        }
    } 

    if(isset($_POST['submit'])){
        $sql = "UPDATE  `mismatch_response` SET 
        response = :response WHERE topic_id = :topic_id AND user_id = :user ";
        $stmt =  $con->prepare($sql);        
        
        foreach($_POST as $key =>$value){
            if($key!='submit'){
                $params = array(':topic_id' => $key,
                                ':user' => $user_id,
                                ':response'=>$value,
                                );
                $stmt->execute($params);
            }
        }
    }
?>
<div class ="container">
  <div class="row">
      <form class="formquestionarie mt30" action="<?php echo($_SERVER['PHP_SELF'])?>" method="POST">
        <?php
          $sql = "SELECT * FROM mismatch_category";
          $resultSet = $dbh->getQuery($sql);
          $categories = $resultSet->fetchAll();
          foreach($categories as $category){  //POR CADA CATEGORIA
            echo("<fieldset>");
              echo("<legend>" . $category['name'] . "</legend>");
              echo"<div class='col-md-2'></div>";
              echo"<div class='col-md-8'>";
              echo(   func::getInputsTopics($category['category_id'],$_SESSION['user_id'], $con));
              echo "</div>";
            echo("</fieldset>");
          }
        ?>
        <div class="submit">
            <input type="submit" class="btn btn-success" value="submit" name="submit"/>
        </div>
      </form>
    </div>
      <div class='col-md-1'></div>
       <div class='col-md-1'></div>

  
</div>  