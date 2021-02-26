
<?php  

include_once('conexao.php');

 // Busca as quantidades de alunos e faz um if: se a quantidade de alunos for menor ou igual a 1 ele não faz a geração de turmas, se não ele faz normalmente!

$metade_alu="SELECT COUNT(id) as alu  FROM alunos";
$res_alu=mysqli_fetch_assoc(mysqli_query($conn,$metade_alu));
$count_alu=$res_alu['alu'];

if ($count_alu<=2) {
 ?>

 <SCRIPT LANGUAGE='JavaScript'>
  window.alert('Turmas não geradas, não a alunos o suficiente!');
  window.location.href='index.php';
</SCRIPT> 


<?php
}
else{


//busca 1° resultado de cada tipo de sala: Café e Aula 

  $select_aula_1="SELECT    id  FROM salas_curso where tipo  = 'De Aula' LIMIT 1;";
  $select_cafe_1="SELECT   id  FROM salas_curso where tipo  = 'De Café' LIMIT 1;";



  $res_al=mysqli_fetch_assoc(mysqli_query($conn,$select_aula_1));
  $res_cf=mysqli_fetch_assoc(mysqli_query($conn,$select_cafe_1));

  $select_count_turmas_tiposl="SELECT COUNT(id) as qtd_tipo_cadastradas FROM salas_curso where tipo = 'De Aula'";

  $query_count_turmas_tiposl=mysqli_query($conn,$select_count_turmas_tiposl) or die("Erro ao retornar dados count tipo");

  $dado_turma_tiposl =mysqli_fetch_assoc($query_count_turmas_tiposl);

 

  $select_count_turmas_tipocf="SELECT COUNT(id) as qtd_tipo_cadastradascf FROM salas_curso where tipo = 'De Café'";

  $query_count_turmas_tipocf=mysqli_query($conn,$select_count_turmas_tipocf) or die("Erro ao retornar dados count tipo");

  $dado_turma_tipocf =mysqli_fetch_assoc($query_count_turmas_tipocf);

   $res_qtd_tiposl=$dado_turma_tiposl['qtd_tipo_cadastradas'];

  $res_qtd_tipocf=$dado_turma_tipocf['qtd_tipo_cadastradascf'];

      $total_qtd_sl_cf=$res_qtd_tipocf+$res_qtd_tiposl;
      $qtd_max_turmas=4;

  if ($res_qtd_tiposl=0 or  $res_qtd_tipocf= 0 or $total_qtd_sl_cf < $qtd_max_turmas ) {
    ?>

    <SCRIPT LANGUAGE='JavaScript'>
      window.alert('Turmas não geradas, Cadastre pelo 2 uma sala de aula e outras 2 de café!');
      window.location.href='index.php';
    </SCRIPT> 
    <?php
  

}
  else{

  //armazena em uma variavel para colocar com valores nos updates
    $res_cf1=$res_cf['id'];
    $res_al1=$res_al['id'];
//update de todos os ids de alunos pares: faz o update se o id do aluno for par e joga o mesmo resultado da primeira sala para todos os campos de salas 
    $Update_id_par="
    UPDATE
    `alunos` 
    SET 
    `id_1_etapa`='$res_al1',
    id_2_etapa='$res_al1',

    `id_cafe1` = '$res_cf1',
    id_cafe2 ='$res_cf1'

    WHERE 
    `id` % 2 = 0;
    ";

//update de todos os ids de alunos impares: faz o update se o id do aluno for impares e joga o mesmo resultado da primeira sala para todos os campos de salas 
    $Update_id_impar="
    UPDATE
    `alunos` 
    SET 
    `id_1_etapa`=(SELECT  id  FROM salas_curso where tipo  = 'De Aula'  and id !='$res_al1' ),

    `id_cafe1` =  (SELECT   id  FROM salas_curso where tipo  = 'De Café' and id != '$res_cf1' ),
    id_2_etapa=(SELECT  id  FROM salas_curso where tipo  = 'De Aula'  and id !='$res_al1' ),
    id_cafe2 =(SELECT   id  FROM salas_curso where tipo  = 'De Café' and id != '$res_cf1' )
    WHERE 
    `id` % 2 = 0+1;
    ";

//select para buscar a metade da quantidade total de impares  e de pares 
    $metade_par="SELECT COUNT(id)/2 as par  FROM alunos where `id` % 2 = 0";
    $metade_impar="SELECT COUNT(id) /2 as inpar FROM alunos where `id` % 2 = 0+1";

    $res_par=mysqli_fetch_assoc(mysqli_query($conn,$metade_par));
    $res_impar=mysqli_fetch_assoc(mysqli_query($conn,$metade_impar));
  //guardo em uma variavel e mudo o tipo dele para int para depois usar no LIMIT do sql para trocas metades dos alunos de turma na segunda etapa 
    $count_par=intval($res_par['par']);
    $count_inpar=intval( $res_impar['inpar']);

    $update_etapa2par=" UPDATE
    `alunos` 
    SET 

    id_2_etapa=(SELECT  id  FROM salas_curso where tipo  = 'De Aula'  and id !='$res_al1' ),


    id_cafe2 =(SELECT   id  FROM salas_curso where tipo  = 'De Café' and id != '$res_cf1' )

    WHERE 
    `id` % 2 = 0 LIMIT ".$count_par.";" ;

    $update_etapa2impar=" UPDATE
    `alunos` 
    SET 

    id_2_etapa='$res_al1',


    id_cafe2 ='$res_al1'

    WHERE 
    `id` % 2 = 0+1 LIMIT ".$count_inpar.";" ;




    $update_tapa1par=mysqli_query($conn,$Update_id_par)or die ("Erro no Update  par");
    $update_tapa1impar=mysqli_query($conn,$Update_id_impar)or die ("Erro no Update impar");


    $update_tapa2par=mysqli_query($conn,$update_etapa2par)or die ("Erro no Update etapa2 par");
    $update_tapa2impar=mysqli_query($conn,$update_etapa2impar)or die ("Erro no Update etapa2 inpar");
// se algum dos updates der errado volta para a index e faz um aviso 
    if ($update_tapa1par = true and $update_tapa1impar= true and $update_tapa2par =true and $update_tapa2impar = true ){ ?>

      <SCRIPT LANGUAGE='JavaScript'>
        window.alert('Turmas Geradas com sucesso!');
        window.location.href='index.php';
      </SCRIPT>

      <?php

    }
    else{

      ?>

      <SCRIPT LANGUAGE='JavaScript'>
        window.alert('Turmas não geradas, tente mais tarde!');
        window.location.href='index.php';
      </SCRIPT> 


      <?php
    }


  }

}

?>
