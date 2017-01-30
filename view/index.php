<?php
	function __autoload($classe){
		require_once '../model/'.$classe.'.php';
	}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Cadastro</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet">
	</head>
	<body>
		<div class="container">
			<?php
				$usuario = new usuario();
				if(isset($_POST['cadastrar'])){
					$nome  = $_POST['nome'];
					$email = $_POST['email'];
					$usuario->setNome($nome);
					$usuario->setEmail($email);
					if($usuario->insert()){
						echo "Inserido com sucesso!";
					}
				}
			?>
			<header class="masthead">
				<h1 class="muted">Cadastro</h1>
				<nav class="navbar">
					<div class="navbar-inner">
						<div class="container">
							<ul class="nav">
								<li class="active"><a href="index.php">Página inicial</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</header>
			<?php 
				if(isset($_POST['atualizar'])){
					$id = $_POST['id'];
					$nome = $_POST['nome'];
					$email = $_POST['email'];
					$usuario->setNome($nome);
					$usuario->setEmail($email);
					if($usuario->update($id)){
						echo "Atualizado com sucesso!";
					}
				}
			?>
			<?php
				if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'){
					$id = (int)$_GET['id'];
					if($usuario->delete($id)){
						echo "Deletado com sucesso!";
					}
				}
			?>
			<?php
				if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
					$id = (int)$_GET['id'];
					$resultado = $usuario->find($id);
			?>
			<form method="post" action="">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" name="nome" value="<?php echo $resultado->nome; ?>" placeholder="Nome:">
				</div>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-envelope"></i></span>
					<input type="text" name="email" value="<?php echo $resultado->email; ?>" placeholder="E-mail:">
				</div>
				<input type="hidden" name="id" value="<?php echo $resultado->id; ?>"><br>
				<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">
			</form>
			<?php 
				}else{ 
			?>
			<form method="post" action="">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" name="nome" placeholder="Nome:">
				</div>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-envelope"></i></span>
					<input type="text" name="email" placeholder="E-mail:">
				</div>
				<br>
				<input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar dados">			
			</form>
			<?php 
				} 
			?>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Nome:</th>
						<th>E-mail:</th>
						<th>Ações:</th>
					</tr>
				</thead>
				<?php 
					foreach($usuario->findAll() as $valores => $valor){
				?>
				<tbody>
					<tr>
						<td><?php echo $valor->id; ?></td>
						<td><?php echo $valor->nome; ?></td>
						<td><?php echo $valor->email; ?></td>
						<td>
							<?php echo "<a href='index.php?acao=editar&id=".$valor->id."'>Editar</a>"; ?>
							<?php 
							echo "<a href='index.php?acao=deletar&id=".$valor->id."' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?>
						</td>
					</tr>
				</tbody>
				<?php
					} 
				?>
			</table>
		</div>
		<script src="js/jQuery.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>