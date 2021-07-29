<?php
	
	class Postagem{
		public static function selecinaTodos(){
			$con = Connection::getConn();			

			$sql = "SELECT * FROM postagem ORDER BY id DESC";
			$sql = $con->prepare($sql);
			$sql->execute();
			
			//Pegar Registros no banco e converter em objeto
			$resultado = array();
			while($row = $sql->fetchObject('Postagem')){
				$resultado[] = $row;
			}
			if(!$resultado){
				//Para a execução e retorna essa mensagem no try/catch
				throw new Exception("Não foi encontrado nenhum registro no banco");
			}
			return $resultado;
		}

		public static function selecionaPorId($idPost){
			$con = Connection::getConn();

			$sql = "SELECT * FROM postagem WHERE id= :id";
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $idPost, PDO::PARAM_INT);
			$sql->execute();

			$resultado = $sql->fetchObject('Postagem');

			if(!$resultado){
				//Para a execução e retorna essa mensagem no try/catch
				throw new Exception("Não foi encontrado nenhum registro no banco");
			}else{				
				$resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
				
			}
			return $resultado;
		}

		public static function insert($dadosPost){			
			if(empty($dadosPost['titulo']) OR empty($dadosPost['conteudo'])){
				//Validação simples
				throw new Exception("Preencha todos os campos");

				return false;				
			}

			$con = Connection::getConn();

			$sql = 'INSERT INTO postagem (titulo, conteudo) VALUES (:tit, :cont)';
			$sql = $con->prepare($sql);
			$sql->bindValue(':tit', $dadosPost['titulo']);
			$sql->bindValue(':cont', $dadosPost['conteudo']);
			if($sql->execute()){
				return true;
			}else{
				throw new Exception("Falha ao inserir publicação");

				return false;
			}

		}

		public static function update($params){
			$con = Connection::getConn();

			$sql = 'UPDATE postagem SET titulo =:tit, conteudo=:cont WHERE id=:id';
			$sql = $con->prepare($sql);
			$sql->bindValue(':tit', $params['titulo']);
			$sql->bindValue(':cont', $params['conteudo']);
			$sql->bindValue(':id', $params['id']);

			if($sql->execute()){
				return true;
			}else{
				throw new Exception("Falha ao alterar publicação");

				return false;
			}
		}

		public static function delete($id){
			$con = Connection::getConn();

			$sql = 'DELETE FROM postagem WHERE id=:id';
			$sql = $con->prepare($sql);
			$sql->bindValue(':id', $id);

			if($sql->execute()){
				return true;
			}else{
				throw new Exception("Falha ao deletar publicação");

				return false;
			}
		}

	}