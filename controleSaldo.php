<?
function recepcao($aluno, $pontos, $descricaoUltimoCredito, $atividade, $tipo){
	include "conexao.php";
			
	if($tipo == 'CREDITO'){ // SE FOR DO TIPO CRÉDITO
		
		$verificaExtrato = verificaExtrato($atividade, $aluno);
		
		if($verificaExtrato == 1){
			inserirExtrato($aluno, $pontos, $descricaoUltimoCredito, $atividade, $tipo); 
			adicionarPontos($aluno, $pontos, $descricaoUltimoCredito, $atividade);
			
		}else{
			
			excluirExtrato($aluno, $atividade);
			adicionarPontos($aluno, $pontos, $descricaoUltimoCredito, $atividade);
			inserirExtrato($aluno, $pontos, $descricaoUltimoCredito, $atividade, $tipo); 
			
		}
		
	}else{ // SE FOR DO TIPO DÉBITO
		
	}
	
} // recepcao


function adicionarPontos($aluno, $pontos, $descricaoUltimoCredito, $atividade){
include "conexao.php";
		$sqlPuxaSaldo = mysqli_query($conexao_bd, "SELECT * FROM controlePontos WHERE aluno	= '$aluno'");
		
		if(mysqli_num_rows($sqlPuxaSaldo) == ''){
			$sqlInserirPontos = mysqli_query($conexao_bd, "INSERT INTO controlePontos (aluno, saldo, ultimoSaldo, ultimoCredito, ultimoDebito, dataUltimoSaldo, dataUltimodebito, descricaoUltimoCredito, descricaoUltimoDebito, ultimaAtividade) VALUES ('$aluno', '$pontos', '0', '0', '', '$data', '', '$descricaoUltimoCredito', '', '$atividade')");
			
		}else{
			
			while($resPuxaSaldo = mysqli_fetch_array($sqlPuxaSaldo)){
				
				$ultimoSaldo = $resPuxaSaldo['ultimoCredito'];

			
				$saldoAluno = $resPuxaSaldo['saldo'];
				$ultimoCredito = $resPuxaSaldo['ultimoCredito'];
				$dataUltimoSaldo = $resPuxaSaldo['dataUltimoSaldo'];
				
				
			
				$novoSaldo = $resPuxaSaldo['saldo']+$pontos;
				
				$descontaSaldo = $novoSaldo-$ultimoCredito;
			
				atualizarPontos($aluno, $novoSaldo, $saldoAluno, $dataUltimoSaldo, $descricaoUltimoCredito);

				saldoanterior($aluno, $descontaSaldo);
				
			}
			
		}
	
}


function verificaExtrato($atividade, $aluno){
	include "conexao.php";
	 
	 $sqlVerificaExtrato = mysqli_query($conexao_bd, "SELECT * FROM extratosPontosTots WHERE aluno = '$aluno' AND atividade = '$atividade'");
		if(mysqli_num_rows($sqlVerificaExtrato) == NULL){
			return 1;
		}else{
			return 0;
		}
	 
		
	}
	
	
function excluirExtrato($aluno, $atividade){
	include "conexao.php";
	$sqlExclusaoExtrato = mysqli_query($conexao_bd, "DELETE FROM extratosPontosTots WHERE aluno = '$aluno' AND atividade = '$atividade'");
}
	
	

function inserirExtrato($aluno, $pontos, $descricaoUltimoCredito, $atividade, $tipo){
include "conexao.php";
$sqlExtratoPontos = mysqli_query($conexao_bd, "INSERT INTO extratosPontosTots (aluno, data, pontos, tipo, atividade, descricao) VALUES ('$aluno', '$data', '$pontos', '$tipo', '$atividade', '$descricaoUltimoCredito')");
 if($sqlExtratoPontos == NULL){
	echo "<script language='javascript'>window.alert('Erro ao inserir no extrato de pontos!');</script>";
	return NULL;
  }else{
	
  }
}




function saldoanterior($aluno, $ultimoSaldo){
	include "conexao.php";
	mysqli_query($conexao_bd, "UPDATE controlePontos SET saldo = '$ultimoSaldo' WHERE aluno = '$aluno'");	
}



function atualizarPontos($aluno, $novoSaldo, $saldoAluno, $dataUltimoSaldo, $descricaoUltimoCredito){
include "conexao.php";

	$sqlAtualizaDados = mysqli_query($conexao_bd, "UPDATE controlePontos SET saldo = '$novoSaldo', ultimoSaldo = '$saldoAluno', dataUltimoSaldo = '$dataUltimoSaldo', descricaoUltimoCredito = '$descricaoUltimoCredito' WHERE aluno = '$aluno'");

  if($sqlAtualizaDados == NULL){
	echo "<script language='javascript'>window.alert('Erro ao atualizar pontos!');</script>";
  }else{
	
   }

}

?>