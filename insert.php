	<?php  
							
							include_once('conexao.php');

							if (isset($_POST['cadastrar_sala'])) {
								
								
								$tipo_de_sala=$_POST['tipos_salas'];;
								
								$nome_sala1=$_POST['nome_sala1'];
								$lotacao1=$_POST['lotacao1'];
								
								

								$sql_salas="
								INSERT INTO salas_curso
								(nome_da_sala, lotacao, tipo)
								VALUES
								('$nome_sala1','$lotacao1','$tipo_de_sala');


								"
								;
								$query_salas= mysqli_query($conn, $sql_salas) or die("Erro ao retornar dados");

								if ($query_salas) {
									?>

									
									<SCRIPT LANGUAGE='JavaScript'>
										window.alert("Salas Cadastrada com sucesso!");
										window.location.href='index.php';
									</SCRIPT> 


									<?php

								}
								else{
									
									?>

									<SCRIPT LANGUAGE='JavaScript'>
										window.alert("Salas não cadastrada, tente mais tarde!");
										window.location.href='index.php';
									</SCRIPT> 

								


									<?php
								}
							}

							
							
							if (isset($_POST['salvar'])) {
								




								$nome=$_POST['nome_aluno'];
								$sobrenome=$_POST['sobrenome'];

								$sql_cadastro_alunos="INSERT INTO alunos ( Nome, Sobrenome) VALUES ('$nome','$sobrenome')";

								$query = mysqli_query($conn, $sql_cadastro_alunos ) or die("Erro ao retornar dados");
								if ($query) {
									?>

									

									<SCRIPT LANGUAGE='JavaScript'>
										window.alert("Aluno Cadastrado");
										window.location.href='index.php';
									</SCRIPT> 

									<?php

								}

								else{

									?>
									<SCRIPT LANGUAGE='JavaScript'>
										window.alert("Solicitação não cadastrada, tente mais tarde!");
										window.location.href='index.php';
									</SCRIPT> 
									


									<?php
								}


							}
							?>
