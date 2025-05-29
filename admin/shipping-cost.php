<?php require_once('header.php'); ?>

<?php

if(isset($_POST['form1'])) {
    
  
    $valid = 1;

    if(empty($_POST['country_id'])) {
        $valid = 0;
        $error_message .= 'Seleciona uma Provincia.<br>';
    }
    if(empty($_POST['municipio_id'])) {
        $valid = 0;
        $error_message .= 'Seleciona um Municipio.<br>';
    }
    
    if(empty($_POST['bairro_id'])) {
        $valid = 0;
        $error_message .= 'Seleciona um Bairro.<br>';
    }
    

    if($_POST['amount'] == '') {
        $valid = 0;
        $error_message .= 'O valor não pode estar vazio.<br>';
    } else {
        if(!is_numeric($_POST['amount'])) {
            $valid = 0;
            $error_message .= 'Digita um valor válido.<br>';
        }
    }

    if($valid == 1) {
        $statement = $pdo->prepare("INSERT INTO tbl_shipping_cost (country_id,municipio_id,bairro_id,amount) VALUES (?,?,?,?)");
        $statement->execute(array($_POST['country_id'],$_POST['municipio_id'],$_POST['bairro_id'],$_POST['amount']));

        $success_message = 'Custo de Envio Atualizado com sucesso.';
    }

}


if(isset($_POST['form2'])) {
    $valid = 1;

    if($_POST['amount'] == '') {
        $valid = 0;
        $error_message .= 'O valor não pode estar vazio.<br>';
    } else {
        if(!is_numeric($_POST['amount'])) {
            $valid = 0;
            $error_message .= 'Você deve inserir um número válido.<br>';
        }
    }

    if($valid == 1) {

        $statement = $pdo->prepare("UPDATE tbl_shipping_cost_all SET amount=? WHERE sca_id=1");
        $statement->execute(array($_POST['amount']));

        $success_message = 'O custo de envio para o resto do mundo foi atualizado com sucesso.';

    }
}
?>


<section class="content-header">
    <div class="content-header-left">
        <h1>Adicionar custo de envio</h1>
    </div>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-12">

            <?php if($error_message): ?>
            <div class="callout callout-danger">
            
            <p>
            <?php echo $error_message; ?>
            </p>
            </div>
            <?php endif; ?>

            <?php if($success_message): ?>
            <div class="callout callout-success">
            
            <p><?php echo $success_message; ?></p>
            </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post">

                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Seleciona a Provincia <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="country_id" class="form-control select2">
                                    <option value="">Seleciona a Provincia</option>
                                    <?php
                                    $statement = $pdo->prepare("SELECT * FROM tbl_country ORDER BY country_name ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {

                                        /*$statement = $pdo->prepare("SELECT * FROM tbl_shipping_cost WHERE country_id=?");
                                        //$statement->execute(array($row['country_id']));
                                        //$total = $statement->rowCount();
                                       // if($total) {
                                        //    continue;
                                        //}*/

                                        ?>
                                        <option value="<?php echo $row['country_id']; ?>"><?php echo $row['country_name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            
                             <label for="" class="col-sm-2 control-label">Seleciona o Municipio <span>*</span></label>
                            <div class="col-sm-4">
                                <select name="municipio_id" class="form-control select2">
                                    <option value="">Seleciona o Municipio</option>
                                    <?php
                                    $statement = $pdo->prepare("SELECT * FROM tbl_municipio ORDER BY nome ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {

                                        ?>
                                        <option value="<?php echo $row['municipio_id']; ?>"><?php echo $row['nome']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <label for="" class="col-sm-2 control-label my-3" style="margin-top:2rem;">Seleciona o Bairro <span>*</span></label>
                            <div class="col-sm-4 my-3" style="margin-top:2rem;">
                                <select name="bairro_id" class="form-control select2">
                                    <option value="">Seleciona o Bairro</option>
                                    <?php
                                    $statement = $pdo->prepare("SELECT * FROM tbl_bairro ORDER BY nome_bairro ASC");
                                    $statement->execute();
                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {

                                        ?>
                                        <option value="<?php echo $row['bairro_id']; ?>"><?php echo $row['nome_bairro']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Valor<span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="amount">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Adicionar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>


        </div>
    </div>
</section>




<section class="content-header">
	<div class="content-header-left">
		<h1>Ver custos de envio</h1>
	</div>
</section>


<section class="content">

  <div class="row">
    <div class="col-md-12">


      <div class="box box-info">
        
        <div class="box-body table-responsive">
          <table id="example1" class="table table-bordered table-hover table-striped">
			<thead>
			    <tr>
			        <th>#</th>
			        <th>Nome da Provincia</th>
			        <th>Nome do Municipio</th>
			        <th>Nome do Bairro</th>
                    <th>Valor de custo de envio</th>
			        <th>Ação</th>
			    </tr>
			</thead>
            <tbody>
            	<?php
            	$i=0;
            	$statement = $pdo->prepare("SELECT * 
                                        FROM tbl_shipping_cost t1
                                        JOIN tbl_country t2 
                                        ON t1.country_id = t2.country_id JOIN tbl_municipio t3 ON t1.municipio_id = t3.municipio_id JOIN tbl_bairro t4 ON t1.bairro_id = t4.bairro_id 
                                        ORDER BY t2.country_name ASC");
            	$statement->execute();
            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);	
            	
            	foreach ($result as $row) {
            	   
            		$i++;
            		?>
					<tr>
	                    <td><?php echo $i; ?></td>
	                    <td><?php echo $row['country_name']; ?></td>
	                    <td><?php echo $row['nome']; ?></td>
	                    <td><?php echo $row['nome_bairro']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
	                    <td>
	                        <a href="shipping-cost-edit.php?id=<?php echo $row['shipping_cost_id']; ?>" class="btn btn-primary btn-xs">Editar</a>
	                        <a href="#" class="btn btn-danger btn-xs" data-href="shipping-cost-delete.php?id=<?php echo $row['shipping_cost_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Apagar</a>
	                    </td>
	                </tr>
            		<?php
            	}
            	?>
            </tbody>
          </table>
        </div>
      </div> 

      <h4 style="background: #dd4b39;color:#fff;padding:10px 20px;">NB: Se uma provincia não existir na lista acima, o seguinte custo de envio "Resto de Angola" será aplicado a ele.</h4>

</section>


<section class="content-header">
    <div class="content-header-left">
        <h1>Custo de envio (resto de Angola)</h1>
    </div>
</section>

<section class="content">

    <?php
    $statement = $pdo->prepare("SELECT * FROM tbl_shipping_cost_all WHERE sca_id=1");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);                            
    foreach ($result as $row) {
        $amount = $row['amount'];
    }
    ?>

    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="" method="post">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Valor <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="amount" value="<?php echo $amount; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form2">Atualizar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Excluir confirmação</h4>
            </div>
            <div class="modal-body">
               Tem certeza de que deseja excluir este item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok">Apagar</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>