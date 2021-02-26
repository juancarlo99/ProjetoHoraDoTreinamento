<!DOCTYPE html>
<?php include_once('conexao.php');
session_start(); ?>
<html lang="pt">
<head>
	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>Hora do treinamento</title>
	<link rel = "shortcut icon" type = "imagem/x-icon"  
	href="img_projeto/foto_logo.ico" />
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>

<body class="container">
	
	<header>
		<div class="top">
			<img src="img_projeto/foto_logo.png" width="14%" height="14%">
			<h1>Hora do Treinamento</h1>

			<div class="menu">
				<!-- Menu responsivo quando a tela do dispositivo for menor o menu se adaptara -->

				<ul class="navbar-nav ml-auto">


					<li class="nav-item bd-highlight d-none d-sm-block">
						<a href="index.php" class="btn btn-outline-primary  ml-4">HOME</a>
						<a  class="btn btn-outline-primary ml-4" href="#cadastro">Cadastros</a>
						<a  class="btn btn-outline-primary ml-4" href="#consultar">Consultas</a>


					</li>
					<li class="d-flex flex-column bd-highlight mb-3 md-nav-item d-sm-none">
						<a href="index.php" class="btn btn-outline-primary  ml-4">HOME</a><br>
						<a  class="btn btn-outline-primary ml-4" href="#cadastro">Cadastros</a><br>
						<a  class="btn btn-outline-primary ml-4" href="#consultar">Consultas</a><br>

					</li>

				</ul>

			</div>

		</div>

		<hr>
	</header>
	<div id="corpo">

		<div id="cadastro"  class="container cadastros">
			<h3>Cadastros</h3>
			<hr>

			<?php 

			$select_count_turmas="SELECT COUNT(id) as qtd_sala_cadastradas FROM salas_curso";
			
			$query_count_turmas=mysqli_query($conn,$select_count_turmas) or die("Erro ao retornar dados count ");
			$dado_turma =mysqli_fetch_assoc($query_count_turmas);

			$qdt_turmas=$dado_turma['qtd_sala_cadastradas'];
			$total_turmas=4;


			if ($qdt_turmas>=$total_turmas) {
				?>
				<button type="button" class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#modalCadastroTurma" disabled>
					Cadastrar Turmas
				</button>
				<?php
			}
			else{
				?>

				<button type="button" class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#modalCadastroTurma">
					Cadastrar Turmas
				</button>
				<?php
			}
			?>
			<!-- Modal -->
			<div class="modal fade" id="modalCadastroTurma" tabindex="-1" role="dialog" aria-labelledby="cadastroTurma" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="cadastroTurma" >Cadastro Turma</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							
							<form method="post" action="insert.php" >

								<div class="form-group">
									<label for="consulta_aluno" style="color: black">Tipo de Sala:</label>
									<select class="form-control" id="consulta_aluno"  name="tipos_salas">
										<?php 

										// aqui fiz um select para buscar a quantidade de salas que tenha o campo tipo com valor "De Aula" e atribui para uma variavel para depois fazer um if= se a quantidade de salas for menor que 2 ele continua aparecendo na opção caso não ele sai(mesmo esquema com os tipos De Café)


										$select_count_turmas_tiposl="SELECT COUNT(id) as qtd_tipo_cadastradas FROM salas_curso where tipo = 'De Aula'";

										$query_count_turmas_tiposl=mysqli_query($conn,$select_count_turmas_tiposl) or die("Erro ao retornar dados count tipo");

										$dado_turma_tiposl =mysqli_fetch_assoc($query_count_turmas_tiposl);

										$res_qtd_tiposl=$dado_turma_tiposl['qtd_tipo_cadastradas'];
										$qtd_max_aula=2;
										
										if ($res_qtd_tiposl<$qtd_max_aula) {
											echo "<option>De Aula</option>";
										}

										$select_count_turmas_tipocf="SELECT COUNT(id) as qtd_tipo_cadastradascf FROM salas_curso where tipo = 'De Café'";

										$query_count_turmas_tipocf=mysqli_query($conn,$select_count_turmas_tipocf) or die("Erro ao retornar dados count tipo");

										$dado_turma_tipocf =mysqli_fetch_assoc($query_count_turmas_tipocf);

										$res_qtd_tipocf=$dado_turma_tipocf['qtd_tipo_cadastradascf'];
										
										
										if ($res_qtd_tipocf<$qtd_max_aula) {
											echo "<option>De Café</option>";
										}
										
										?>
										
										
									</select>
								</div>
								
								<div class="form-group">
									<label style="color: black">Nome da sala:</label><br>
									<input class="col-sm-10 border" type="text" required="" name="nome_sala1" placeholder="Nome ">
								</div>
								<div class="form-group">
									<label  style="color: black">Lotação da sala:</label>
									<input class="col-sm-10 border" type="number"  required=""  name="lotacao1"placeholder="Lotação ">

								</div>
								
								<input type="submit"  name="cadastrar_sala" value="Cadastrar salas" class="btn btn-primary">
							</form>
							
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal" >Fechar</button>
							
						</div>
					</div>
				</div>
			</div>
			<?php 
			$select_soma_lotacao="SELECT  SUM(lotacao ) AS total_lotacao  FROM salas_curso WHERE tipo= 'De Aula'";
			$select_count_alunos="SELECT COUNT(id) as qtd_alunos FROM alunos";
			

			$query_lotacao=mysqli_query($conn,$select_soma_lotacao) or die("Erro ao retornar dados lotacao");
			$query_count_alunos=mysqli_query($conn,$select_count_alunos) or die("Erro ao retornar dados count");

			$dado_turma_lotacao =mysqli_fetch_assoc($query_lotacao);
			$dado_alunos =mysqli_fetch_assoc($query_count_alunos);

			$lotacao_turmas=$dado_turma_lotacao['total_lotacao']-1;
			$qtd_alunos=$dado_alunos['qtd_alunos'];
			
			

			if ($qtd_alunos>$lotacao_turmas) {
				?>
				<button type="button" class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#modalCadastroAluno" disabled>
					Cadastrar Aluno
				</button>
				<?php
			}
			else{
				?>

				<button type="button" class="btn btn-outline-light btn-lg" data-toggle="modal" data-target="#modalCadastroAluno">
					Cadastrar Aluno
				</button>
				<?php
			}
			?>
			
			
			<div class="modal fade" id="modalCadastroAluno" tabindex="-1" role="dialog" aria-labelledby="cadastroAluno" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="cadastroAluno" style="color: black">Cadastro Aluno</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">

							<form method="post"  action="insert.php">

								<div class="form-group">
									<label style="color: black">Nome:</label><br>
									<input class="col-sm-10 border" type="text" required="" name="nome_aluno" placeholder="Nome ">
								</div>
								<div class="form-group">
									<label  style="color: black">Sobrenome:</label>
									<input class="col-sm-10 border" type="text"  name="sobrenome" placeholder="Sobrenome ">

								</div>

								<input type="submit"  name="salvar" value="Salvar" class="btn btn-primary">
							</form>
							


						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				</div>

			</div>
			<div class="gerar">

				<form action="update.php" method="POST">
					<?php 
					$select_nulos="SELECT COUNT(*) AS nulos FROM alunos 
					WHERE `id` is null or Nome is null or Sobrenome is null or id_1_etapa is null or id_2_etapa is null or id_cafe1 is null or id_cafe2 is null
					";
					$query_null=mysqli_fetch_assoc(mysqli_query($conn,$select_nulos));
					$res_null=$query_null['nulos'];
					if ($res_null==0) {
						echo'<button type="submit"   class=" btn btn-outline-light btn-lg" data-toggle="modal" disabled>
						Gerar Turmas
						</button><br><br><hr>';
					}
					else
					{
						echo'<button type="submit"   class=" btn btn-outline-light btn-lg" data-toggle="modal" >
						Gerar Turmas
						</button><br><br><hr>';
					}
					
					?>

					



				</form>
			</div>	
			<div id="consultar" >
				<h3>Consultas</h3><hr><br>
				<form method="POST" >
					<div class="form-group">
						<label for="consulta_aluno">Por Aluno</label>
						<select class="form-control" id="consulta_aluno" name="consulta_aluno">
							<?php
							$select_busca_tds_aluno="SELECT `id`,`Nome`,`Sobrenome` FROM `alunos` ";
							$query_busca_tds_aluno=mysqli_query($conn,$select_busca_tds_aluno)or die("Erro ao retornar dados ");

							while ($dado_busca=mysqli_fetch_array($query_busca_tds_aluno)) {
								
								$id_aluno=$dado_busca['id'];
								$nome_aluno=$dado_busca['Nome'];
								$nome_sobrenome=$dado_busca['Sobrenome'];
								?>

								<option value="<?php echo $id_aluno; ?> "><?php echo$id_aluno." | ". $nome_aluno." ".$nome_sobrenome ; ?> </option>
								<?php 
								
							}
							?>
							
						</select>

						<button type="submit" name="cons"  class=" btn btn-outline-light btn-lg"  >
							Consultar
						</button><br><br><hr>
						<?php
						if (isset($_POST['cons'])) {

							$id_aluno_escolhido=$_POST['consulta_aluno'];
							$select_aluno_salas="
							SELECT
							a.id,
							a.Nome,
							a.Sobrenome,
							sala_aula_e1.nome_da_sala as sala_etapa1,
							sala_aula_e2.nome_da_sala as sala_etapa2,
							sala_cafe_e1.nome_da_sala as cafe1,
							sala_cafe_e2.nome_da_sala as cafe2
							FROM
							alunos AS a,
							salas_curso AS sala_aula_e1,
							salas_curso AS sala_aula_e2,
							salas_curso AS sala_cafe_e1,
							salas_curso AS sala_cafe_e2 
							WHERE
							a.id_1_etapa = sala_aula_e1.id
							AND a.id_2_etapa = sala_aula_e2.id
							AND a.id_cafe1 = sala_cafe_e1.id
							AND a.id_cafe2 = sala_cafe_e2.id
							AND a.id = '$id_aluno_escolhido'";
							$query_busca_escolhido=mysqli_query($conn,$select_aluno_salas);
							?>
							<table class="table">
								<thead>
									<tr><th scope="col">ID</th>
										<th scope="col">Nome</th>
										<th scope="col">Sobrenome</th>
										<th scope="col">Etapa 1</th>
										<th scope="col">Etapa 2</th>
										<th scope="col">Cafe 1</th>
										<th scope="col">Cafe 2</th>
									</tr>
								</thead>

								<?php 
								while ($dado_escolhido=mysqli_fetch_array($query_busca_escolhido) )		{
									$id_alun=$dado_escolhido['id'];
									$nome_alunotb=$dado_escolhido['Nome'];
									$Sobrenometb=$dado_escolhido['Sobrenome'];
									$sl1=$dado_escolhido['sala_etapa1'];
									$sl2=$dado_escolhido['sala_etapa2'];
									$cf1=$dado_escolhido['cafe1'];
									$cf2=$dado_escolhido['cafe2'];
									
									?>
									<tbody>
										<tr>
											<td scope="row"><?php echo $id_alun ;?></td>
											<td ><?php echo $nome_alunotb ;?></td>
											<td><?php echo $Sobrenometb ;?></td>
											<td><?php echo $sl1 ;?></td>
											<td><?php echo $sl2; ?></td>
											<td><?php echo $cf1; ?></td>
											<th ><?php echo $cf2 ;?></th>
										</tr>
									</tbody>
									<?php
								}
							}
							
							?>
							
						</table>

						
						
					</div>
				</form>

				<form method="POST" >
					<div class="form-group">
						<label for="consulta_sala">Por Sala</label>
						<select class="form-control" id="consulta_sala" name="consulta_sala">
							<?php
							$select_busca_tds_sla="SELECT id , nome_da_sala, tipo FROM `salas_curso` ";
							$query_busca_tds_sla=mysqli_query($conn,$select_busca_tds_sla)or die("Erro ao retornar dados sla");

							while ($dado_busca_sla=mysqli_fetch_array($query_busca_tds_sla)) {
								
								$id_sala=$dado_busca_sla['id'];
								$nome_sala=$dado_busca_sla['nome_da_sala'];
								$tipo_sala=$dado_busca_sla['tipo'];
								?>

								<option value="<?php echo $id_sala; ?> "><?php echo$id_sala." | ". $nome_sala."  | ".$tipo_sala ; ?> </option>
								<?php 
								
							}
							?>
							
						</select>

						<button type="submit" name="cons_sla"  class=" btn btn-outline-light btn-lg"  >
							Consultar
						</button><br><br><hr>
						<?php
						if (isset($_POST['cons_sla'])) {

							$id_sla_escolhido=$_POST['consulta_sala'];
							$select_sla_salas="
							SELECT
							a.id,
							a.Nome,
							a.Sobrenome,
							sala_aula_e1.nome_da_sala as sala_etapa1,
							sala_aula_e2.nome_da_sala as sala_etapa2,
							sala_cafe_e1.nome_da_sala as cafe1,
							sala_cafe_e2.nome_da_sala as cafe2
							FROM
							alunos AS a,
							salas_curso AS sala_aula_e1,
							salas_curso AS sala_aula_e2,
							salas_curso AS sala_cafe_e1,
							salas_curso AS sala_cafe_e2 ,
							salas_curso AS sl
							WHERE
							sl.id = '$id_sla_escolhido' AND
							a.id_1_etapa = sala_aula_e1.id
							AND a.id_2_etapa = sala_aula_e2.id
							AND a.id_cafe1 = sala_cafe_e1.id
							AND a.id_cafe2 = sala_cafe_e2.id
							"
							;
							$query_busca_sla_escolhido=mysqli_query($conn,$select_sla_salas);
							?>
							<table class="table">
								<thead>
									<tr><th scope="col">ID</th>
										<th scope="col">Nome</th>
										<th scope="col">Sobrenome</th>
										<th scope="col">Etapa 1</th>
										<th scope="col">Etapa 2</th>
										<th scope="col">Cafe 1</th>
										<th >Cafe2</th>
									</tr>
								</thead>

								<?php 
								while ($dado_sla_escolhido=mysqli_fetch_array($query_busca_sla_escolhido) )		{
									$id_alun=$dado_sla_escolhido['id'];
									$nome_alunotb=$dado_sla_escolhido['Nome'];
									$Sobrenometb=$dado_sla_escolhido['Sobrenome'];
									$sl1=$dado_sla_escolhido['sala_etapa1'];
									$sl2=$dado_sla_escolhido['sala_etapa2'];
									$cf1=$dado_sla_escolhido['cafe1'];
									$cf2=$dado_sla_escolhido['cafe2'];
									
									?>
									<tbody>
										<tr>
											<td scope="row"><?php echo $id_alun ;?></td>
											<td ><?php echo $nome_alunotb ;?></td>
											<td><?php echo $Sobrenometb ;?></td>
											<td><?php echo $sl1 ;?></td>
											<td><?php echo $sl2; ?></td>
											<td><?php echo $cf1; ?></td>
											<th ><?php echo $cf2 ;?></th>
										</tr>
									</tbody>
									
									<?php
								}
							}
							
							?>
						</table>

						
					</div>
				</form>

			</div>


		</div>
		
		<footer  class="container">
			<h5 >Desenvolvido por Juan Carlos Nunes</h5><hr>
		</footer>
	</div>
</body>




</html>
