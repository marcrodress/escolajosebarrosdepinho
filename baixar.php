<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?php
	/*
	 * Dica: Sempre mantenha os arquivos de download em uma mesma pasta, separada dos arquivos do site.
	 * Neste script usaremos a pasta download para esta fun��o.
	 */

	$arquivo = $_GET['arquivo']; // Nome do Arquivo
	$local = 'professor/arquivos/'; // Pasta que cont�m os arquivos para download
	$local_arquivio = $local.$arquivo; // Concatena o diret�rio com o nome do arquivo
	
	/*
	 * Por seguran�a, o script verifica se o usu�rio esta tentato sair da pasta especificada para 
	 * os arquivos de download (stripos($arquivo, './') !== false || stripos($arquivo, '../') !== false),
	 * isso ir� bloquear a tentativa de for�ar download de arquivos n�o permitidos.
	 * Na mesma fun��o verificamos se o arquivo existe (!file_exists($arquivo)).
	 */
    if(stripos($arquivo, './') !== false || stripos($arquivo, '../') !== false || !file_exists($local_arquivio))
    {
    	echo 'O comando n�o pode ser executado.';
    }
    else
    {
	    header('Cache-control: private');
	    header('Content-Type: application/octet-stream');
	    header('Content-Length: '.filesize($local_arquivio));
	    header('Content-Disposition: filename='.$arquivo);
	    header("Content-Disposition: attachment; filename=".basename($local_arquivio));
	    
	    // Envia o arquivo Download
		readfile($local_arquivio);
    }
?>
</body>
</html>