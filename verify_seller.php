<?php require_once('header.php'); ?>

<?php
if ( (!isset($_GET['email'])) || (isset($_GET['token'])) )
{
    $var = 1;

    // check if the token is correct and match with database.
    $statement = $pdo->prepare("SELECT * FROM tbl_user WHERE email=?");
    $statement->execute(array($_GET['email']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
    foreach ($result as $row) {
        if($_GET['token'] != $row['token']) {
            header('location: '.BASE_URL);
            exit;
        }
    }

    // everything is correct. now activate the user removing token value from database.
    if($var != 0)
    {
        $statement = $pdo->prepare("UPDATE tbl_user SET token=?, status=? WHERE email=?");
        $statement->execute(array('','Active',$_GET['email']));

        $success_message = '<p style="color:green;">Seu e-mail foi verificado com sucesso. Agora você pode fazer login em nosso site.</p><p><a href="'.URLADMIN.'login.php" style="color:#167ac6;font-weight:bold;">Click here to login</a></p>';     
    }
}
?>

<div class="page-banner" style="background-color:#444;">
    <div class="inner">
        <h1>Registro bem-sucedido</h1>
    </div>
</div>

<div class="page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="user-content">
                    <?php 
                        echo $error_message;
                        echo $success_message;
                    ?>
                </div>                
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>