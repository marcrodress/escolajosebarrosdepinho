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
  		<p></p>
        <p class="h5 text-primary"><strong>Cadastrar novo aluno</strong></p>
         
          <? if(@$_GET['etapa'] == ''){ ?>
			   <? if(isset($_POST['avancar'])){
                   
                $nome_aluno = $_POST['nome_aluno'];
                
                $sql_cpf = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE nome_aluno = '$nome_aluno'");
                if(mysqli_num_rows($sql_cpf) >= 1){
                  echo "<div class='alert alert-danger' role='alert'>O aluno $nome_aluno já tem cadastro nesta instituição!</div>";
                }else{
					$aluno = rand()*date("d")+date("d");
					

					mysqli_query($conexao_bd, "INSERT INTO alunos (dia, mes, ano, data_completa, usuario, code_aluno, nome_aluno, nome_social, autorizacao_nome_social, cpf, nascimento, sexo, rg, rg_expedicao, rg_expeditor, rg_uf, pai, mae, estado_civil, conjuge, nascionalidade, uf_nascimento, cidade_nascimento, etnia, escolaridade, titulo, titulo_emissao, zona, sessao, reservista, carteira_trabalho, pis, endereco, n_endereco, cep, bairro, cidade, uf_moradia, tipo_moradia, tempo_moradia, transporte_escolar, localidade) VALUES ('$dia', '$mes', '$ano', '$data_completa', '$operador', '$aluno', '$nome_aluno', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')");
					
                  echo "<script language='javascript'>window.location='?p=cadastrar_aluno&etapa=2&code=$nome_aluno&code_aluno=$aluno';</script>";
                }
                
               }?>
<form name="" method="post" action="" enctype="multipart/form-data">
                 <input type="text" name="nome_aluno" class="form-control form-control-lg" style="width:500px; float:left;" placeholder="Digite o nome completo do aluno"  />
                 
                 <input name="avancar" type="submit" class="btn btn-primary mb-2" style="padding:10px; float:left; margin:0 0 0 5px;" value="Avançar">
                </form>
		  <? } ?>
          
          
          
          
          
          
          
          <? if(@$_GET['etapa'] == '2'){ ?>
          
          
          <? if(isset($_POST['cadastrar'])){
			  
			 
				$nome_aluno = $_POST['nome_aluno'];
				$nome_social = $_POST['nome_social'];
				$autorizacao_nome_social = $_POST['autorizacao_nome_social'];
				$cpf = $_POST['cpf'];
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
				$transporte_escolar = $_POST['transporte_escolar'];
				$localidade = $_POST['localidade'];
				
				
			  	mysqli_query($conexao_bd, "UPDATE alunos SET nome_aluno = '$nome_aluno', nome_social = '$nome_social', autorizacao_nome_social = '$autorizacao_nome_social', cpf = '$cpf', nascimento = '$nascimento', sexo = '$sexo', rg = '$rg', rg_expedicao = '$rg_expedicao', rg_expeditor = '$rg_expeditor', rg_uf = '$rg_uf', pai = '$pai', mae = '$mae', estado_civil = '$estado_civil', conjuge = '$conjuge', nascionalidade = '$nascionalidade', uf_nascimento = '$uf_nascimento', cidade_nascimento = '$cidade_nascimento', etnia = '$etnia', escolaridade = '$escolaridade', titulo = '$titulo', titulo_emissao = '$titulo_emissao', zona = '$zona', sessao = '$sessao', reservista = '$reservista', carteira_trabalho = '$carteira_trabalho', pis = '$pis', endereco = '$endereco', n_endereco = '$n_endereco', cep = '$cep', bairro = '$bairro', cidade = '$cidade', uf_moradia = '$uf_moradia', tipo_moradia = '$tipo_moradia', tempo_moradia = '$tempo_moradia', transporte_escolar = '$transporte_escolar', localidade = '$localidade' WHERE code_aluno = '".$_GET['code_aluno']."'");
				
				
				if($_GET['acao'] == ''){
					
					$telefone_mae = $_POST['telefone_mae'];
					$telefone_pai = $_POST['telefone_pai'];
					$telefone_aluno = $_POST['telefone_aluno'];
					$telefone_responsavel = $_POST['telefone_responsavel'];
					$email_mae = $_POST['email_mae'];
					$email_pai = $_POST['email_pai'];
					$email_aluno = $_POST['email_aluno'];
					$email_responsavel = $_POST['email_responsavel'];

					if($telefone_mae != ''){
						mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('".$_GET['code_aluno']."', 'Telefone', 'Mãe', '', '$telefone_mae')");
					}
					if($telefone_pai != ''){
						mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('".$_GET['code_aluno']."', 'Telefone', 'Pai', '', '$telefone_pai')");
					}
					if($telefone_aluno != ''){
						mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('".$_GET['code_aluno']."', 'Telefone', 'Aluno', '', '$telefone_aluno')");
					}
					if($telefone_responsavel != ''){
						mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('".$_GET['code_aluno']."', 'Telefone', 'Responsável', '', '$telefone_responsavel')");
					}					
										



					if($email_mae != ''){
						mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('".$_GET['code_aluno']."', 'Email', 'Mãe', '', '$email_mae')");
					}
					if($email_pai != ''){
						mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('".$_GET['code_aluno']."', 'Email', 'Pai', '', '$email_pai')");
					}
					if($email_aluno != ''){
						mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('".$_GET['code_aluno']."', 'Email', 'Aluno', '', '$email_aluno')");
					}
					if($email_responsavel != ''){
						mysqli_query($conexao_bd, "INSERT INTO contato_alunos (aluno, tipo, autor, obs, contato) VALUES ('".$_GET['code_aluno']."', 'Email', 'Responsável', '', '$email_responsavel')");
					}	
					
					
					
				}
				
				
          	 $code_aluno = $_GET['code_aluno'];
                  echo "<script language='javascript'>window.alert('Operação efetuado com sucesso!');window.location='?p=listar_alunos&aluno=$code_aluno';</script>";
                				
				
		  
		  }?>
          
          
          
          
          
          
          <? 
		   $code_aluno = $_GET['code_aluno'];
           $sql = mysqli_query($conexao_bd, "SELECT * FROM alunos WHERE code_aluno = '$code_aluno'");
		     while($res_sql = mysqli_fetch_array($sql)){
			 
				$nome_aluno = $res_sql['nome_aluno'];
				$nome_social = $res_sql['nome_social'];
				$autorizacao_nome_social = $res_sql['autorizacao_nome_social'];
				$cpf = $res_sql['cpf'];
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
				$transporte_escolar = $res_sql['transporte_escolar'];
				$localidade = $res_sql['localidade'];


					
					
			 }
		  ?>
          
 		   <form name="" method="post" action="" enctype="multipart/form-data">
            <table width="1000" border="1" class="table">
             <thead class="thead-dark">
              <tr>
                <td colspan="5"><h5 style="padding:0; margin:0; color:#00F;"><strong>DADOS PESSOAIS</strong></h5></td>
               </tr>
              <tr>
                <th width="241">Nome completo</th>
                <th  width="252">CPF</th>
                <th  width="217">Data de nascimento</th>
                <th  colspan="2">Sexo</th>
              </tr>
              <tr>
                <td><input name="nome_aluno" type="text" class="form-control" value="<? echo $nome_aluno; ?>"></td>
                <td><span id="sprytextfield11">
                  <input name="cpf" type="text" class="form-control" value="<? echo $cpf; ?>" />
                </span></td>
                <td>
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
                <th>Orgão expeditor</th>
                <th colspan="2">UF de expedição</th>
              </tr>
              <tr>
                <td>
                <input type="text" name="rg" class="form-control" value="<? echo $rg; ?>" /></td>
                <td><span id="sprytextfield3">
                <input type="text" class="form-control" name="rg_expedicao" value="<? echo $rg_expedicao; ?>" />
</span></td>
                <td>
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
                </select>
                </td>
              </tr>
              <tr>
                <th>Nome do pai</th>
                <th>Nome da mãe</th>
                <th>Estado cívil</th>
                <th colspan="2">C&ocirc;njuge</th>
              </tr>
              <tr>
                <td><input type="text" class="form-control" name="pai" value="<? echo $pai; ?>"/></td>
                <td><input type="text" class="form-control" name="mae" value="<? echo $mae; ?>" /></td>
                <td>
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
                <th>Cidade de Nascimento</th>
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
                <td><input type="text" class="form-control" name="cidade_nascimento" value="<? echo $cidade_nascimento; ?>" /></td>
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
                <th>Data de emissão</th>
                <th width="123">Zona</th>
                <th width="133">Sessão</th>
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
                <td><span id="sprytextfield5">
                <input type="text" class="form-control" name="titulo_emissao" value="<? echo $titulo_emissao; ?>" />
                <span class="textfieldRequiredMsg"></span></span></td>
                <td><input name="zona" type="text" class="form-control" id="zona" size="10" maxlength="4" value="<? echo $zona; ?>" /></td>
                <td><input name="sessao" type="text" class="form-control" id="sessao" size="10" maxlength="4" value="<? echo $sessao; ?>" /></td>
              </tr>
              <tr>
                <th>Nome social</th>
                <th>Autoriza&ccedil;&atilde;o legal para nome social</th>
                <th>Reservista</th>
                <th>Cateira de trabalho</th>
                <th>N&deg; PIS/PASEP</th>
              </tr>
              <tr>
                <td><input name="nome_social" type="text" class="form-control" value="<? echo $titulo; ?>" />
                </td>
                <td><select name="autorizacao_nome_social" size="1" class="form-control" id="autorizacao_nome_social">
                  <option value="<? echo $autorizacao_nome_social; ?>"><? echo $autorizacao_nome_social; ?></option>
                  <option value="Sim">Sim</option>
                  <option value="N&atilde;o">N&atilde;o</option>
                </select></td>
                <td><input type="text" class="form-control" name="reservista" value="<? echo $reservista; ?>" /></td>
                <td><input type="text" class="form-control" name="carteira_trabalho" value="<? echo $carteira_trabalho; ?>" /></td>
                <td><input type="text" class="form-control" name="pis" id="pis" value="<? echo $pis; ?>" /></td>
              </tr>
              <tr>
                <td colspan="5" bgcolor="#33CC33" align="left"><h5 style="padding:0; margin:0; color:#00F;"><strong>DADOS DE RESID&Ecirc;NCIA</strong></h5></td>
              </tr>
              <tr>
                <th colspan="2">Endereço</th>
                <th>N°</th>
                <th>CEP</th>
                <th>Bairro</th>
              </tr>
              <tr>
                <td colspan="2"><input type="text" class="form-control" name="endereco" value="<? echo $endereco; ?>" /></td>
                <td><input name="n_endereco" type="text" class="form-control" value="<? echo $n_endereco; ?>" size="10" maxlength="4" /></td>
                <td><span id="sprytextfield6">
                <input type="text" class="form-control" name="cep" value="<? echo $cep; ?>"/>
                </span></td>
                <td><input type="text" class="form-control" name="bairro" value="<? echo $bairro; ?>"/></td>
              </tr>
              <tr>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Tipo de moradia</th>
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
                <td><select name="tipo_moradia" size="1" class="form-control" value="<? echo $tipo_moradia; ?>"/>
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
              <thead class="thead-dark">
              <tr>
                <th align="center">Necessidade de transporte escolar?</th>
                <th align="center">Localidade do transporte escolar</th>
                <th align="center">&nbsp;</th>
                <th align="center">&nbsp;</th>
                <th align="center">&nbsp;</th>
              </tr>
              <tr>
                <td align="center"><input name="transporte_escolar" type="radio" value="SIM"  <? if($transporte_escolar == 'SIM'){  ?>checked="checked" <? } ?>/>
                  <label for="transporte_escolar">
                    Sim
                    <input type="radio" name="transporte_escolar" id="radio2" value="NAO" <? if($transporte_escolar == 'NAO'){  ?>checked="checked" <? } ?>/>
                N&atilde;o</label></td>
                <td align="center"><select class="form-control" style="font:12px Arial, Helvetica, sans-serif; padding:5px; width:265px;" name="localidade" size="1">
                  <option value="<? echo $localidade; ?>"><? echo $localidade; ?></option>
                  <option value="BOLSO">BOLSO</option>
                  <option value="LAGOA SECA">LAGOA SECA</option>
                  <option value="ANIL">ANIL</option>
                  <option value="SAQUINHO">SAQUINHO</option>
                  <option value="ACENDE CANDEIA DE CIMA">ACENDE CANDEIA DE CIMA</option>
                  <option value="ACENDE CANDEIA DE BAIXO">ACENDE CANDEIA DE BAIXO</option>
                  <option value="FLORES">FLORES</option>
                  <option value="AREA VERDE">AREA VERDE</option>
                  <option value="CATUANA">CATUANA</option>
                  <option value="PADRE HOLANDA">PADRE HOLANDA</option>
                  <option value="JACARE">JACARE</option>
                  <option value="OLHO D'ÁGUA">OLHO D'ÁGUA</option>
                  <option value="PARADA">PARADA</option>
                  <option value="YPIOCA">YPIOCA</option>
                  <option value="UBICICA">UBICICA</option>
                  <option value="S&Atilde;O GON&Ccedil;ALO">S&Atilde;O GON&Ccedil;ALO</option>
                </select>
				</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="center">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5" align="left"><span style="padding:0; margin:0; color:#00F;"><strong>DADOS DE CONTATO</strong></span></td>
              </tr>
             <thead class="thead-dark">
              <tr>
                <th align="center">Telefone da m&atilde;e</th>
                <th align="center">Telefone do pai</th>
                <th align="center">Telefone do aluno</th>
                <th colspan="2" align="center">Telefone do respons&aacute;vel&nbsp;</td>                </th>
               </tr>
              <tr>
                <td align="center"><span id="sprytextfield1">
                <label for="telefone_mae"></label>
                <input type="text" name="telefone_mae" class="form-control" />
<span class="textfieldInvalidFormatMsg"></span></span></td>
                <td align="center"><span id="sprytextfield8">
                <label for="telefone_mae"></label>
                <input type="text" name="telefone_pai" class="form-control" />
                <span class="textfieldInvalidFormatMsg"></span></span></td>
                <td align="center"><span id="sprytextfield9">
                <label for="telefone_mae"></label>
                <input type="text" name="telefone_aluno" class="form-control" />
                <span class="textfieldInvalidFormatMsg"></span></span></td>
                <td colspan="2" align="center"><span id="sprytextfield10">
                <label for="telefone_mae"></label>
                <input type="text" name="telefone_responsavel" class="form-control" />
                <span class="textfieldInvalidFormatMsg"></span></span></td>
               </tr>
              <tr>
                <th align="center">E-mail da m&atilde;e</th>
                <th align="center">E-mail do pai</th>
                <th align="center">E-mail do aluno</th>
                <th colspan="2" align="center">E-mail do respons&aacute;vel</th>
               </tr>
              <tr>
                <td align="center">
                <input type="email" name="email_mae" class="form-control" /></td>
                <td align="center">
                <input type="email" name="email_pai" class="form-control" /></td>
                <td align="center">
                <input type="email" name="email_aluno" class="form-control" /></td>
                <td colspan="2" align="center">
                <input type="email" name="email_responsavel" class="form-control" /></td>
               </tr>
              <tr>
                <td colspan="5" align="center"><input type="submit" name="cadastrar" class="btn btn-primary" value="Avan&ccedil;ar" /></td>
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {useCharacterMasking:true, isRequired:false, pattern:"(00) 00000.0000"});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "custom", {useCharacterMasking:true, isRequired:false, pattern:"(00) 00000.0000"});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "custom", {useCharacterMasking:true, isRequired:false, pattern:"(00) 00000.0000"});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "custom", {useCharacterMasking:true, isRequired:false, pattern:"(00) 00000.0000"});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "custom", {pattern:"000.000.000-00", useCharacterMasking:true, isRequired:false});
</script>
</body>
</html>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "custom", {useCharacterMasking:true, isRequired:false, pattern:"(00) 00000.0000"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "custom", {useCharacterMasking:true, pattern:"0000 0000 0000", isRequired:false});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "custom", {useCharacterMasking:true, isRequired:false, pattern:"00000-000"});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "custom", {pattern:"00/0000", useCharacterMasking:true, isRequired:false});
</script>