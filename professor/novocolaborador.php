<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style>
body table{
	font:13px Arial, Helvetica, sans-serif;
	}
#container_tuod{
	background:#FFF;
}
</style>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container_tuod">
    <div class="container">
      <div class="row" style="font:10px Arial, Helvetica, sans-serif;">
        <div class="col-sm">
         <p class="h6 text-primary"><strong><br>
         Novo colaborador</strong></p>
         <hr />
          
          <? if(@$_GET['etapa'] == ''){ ?>
			   <? if(isset($_POST['avancar'])){
                   
                $cpf = $_POST['cpf'];
                
                $sql_cpf = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '$cpf'");
                if(mysqli_num_rows($sql_cpf) >= 1){
                  echo "<div class='alert alert-danger' role='alert'>O coladorador $cpf já tem cadastro nesta instituição!</div>";
                }else{
                  echo "<script language='javascript'>window.location='?p=novocolaborador&etapa=2&cpf=$cpf';</script>";
                }
                
                
               
               }?>
<form name="" method="post" action="" enctype="multipart/form-data">
                 <span id="sprytextfield1">
                 <input type="text" name="cpf" class="form-control form-control-lg" style="width:500px; float:left;" placeholder="Digite o CPF: 000.000.000-00"  />
                 <span class="textfieldInvalidFormatMsg"></span></span>
                 <input name="avancar" type="submit" class="btn btn-primary mb-2" style="padding:10px; float:left; margin:0 0 0 5px;" value="Avançar">
                </form>
		  <? } ?>
          
          
          <? if(@$_GET['etapa'] == '2'){ ?>
          
          
          <? if(isset($_POST['cadastrar'])){
			  
			  $nome = $_POST['nome'];
			  $cpf = $_GET['cpf'];
			  $nascimento = $_POST['nascimento'];
			  $sexo = $_POST['sexo'];
			  $rg = $_POST['rg'];
			  $rg_expedicao = $_POST['rg_expedicao'];
			  $rg_expeditor = $_POST['rg_expeditor'];
			  $rg_uf = $_POST['rg_uf'];
			  $pai = $_POST['pai'];
			  $mae = $_POST['mae'];
			  $estado_civil = $_POST['estado_civil'];
			  $conjuge = $_POST['conjuge'];
			  $nascionalidade = $_POST['nascionalidade'];
			  $uf_nascimento = $_POST['uf_nascimento'];
			  $cidade_nascimento = $_POST['cidade_nascimento'];
			  $etnia = $_POST['etnia'];
			  $escolaridade = $_POST['escolaridade'];
			  $titulo = $_POST['titulo'];
			  $titulo_emissao = $_POST['titulo_emissao'];
			  $zona = $_POST['zona'];
			  $sessao = $_POST['sessao'];
			  $reservista = $_POST['reservista'];
			  $carteira_trabalho = $_POST['carteira_trabalho'];
			  $pis = $_POST['pis'];
			  $endereco = $_POST['endereco'];
			  $n_endereco = $_POST['n_endereco'];
			  $cep = $_POST['cep'];
			  $bairro = $_POST['bairro'];
			  $cidade = $_POST['cidade'];
			  $uf_moradia = $_POST['uf_moradia'];
			  $tipo_moradia = $_POST['tipo_moradia'];
			  $tempo_moradia = $_POST['tempo_moradia'];
			  
			  $n_serie = $_POST['n_serie'];
			  $estado_emissor_carteira = $_POST['estado_emissor_carteira'];
			  $emissor_emissor_carteira = $_POST['emissor_emissor_carteira'];
			  
			  
          		
                $sql_cpf = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '$cpf'");
                if(mysqli_num_rows($sql_cpf) >= 1){
                     
					 $sql_atualiza = mysqli_query($conexao_bd, "UPDATE coladorares SET nome = '$nome', nascimento = '$nascimento', sexo = '$sexo', rg = '$rg', rg_expedicao = '$rg_expedicao', rg_expeditor = '$rg_expeditor', rg_uf = '$rg_uf', pai = '$pai', mae = '$mae', estado_civil = '$estado_civil', conjuge = '$conjuge', nascionalidade = '$nascionalidade', uf_nascimento = '$uf_nascimento', cidade_nascimento = '$cidade_nascimento', etnia = '$etnia', escolaridade = '$escolaridade', titulo = '$titulo', titulo_emissao = '$titulo_emissao', zona = '$zona', sessao = '$sessao', reservista = '$reservista', carteira_trabalho = '$carteira_trabalho', pis = '$pis', endereco = '$endereco', n_endereco = '$n_endereco', cep = '$cep', bairro = '$bairro', cidade = '$cidade', uf_moradia = '$uf_moradia', tipo_moradia = '$tipo_moradia', tempo_moradia = '$tempo_moradia', n_serie = '$n_serie', estado_emissor_carteira = '$estado_emissor_carteira', emissor_emissor_carteira = '$emissor_emissor_carteira' WHERE cpf = '$cpf'");
					 
                  echo "<script language='javascript'>window.alert('Cadastro atualizado com sucesso!');window.location='?p=mostra_colaboradores';</script>";


                }else{
					
					$sql_cadastra = mysqli_query($conexao_bd, "INSERT INTO coladorares (status, cpf, escola, nome, nascimento, sexo, rg, rg_expedicao, rg_expeditor, rg_uf, pai, mae, estado_civil, conjuge, nascionalidade, uf_nascimento, cidade_nascimento, etnia, escolaridade, titulo, titulo_emissao, zona, sessao, reservista, carteira_trabalho, pis, endereco, n_endereco, cep, bairro, cidade, uf_moradia, tipo_moradia, tempo_moradia, n_serie, estado_emissor_carteira, emissor_emissor_carteira) VALUES ('Ativo', '$cpf', '$escola', '$nome', '$nascimento', '$sexo', '$rg', '$rg_expedicao', '$rg_expeditor', '$rg_uf', '$pai', '$mae', '$estado_civil', '$conjuge', '$nascionalidade', '$uf_nascimento', '$cidade_nascimento', '$etnia', '$escolaridade', '$titulo', '$titulo_emissao', '$zona', '$sessao', '$reservista', '$carteira_trabalho', '$pis', '$endereco', '$n_endereco', '$cep', '$bairro', '$cidade', '$uf_moradia', '$tipo_moradia', '$tempo_moradia', '$n_serie', '$estado_emissor_carteira', '$emissor_emissor_carteira')");
					
                  echo "<script language='javascript'>window.alert('Cadastro efetuado com sucesso!');window.location='?p=mostra_colaboradores';</script>";
                }
                				
				
		  
		  }?>
          
          
          
          
          
          
          <? 
		   $cpf = $_GET['cpf'];
           $sql = mysqli_query($conexao_bd, "SELECT * FROM coladorares WHERE cpf = '$cpf'");
		     while($res_sql = mysqli_fetch_array($sql)){
			 
			  $nomes = $res_sql['nome'];
			  $nascimento = $res_sql['nascimento'];
			  $sexo = $res_sql['sexo'];
			  $rg = $res_sql['rg'];
			  $rg_expedicao = $res_sql['rg_expedicao'];
			  $rg_expeditor = $res_sql['rg_expeditor'];
			  $rg_uf = $res_sql['rg_uf'];
			  $pai = $res_sql['pai'];
			  $mae = $res_sql['mae'];
			  $estado_civil = $res_sql['estado_civil'];
			  $conjuge = $res_sql['conjuge'];
			  $nascionalidade = $res_sql['nascionalidade'];
			  $uf_nascimento = $res_sql['uf_nascimento'];
			  $cidade_nascimento = $res_sql['cidade_nascimento'];
			  $etnia = $res_sql['etnia'];
			  $escolaridade = $res_sql['escolaridade'];
			  $titulo = $res_sql['titulo'];
			  $titulo_emissao = $res_sql['titulo_emissao'];
			  $zona = $res_sql['zona'];
			  $sessao = $res_sql['sessao'];
			  $reservista = $res_sql['reservista'];
			  $carteira_trabalho = $res_sql['carteira_trabalho'];
			  $pis = $res_sql['pis'];
			  $endereco = $res_sql['endereco'];
			  $n_endereco = $res_sql['n_endereco'];
			  $cep = $res_sql['cep'];
			  $bairro = $res_sql['bairro'];
			  $cidade = $res_sql['cidade'];
			  $uf_moradia = $res_sql['uf_moradia'];
			  $tipo_moradia = $res_sql['tipo_moradia'];
			  $tempo_moradia = $res_sql['tempo_moradia'];

			  
			  $n_serie = $res_sql['n_serie'];
			  $estado_emissor_carteira = $res_sql['estado_emissor_carteira'];
			  $emissor_emissor_carteira = $res_sql['emissor_emissor_carteira'];			 
			 
			 }
		  ?>
          
          
          
          
 		   <form name="" method="post" action="" enctype="multipart/form-data">
            <table width="1000" border="1" class="table">
             <thead class="thead-dark">
              <tr>
                <th  width="230">Nome completo</th>
                <th  width="202">CPF</th>
                <th colspan="2">Data de nascimento</th>
                <th  colspan="2">Sexo</th>
              </tr>
              <tr>
                <td><input type="text" class="form-control" name="nome" value="<? echo $nomes; ?>"></td>
                <td><input name="cpf" type="text" class="form-control" value="<? echo $_GET['cpf']; ?>" disabled id="cpf"></td>
                <td colspan="2">
                  <span id="sprytextfield2">
                  <input type="text" name="nascimento" value="<? echo $nascimento; ?>" class="form-control" id="textfield2" />
                <span class="textfieldRequiredMsg"></span></span></td>
                <td colspan="2"><select name="sexo" size="1" class="form-control" id="sexo">
                  <option value="<? echo $sexo; ?>"><? echo $sexo; ?></option>
                  <option value="Femenino">Femenino</option>
                  <option value="Masculino">Masculino</option>
                </select></td>
              </tr>
              <tr>
                <th>RG</th>
                <th>Data de expedição</th>
                <th colspan="2">Orgão expeditor</th>
                <th colspan="2">UF de expedição</th>
              </tr>
              <tr>
                <td>
                <input type="text" name="rg" class="form-control" value="<? echo $rg; ?>" /></td>
                <td><span id="sprytextfield3">
                <input type="text" class="form-control" name="rg_expedicao" value="<? echo $rg_expedicao; ?>" />
</span></td>
                <td colspan="2">
                  <select name="rg_expeditor" size="1" class="form-control">
                    <option value="<? echo $rg_expeditor; ?>"><? echo $rg_expeditor; ?></option>
                    <option value="SSP">SSP</option>
                    <option value="MARINHA">MARINHA</option>
                </select></td>
                <td colspan="2">
                  <select name="rg_uf" size="1" class="form-control">
                    <option value="<? echo $rg_uf; ?>"><? echo $rg_uf; ?></option>
                    <option value="Acre">Acre</option>
                    <option value="Alagoas">Alagoas</option>
                    <option value="Amap&aacute;">Amap&aacute;</option>
                    <option value="Amazonas">Amazonas</option>
                    <option value="Bahia">Bahia</option>
                    <option value="Cear&aacute;">Cear&aacute;</option>
                    <option value="Esp&iacute;rito Santo">Esp&iacute;rito Santo</option>
                    <option value="Goi&aacute;s">Goi&aacute;s</option>
                    <option value="Maranh&atilde;o">Maranh&atilde;o</option>
                    <option value="Mato Grosso">Mato Grosso</option>
                    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                    <option value="Minas Gerais">Minas Gerais</option>
                    <option value="Par&aacute;">Par&aacute;</option>
                    <option value="Para&iacute;ba">Para&iacute;ba</option>
                    <option value="Paran&aacute;">Paran&aacute;</option>
                    <option value="Pernambuco">Pernambuco</option>
                    <option value="Piau&iacute;">Piau&iacute;</option>
                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                    <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                    <option value="Rond&ocirc;nia">Rond&ocirc;nia</option>
                    <option value="Roraima">Roraima</option>
                    <option value="Santa Catarina">Santa Catarina</option>
                    <option value="S&atilde;o Paulo">S&atilde;o Paulo</option>
                    <option value="Sergipe">Sergipe</option>
                    <option value="Tocantins">Tocantins</option>
                    <option value="Distrito Federal">Distrito Federal</option>
                </select></td>
              </tr>
              <tr>
                <th>Nome do pai</th>
                <th>Nome da mãe</th>
                <th colspan="2">Estado cívil</th>
                <th colspan="2">C&ocirc;njuge</th>
              </tr>
              <tr>
                <td><input type="text" class="form-control" name="pai" value="<? echo $pai; ?>"/></td>
                <td><input type="text" class="form-control" name="mae" value="<? echo $mae; ?>" /></td>
                <td colspan="2">
                  <select name="estado_civil" size="1" class="form-control">
                    <option value="<? echo $estado_civil; ?>"><? echo $estado_civil; ?>s</option>
                    <option value="Casado">Casado</option>
                    <option value="Divorciado">Divorciado</option>
                    <option value="Solteiro">Solteiro</option>
                    <option value="Separado">Separado</option>
                    <option value="Vi&uacute;vo">Vi&uacute;vo</option>
                </select></td>
                <td colspan="2">
                <input type="text" name="conjuge" class="form-control" value="<? echo $conjuge; ?>"/></td>
              </tr>
              <tr>
                <th>Nacionalidade</th>
                <th>Estado de nascimento</th>
                <th colspan="2">Cidade de Nascimento</th>
                <th colspan="2">Cor/Ra&ccedil;a</th>
              </tr>
              <tr>
                <td>
                  <select name="nascionalidade" size="1" class="form-control">
                    <option value="<? echo $nascionalidade; ?>"><? echo $nascionalidade; ?></option>
                    <option value="Brasileira">Brasileira</option>
                    <option value="Estrangeira">Estrangeira</option>
                </select></td>
                <td><select name="uf_nascimento" size="1" class="form-control">
                  <option value="<? echo $uf_nascimento; ?>"><? echo $uf_nascimento; ?></option>
                  <option value="Acre">Acre</option>
                  <option value="Alagoas">Alagoas</option>
                  <option value="Amap&aacute;">Amap&aacute;</option>
                  <option value="Amazonas">Amazonas</option>
                  <option value="Bahia">Bahia</option>
                  <option value="Cear&aacute;">Cear&aacute;</option>
                  <option value="Esp&iacute;rito Santo">Esp&iacute;rito Santo</option>
                  <option value="Goi&aacute;s">Goi&aacute;s</option>
                  <option value="Maranh&atilde;o">Maranh&atilde;o</option>
                  <option value="Mato Grosso">Mato Grosso</option>
                  <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                  <option value="Minas Gerais">Minas Gerais</option>
                  <option value="Par&aacute;">Par&aacute;</option>
                  <option value="Para&iacute;ba">Para&iacute;ba</option>
                  <option value="Paran&aacute;">Paran&aacute;</option>
                  <option value="Pernambuco">Pernambuco</option>
                  <option value="Piau&iacute;">Piau&iacute;</option>
                  <option value="Rio de Janeiro">Rio de Janeiro</option>
                  <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                  <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                  <option value="Rond&ocirc;nia">Rond&ocirc;nia</option>
                  <option value="Roraima">Roraima</option>
                  <option value="Santa Catarina">Santa Catarina</option>
                  <option value="S&atilde;o Paulo">S&atilde;o Paulo</option>
                  <option value="Sergipe">Sergipe</option>
                  <option value="Tocantins">Tocantins</option>
                  <option value="Distrito Federal">Distrito Federal</option>
                </select></td>
                <td colspan="2"><input type="text" class="form-control" name="cidade_nascimento" value="<? echo $cidade_nascimento; ?>" /></td>
                <td colspan="2"><select name="etnia" size="1" class="form-control">
                  <option value="<? echo $etnia; ?>"><? echo $etnia; ?></option>
                  <option value="Amarelo">Amarelo</option>
                  <option value="Branco">Branco</option>
                  <option value="Ind&iacute;gena">Ind&iacute;gena</option>
                  <option value="Negro">Negro</option>
                  <option value="Pardo">Pardo</option>
                </select></td>
              </tr>
              <tr>
                <th>Escolaridade</th>
                <th>Titulo de eleitor</th>
                <th colspan="2">Data de emissão</th>
                <th width="146">Zona</th>
                <th width="153">Sessão</th>
              </tr>
              <tr>
                <td>
                  <select name="escolaridade" size="1" class="form-control">
                    <option value="<? echo $escolaridade; ?>"><? echo $escolaridade; ?></option>
                    <option value="Sem escolariza&ccedil;&atilde;o">Sem escolariza&ccedil;&atilde;o</option>
                    <option value="Ensino fundamental completo">Ensino fundamental completo</option>
                    <option value="Ensino fundamental imcompleto">Ensino fundamental imcompleto</option>
                    <option value="Ensino m&eacute;dio completo">Ensino m&eacute;dio completo</option>
                    <option value="Ensino m&eacute;dio incompleto">Ensino m&eacute;dio incompleto</option>
                    <option value="Gradua&ccedil;&atilde;o completa">Gradua&ccedil;&atilde;o completa</option>
                    <option value="Gradua&ccedil;&atilde;o incompleta">Gradua&ccedil;&atilde;o incompleta</option>
                    <option value="P&oacute;s-gradua&ccedil;&atilde;o incompleta">P&oacute;s-gradua&ccedil;&atilde;o incompleta</option>
                    <option value="P&oacute;s-gradua&ccedil;&atilde;o completa">P&oacute;s-gradua&ccedil;&atilde;o completa</option>
                    <option value="Mestrado completo">Mestrado completo</option>
                    <option value="Mestrado incompleto">Mestrado incompleto</option>
                    <option value="Doutorado completo">Doutorado completo</option>
                    <option value="Doutorado incompleto">Doutorado incompleto</option>
                </select></td>
                <td><span id="sprytextfield4">
                <input type="text" class="form-control" name="titulo" value="<? echo $titulo; ?>" />
</span></td>
                <td colspan="2"><span id="sprytextfield5">
                <input type="text" class="form-control" name="titulo_emissao" value="<? echo $titulo_emissao; ?>" />
                <span class="textfieldRequiredMsg"></span></span></td>
                <td><input name="zona" type="text" class="form-control" id="zona" size="10" maxlength="4" value="<? echo $zona; ?>" /></td>
                <td><input name="sessao" type="text" class="form-control" id="sessao" size="10" maxlength="4" value="<? echo $sessao; ?>" /></td>
              </tr>
              <tr>
                <th>Reservista</th>
                <th bgcolor="#CCCCCC">N&deg; Cateira de trabalho</th>
                <th width="126" bgcolor="#CCCCCC">N&deg; S&eacute;rie </th>
                <th width="103" bgcolor="#CCCCCC">Estado Emissor</th>
                <th bgcolor="#CCCCCC">Org&atilde;o Emissor</th>
                <th>N&deg; PIS/PASEP</th>
              </tr>
              <tr>
                <td><input type="text" class="form-control" name="reservista" value="<? echo $reservista; ?>" /></td>
                <td>
                <input type="text" class="form-control" name="carteira_trabalho" value="<? echo $carteira_trabalho; ?>" /></td>
                <td>
                <input name="n_serie" type="text" id="n_serie" size="5" class="form-control" value="<? echo $n_serie; ?>" /></td>
                <td><select name="estado_emissor_carteira" size="1" class="form-control" id="estado_emissor_carteira">
                  <option value="<? echo $estado_emissor_carteira; ?>"><? echo $estado_emissor_carteira; ?></option>
                  <option value="Acre">Acre</option>
                  <option value="Alagoas">Alagoas</option>
                  <option value="Amap&aacute;">Amap&aacute;</option>
                  <option value="Amazonas">Amazonas</option>
                  <option value="Bahia">Bahia</option>
                  <option value="Cear&aacute;">Cear&aacute;</option>
                  <option value="Esp&iacute;rito Santo">Esp&iacute;rito Santo</option>
                  <option value="Goi&aacute;s">Goi&aacute;s</option>
                  <option value="Maranh&atilde;o">Maranh&atilde;o</option>
                  <option value="Mato Grosso">Mato Grosso</option>
                  <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                  <option value="Minas Gerais">Minas Gerais</option>
                  <option value="Par&aacute;">Par&aacute;</option>
                  <option value="Para&iacute;ba">Para&iacute;ba</option>
                  <option value="Paran&aacute;">Paran&aacute;</option>
                  <option value="Pernambuco">Pernambuco</option>
                  <option value="Piau&iacute;">Piau&iacute;</option>
                  <option value="Rio de Janeiro">Rio de Janeiro</option>
                  <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                  <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                  <option value="Rond&ocirc;nia">Rond&ocirc;nia</option>
                  <option value="Roraima">Roraima</option>
                  <option value="Santa Catarina">Santa Catarina</option>
                  <option value="S&atilde;o Paulo">S&atilde;o Paulo</option>
                  <option value="Sergipe">Sergipe</option>
                  <option value="Tocantins">Tocantins</option>
                  <option value="Distrito Federal">Distrito Federal</option>
                </select></td>
                <td>
                  <select name="emissor_emissor_carteira" size="1" class="form-control">
                  <option value="<? echo $emissor_emissor_carteira; ?>"><? echo $emissor_emissor_carteira; ?></option>
                    <option value="SINE">SINE</option>
                </select></td>
                <td><input type="text" class="form-control" name="pis" id="pis" value="<? echo $pis; ?>" /></td>
              </tr>
              <tr>
                <td colspan="6" bgcolor="#33CC33">DADOS DE RESID&Ecirc;NCIA</td>
              </tr>
              <tr>
                <th colspan="2">Endereço</th>
                <th colspan="2">N°</th>
                <th>CEP</th>
                <th>Bairro</th>
              </tr>
              <tr>
                <td colspan="2"><input type="text" class="form-control" name="endereco" value="<? echo $endereco; ?>" /></td>
                <td colspan="2"><input name="n_endereco" type="text" class="form-control" value="<? echo $n_endereco; ?>" size="10" maxlength="4" /></td>
                <td><span id="sprytextfield6">
                  <input type="text" class="form-control" name="cep" value="<? echo $cep; ?>"/>
                </span></td>
                <td><input type="text" class="form-control" name="bairro" value="<? echo $bairro; ?>"/></td>
              </tr>
              <tr>
                <th>Cidade</th>
                <th>Estado</th>
                <th colspan="2">Tipo de moradia</th>
                <th>Tempo de moradia</th>
                <th>&nbsp;</th>
              </tr>
              <tr>
                <td><input type="text" class="form-control" name="cidade"  value="<? echo $cidade; ?>"/></td>
                <td><select name="uf_moradia" size="1" class="form-control">
                  <option value="<? echo $uf_moradia; ?>"><? echo $uf_moradia; ?></option>
                  <option value="Acre">Acre</option>
                  <option value="Alagoas">Alagoas</option>
                  <option value="Amap&aacute;">Amap&aacute;</option>
                  <option value="Amazonas">Amazonas</option>
                  <option value="Bahia">Bahia</option>
                  <option value="Cear&aacute;">Cear&aacute;</option>
                  <option value="Esp&iacute;rito Santo">Esp&iacute;rito Santo</option>
                  <option value="Goi&aacute;s">Goi&aacute;s</option>
                  <option value="Maranh&atilde;o">Maranh&atilde;o</option>
                  <option value="Mato Grosso">Mato Grosso</option>
                  <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                  <option value="Minas Gerais">Minas Gerais</option>
                  <option value="Par&aacute;">Par&aacute;</option>
                  <option value="Para&iacute;ba">Para&iacute;ba</option>
                  <option value="Paran&aacute;">Paran&aacute;</option>
                  <option value="Pernambuco">Pernambuco</option>
                  <option value="Piau&iacute;">Piau&iacute;</option>
                  <option value="Rio de Janeiro">Rio de Janeiro</option>
                  <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                  <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                  <option value="Rond&ocirc;nia">Rond&ocirc;nia</option>
                  <option value="Roraima">Roraima</option>
                  <option value="Santa Catarina">Santa Catarina</option>
                  <option value="S&atilde;o Paulo">S&atilde;o Paulo</option>
                  <option value="Sergipe">Sergipe</option>
                  <option value="Tocantins">Tocantins</option>
                  <option value="Distrito Federal">Distrito Federal</option>
                </select></td>
                <td colspan="2"><select name="tipo_moradia" size="1" class="form-control" value="<? echo $tipo_moradia; ?>"/>
                  <option value="<? echo $tipo_moradia; ?>"><? echo $tipo_moradia; ?></option>
                  <option value="Pr&oacute;pria">Pr&oacute;pria</option>
                  <option value="Alugada">Alugada</option>
                  <option value="Cedida">Cedida</option>
                  <option value="Familiar">Familiar</option>
                  <option value="N&atilde;o informado">N&atilde;o informado</option>                
                </select></td>
                <td><span id="sprytextfield7">
                  <input class="form-control"type="text" name="tempo_moradia" value="<? echo $tempo_moradia; ?>"/>
</span></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="6" align="center"><input type="submit" name="cadastrar" class="btn btn-primary" value="Finalizar"></td>
              </tr>
             </thead>
            </table>
		   </form>

		  <? } ?>
          
          
        </div><!-- col-sm -->
      </div><!-- row -->
    </div><!-- container -->
</div><!-- container_tuod -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {validateOn:["blur"], pattern:"000.000.000-00", useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "custom", {useCharacterMasking:true, pattern:"0000 0000 0000", isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "custom", {useCharacterMasking:true, isRequired:false, pattern:"00000-000"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "custom", {pattern:"00/0000", useCharacterMasking:true, isRequired:false});
</script>
</body>
</html>