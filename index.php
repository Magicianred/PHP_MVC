<?php 

// $path = $_SERVER['DOCUMENT_ROOT']."/projetorecicladarte/app/Core/";
// require_once $path."Core.php";
		require_once  'app/Core/Core.php';

		require_once  'lib/Database/Connection.php';		

		require_once  'app/Controller/HomeController.php';
		require_once  'app/Controller/ErroController.php';
		require_once  'app/Controller/PostController.php';
		require_once  'app/Controller/SobreController.php';
		require_once  'app/Controller/AdminController.php';

		require_once  'app/Model/Postagem.php';
		require_once  'app/Model/Comentario.php';

		require_once 'vendor/autoload.php';


$template = file_get_contents('app/Template/estrutura.html');

ob_start();
//Armazena tudo o que está aqui dentro na variavel $saida
	$core = new Core;
	$core->start($_GET);

	$saida = ob_get_contents();

ob_end_clean();

$tplPronto = str_replace('{{area_dinamica}}', $saida, $template);

echo $tplPronto;