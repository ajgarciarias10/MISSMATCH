
<?php
require_once ('DBSettings.php');
require_once ('header.php');
require_once ('function.php');
ini_set('display_errors', 1);
if (!func::checklogin($con))
{

}
?>
<?php
$booleana = false;
$respuestas = array();
$sqlquery = "SELECT * FROM `mismatch_response` INNER JOIN `mismatch_topic` ON mismatch_response.topic_id = mismatch_topic.topic_id WHERE user_id = :id";
$stmt = $con->prepare($sqlquery);
$stmt->execute(array(
    'id' => $_SESSION['user_id']
));

while ($row = $stmt->fetch())
{

    array_push($respuestas, $row);

    if ($row['response'] > 0)
    {
        $booleana = true;
    }

}

if ($booleana)
{
    $contadorDiscordancias = 0;
    $iduser = - 1;
    $discordancias = array();

    $sql = "SELECT user_id FROM `mismatch_response` WHERE user_id !=" . $_SESSION['user_id'] . " AND user_id != 1 GROUP BY user_id";
    $users = $dbh->getQuery($sql);

    foreach ($users as $rowUser)
    {

        $sql = "SELECT * FROM `mismatch_response`  WHERE  user_id =" . $rowUser['user_id'] . "";
        $resultset = $dbh->getQuery($sql);

        $respuestasOtherUsers = array();
        while ($rowResponses = $resultset->fetch(PDO::FETCH_ASSOC))
        {

            array_push($respuestasOtherUsers, $rowResponses);

        }

        $count = 0;
        $auxtopixs = array();

        for ($i = 0;$i < count($respuestas);$i++)
        {

            $countAux = $respuestas[$i]['response'] + $respuestasOtherUsers[$i]['response'];

            if ($countAux == 3)
            {

                $count++;
                array_push($auxtopixs, $respuestas[$i]['name']);

                if ($count >= $contadorDiscordancias)
                {

                    $contadorDiscordancias = $count;
                    $iduser = $respuestasOtherUsers[$i]['user_id'];

                    if (!empty($discordancias))
                    {
                        unset($discordancias);
                        $discordancias = array();
                    }
                    foreach ($auxtopixs as $nombrediscordanciadiscordante)
                    {
                        array_push($discordancias, $nombrediscordanciadiscordante);

                    }

                }

            }

        }

    }

    if ($iduser == - 1)
    {

    }
    else
    {

        $sql2 = "SELECT * FROM users WHERE user_id = " . $iduser . "";
        $resulset2 = $dbh->getQuery($sql2);

        $user = $resulset2->fetch(PDO::FETCH_ASSOC);

        if (empty($user['user_picture']))
        {

        }
        else
        {
            $img = $user['user_picture'];
        }

        $userfirstname = $user['user_firstname'];
        $userlastname = $user['user_lastname'];
        $usercity = $user['user_city'];
        $userstate = $user['user_state'];

?>
<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <div class="card p-3 py-1">
                <div class="text-center"> <img src='images/<?php echo $img?>'  width="100" class="rounded-circle"> </div>
                <div class="text-center mt-3"> <span class="bg-secondary p-1 px-4 rounded text-white"> <?php echo $userfirstname ?></span>
                    <h5 class="mt-2 mb-0"> <?php echo $userlastname ?></h5>
                    <?php 
                     echo "<a href='profile.php?user_id=" . $iduser . "' class='btn btn-primary'>View Profile</a>"
                                        ?>
               
                         
                    <div class="px-4 mt-1">
                        <p class="fonts"> 
                          
                          <?php
                                foreach ($discordancias as $nombrediscordancia)
                                {
                        ?>
                        
                                                 
                                                 &nbsp;
                                                <?php echo $nombrediscordancia ?>
                                               
                                                          
                                                    <?php
                                }
                        
                            }
                        ?>
                         </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
else
{
    echo ' <h1> You have to fill the <a href="question.php">questionnaire</a> to find your mismatch<h1>';
}

?>

<?php require_once("footer.php");?>
