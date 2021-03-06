<?php
session_start();
$id = $_SESSION['stdnt_number'];
// Se asegura que el usario que no haya iniciado sesion no pueda acceder a esta pagina.
include_once 'private/dbconnect.php';
if(!isset($_SESSION['stdnt_number'])){
  header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>CONSEJERÍA-UPRA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Aqui llamamos a los distintos css de la pagina y el font que tiene -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css"> 
    <link rel="stylesheet" href="css/conse.css">
    <link rel="stylesheet" href="css/notes.css">  
    <link rel="stylesheet" href="cita.css">
    <link rel="stylesheet" href="css/sugerencias.css">
    <link rel="stylesheet" href="css/sugerencias2.css">
    <link rel="stylesheet" href="jqueryui/jquery-ui.css">
    <link rel="stylesheet" href="jqueryui/jquery-ui.structure.css">
    <link rel="stylesheet" href="jqueryui/jquery-ui.theme.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Culmina la parte los css y fonts. -->
      <!-- Font Awesome. -->
  <link rel="stylesheet" href="AdminUPRA/plugins/fontawesome-free/css/all.min.css">
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  <div class="site-wrap">
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
<!-- Esta area es para que el student cierre su sesion. -->
    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-25"><img src="image/upraconse.png" alt=""></div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="private/logout.php" class="nav-link">Cerrar Sesión</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </header>
 <!-- Culmina la parte cerrar sesion del student. -->
    <div style="padding-top: 200px; padding-bottom: 20px; margin-left: 15%">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-12">   
                <div style="margin-right: 30%"><h6>UNIVERSIDAD DE PUERTO RICO EN ARECIBO</h6>
                                    <h6>DEPARTAMENTO DE CIENCIAS DE CÓMPUTOS</h6>
                                    <h6>EVALUACIÓN BACHILLERATO EN CIENCIAS DE CÓMPUTOS</h6></div>
              </div>
                <?php 
                 $sentenciaSQL= "SELECT SUM(C)
                 FROM ((SELECT crse_credits AS C
                 FROM mandatory_courses
                 INNER JOIN  student_record USING(crse_label)
                 WHERE student_record.stdnt_number = '$id' AND crse_grade != '' AND crse_grade != 'W' AND crse_grade != 'F' AND crse_grade != 'ID' AND crse_grade != 'IF')
                 UNION ALL
                 (SELECT crse_credits AS C
                 FROM general_courses
                 INNER JOIN student_record USING(crse_label)
                 WHERE student_record.stdnt_number = '$id' AND crse_grade != '' AND crse_grade != 'W' AND crse_grade != 'F' AND crse_grade != 'ID' AND crse_grade != 'IF')
                 UNION ALL (SELECT crse_credits AS C
                 FROM departmental_courses
                 INNER JOIN student_record USING(crse_label)
                 WHERE student_record.stdnt_number = '$id' AND crse_grade != '' AND crse_grade != 'W' AND crse_grade != 'F' AND crse_grade != 'ID' AND crse_grade != 'IF')
                 UNION ALL (SELECT crse_credits AS C
                 FROM free_courses
                 INNER JOIN student_record USING(crse_label)
                 WHERE student_record.stdnt_number = '$id' AND crse_grade != '' AND crse_grade != 'W' AND crse_grade != 'F' AND crse_grade != 'ID' AND crse_grade != 'IF')) t1";
                    $resultRecom = mysqli_query($conn, $sentenciaSQL);
                    $reco=mysqli_fetch_assoc($resultRecom);
                
              if ($reco['SUM(C)']=== NULL){
                  $reco['SUM(C)']=0;
              }
                  $mes = date('m');
                  $sem = 1;
                      if($mes >= 6){
                      $sem = 2;
                    }
                 echo "<div class='card-header'>
                    Nombre: <b> {$_SESSION['crse_nameompleto']} </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Correo: <b>{$_SESSION['stdnt_email']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Semestre: <b>$sem</b><br>
                    Número de Estudiante: <b>{$_SESSION['stdnt_number']}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Créditos Aprobados: <b>{$reco['SUM(C)']}</b></b><br></div>";?>
                </div>
              </div>
            </div>
 <!-- Aqui se muestran los distinto TABS que estan en la pagina del student. -->
       <div class="container tables">
                <div class="tab">
                    <button class="tablinks active" onclick="openCity(event, 'appointment')">Sacar Cita con su Consejero/a</button>
                    <button class="tablinks" onclick="openCity(event, 'Concentracion')">Realización de Consejería</button>
                     <button class="tablinks" onclick="openCity(event, 'Sugerencias')">Hacer Sugerencias de Clases</button>
                    <button class="tablinks" onclick="openCity(event, 'Comentario')">Comentario del Consejero/a</button>
                  </div>
 <!-- Culmina la parte de los TABS. -->                
 <!-- Comienza el TAB de la realizacion de consejeria donde el student puede ver su file y confirmar su consejeria academica y tambien sugerir al momento de darle 'click' en consejeria 'otros cursos'. -->
            <div id="Concentracion" class="tabcontent">
                <section class="content">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                            <?php 
                             $sentenciaSQL= "SELECT SUM(C)
                             FROM ((SELECT crse_credits AS C
                             FROM mandatory_courses
                             INNER JOIN  student_record USING(crse_label)
                             WHERE student_record.stdnt_number = '$id' AND (crseR_status = 1 OR crse_status = 3))
                             UNION ALL
                             (SELECT crse_credits AS C
                             FROM general_courses
                             INNER JOIN student_record USING(crse_label)
                             WHERE student_record.stdnt_number = '$id' AND (crseR_status = 1 OR crse_status = 3))
                             UNION ALL (SELECT crse_credits AS C
                             FROM departmental_courses
                             INNER JOIN student_record USING(crse_label)
                             WHERE student_record.stdnt_number = '$id' AND (crseR_status = 1 OR crse_status = 3))
                             UNION ALL (SELECT crse_credits AS C
                             FROM free_courses
                             INNER JOIN student_record USING(crse_label)
                             WHERE student_record.stdnt_number = '$id' AND (crseR_status = 1 OR crse_status = 3))) t1";
                             $resultRecom = mysqli_query($conn, $sentenciaSQL);
                             $reco=mysqli_fetch_assoc($resultRecom);
                         
                       if ($reco['SUM(C)'] === NULL){
                           $reco['SUM(C)'] = 0;
                       }

                       $sql= "SELECT conducted_counseling FROM student_record_details WHERE stdnt_number = '$id'";
                             $result_couns = mysqli_query($conn, $sql);
                             $resultCheck_couns = mysqli_num_rows($result_couns);
                             $counseling = mysqli_fetch_assoc($result_couns);
                             echo "
                                <div class='btn-group'>

                                <div class='container'>
                                <br>";
                                if($counseling["conducted_counseling"] == 0){
                                  echo"
                                  <!-- Trigger the modal with a button -->
                                  <div class='login-btn-container' align='center'><button type='button' class='btn btn-yellow btn-pill' data-toggle='modal' data-target='#myModal'>CONFIRMAR</button></div>";
                                }else{
                                  echo"
                                <div class='login-btn-container' align='center'><a class='btn btn-yellow btn-pill' href='pdf.php'>
                                        <i class='fa fa-file' aria-hidden='true'>&nbsp; DESCARGUE SU EXPEDIENTE</i>
                                </a></div>";
                                }
                                echo "
                                  <!-- Modal -->
                                  <div class='modal fade' id='myModal' role='dialog'>
                                    <div class='modal-dialog'>

                                      <!-- Modal content-->
                                      <div class='modal-content'>
                                        <div class='modal-header'>
                                          <h3>Próximo Semestre</h3>
                                          <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                        </div>
                                        <div class='modal-body'>
                                        <table id='example2' class='table table-bordered table-hover'>
                                      <thead>
                                      <form action='private/confirmacion.php' method='POST'>
                                      <tr width='50%'' bgcolor='yellow'>
                                        <th><input type='checkbox' onClick='toggle(this)' class='case' name='case' /></th>
                                        <th>Cursos</th>
                                        <th>Descripción</th>
                                        <th>Créditos</th>
                                      </tr>
                                      </thead> 
                                    <tbody>";
                                    $sql ="SELECT crse_label, crse_name, crse_description, crse_credits
                                    FROM student_record
                                    INNER JOIN mandatory_courses USING (crse_label)
                                    WHERE student_record.stdnt_number = '$id' AND (student_record.crseR_status = 1 OR student_record.crse_status = 3)
                                    UNION(SELECT crse_label, crse_name, crse_description, crse_credits
                                    FROM student_record
                                    INNER JOIN general_courses USING (crse_label)
                                    WHERE student_record.stdnt_number = '$id' AND (student_record.crseR_status = 1 OR student_record.crse_status = 3))
                                    UNION(SELECT crse_label, crse_name, crse_description, crse_credits
                                    FROM student_record
                                    INNER JOIN departmental_courses USING (crse_label)
                                    WHERE student_record.stdnt_number = '$id' AND (student_record.crseR_status = 1 OR student_record.crse_status = 3))
                                    UNION(SELECT crse_label, crse_name, crse_description, crse_credits
                                    FROM student_record
                                    INNER JOIN free_courses USING (crse_label)
                                    WHERE student_record.stdnt_number = '$id' AND (student_record.crseR_status = 1 OR student_record.crse_status = 3))";
                                        $result = mysqli_query($conn, $sql);
                                        $resultCheck = mysqli_num_rows($result);

                                        $sql_adi ="SELECT * from counseling_special_details WHERE stdnt_number = '$id' AND crse_confirmation = 0";
                                            $result_adi = mysqli_query($conn, $sql_adi);
                                            $resultCheck_adi = mysqli_num_rows($result_adi);
    

                                    if($resultCheck > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                      echo "<tr width='50%' style='background-color: rgb(155,155,155,0.3)'>
                                        <td><input type='checkbox' class='case' name='crse_label[]' id='crse_label[]' value='{$row['crse_label']}' /> </td>
                                        <input type='hidden' name='clase' value='general'>
                                        <td>{$row['crse_name']}</td>
                                        <td>{$row['crse_description']}</td>
                                        <td>{$row['crse_credits']}</td>
                                      </tr> ";
                                    
                                    }}
                                    if($resultCheck_adi > 0){
                                      while($row = mysqli_fetch_assoc($result_adi)){
                                        if($row['crse_suggestionHUMA'] == 5){
                                          echo "<tr width='50%' style='background-color: rgb(155,155,155,0.3)'>
                                          <td><input type='checkbox' class='case' name='crse_label[]' id='crse_label[]' value='{$row['crse_label']}' /> </td>
                                          <input type='hidden'  name='clase' value='HUMA'>
                                          <td>HUMA</td>
                                          <td>-</td>
                                          <td>-</td>
                                        </tr> ";
                                          }elseif($row['crse_suggestionCISO'] == 5){
                                            echo "<tr width='50%' style='background-color: rgb(155,155,155,0.3)'>
                                            <td><input type='checkbox' class='case' name='crse_label[]' id='crse_label[]' value='{$row['crse_label']}' /> </td>
                                            <input type='hidden'  name='clase' value='CISO'>
                                            <td>HUMA</td>
                                            <td>-</td>
                                            <td>-</td>
                                          </tr> ";
                                            }elseif($row['crse_suggestionFREE'] == 5){
                                              echo "<tr width='50%' style='background-color: rgb(155,155,155,0.3)'>
                                              <td><input type='checkbox' class='case' name='crse_label[]' id='crse_label[]' value='{$row['crse_label']}' /> </td>
                                              <input type='hidden'  name='clase' value='FREE'>
                                              <td>HUMA</td>
                                              <td>-</td>
                                              <td>-</td>
                                            </tr> ";
                                              }elseif($row['crse_suggestionDEP'] == 5){
                                                echo "<tr width='50%' style='background-color: rgb(155,155,155,0.3)'>
                                                <td><input type='checkbox' class='case' name='crse_label[]' id='crse_label[]' value='{$row['crse_label']}' /> </td>
                                                <input type='hidden'  name='clase' value='DEP'>
                                                <td>HUMA</td>
                                                <td>-</td>
                                                <td>-</td>
                                              </tr> ";
                                                }
                                      }}
                                    echo "<tr width='50%' style='background-color: rgb(155,155,155,0.3)'>
                                        <td><input type='checkbox' class='case' name='otros' id='otros' value='otros' /> </td>
                                        <td>Otros</td>
                                        <td></td>
                                        <td></td>
                                      </tr> ";

                                    echo "</tbody> 
                                      </table>
                                       Créditos Recomendados: {$reco['SUM(C)']}
                                                        </div>
                                        <div class='modal-footer'><br>
                                          <div class='login-btn-container'><button onclick='confirmar()' name='confirm-submit' style='float: right;' type='submit' class='btn btn-yellow btn-pill' data-toggle='modal' data-target='#myModal'>CONFIRMAR</button></div>
                                        </form>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                          </div>";
                            ?>
<!-- Termina el MODAL del boton confirmar. -->
 <!-- Comienza el student_record academico del student. -->
              <div class="card-body"> 
                <div align = "center"><h3>Cursos de Concentración</h3></div>
                <table id="example2" class="table table-bordered table-hover" style="color:#000">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencias</th>
                  </tr>
                  </thead> 
                  <tbody>
                <?php 
                $sql ="SELECT *
                   FROM mandatory_courses INNER JOIN student_record USING (crse_label) WHERE stdnt_number = '$id'
                   ORDER by crse_label";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  
                  
                  echo "<tr width='50%' style='background-color: #e3e4e5'>";
                  
                    echo "<td>{$row['crse_name']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row['crse_grade']}</td>";
                    if($row['crseR_status'] == 1){
                    echo "<td>Prox. Semestre</td>";
                    }else{
                    echo "<td></td>";}
                    echo "
                    <td>{$row['semester_pass']}</td>";
                    if(($row['crse_equivalence'] != NULL) || ($row['crse_recognition'] != NULL) && ($row['crse_ER_Status'] != 1)){
                      echo"
                    <td><button onclick='myFunction({$row['crse_label']})' class='yellow-button' style='color:white; width : 100%'>Confirmar Proceso</button></td>";
                  }elseif($row['crse_equivalence'] != NULL || $row['crse_recognition'] != NULL){
                    echo"
                    <td>{$row['crse_equivalence']}{$row['crse_recognition']}</td>";
                  }else{
                    echo"
                    <td></td>";
                  }
                  echo"
                  </tr>";}}?>  
                </tbody> 
                  </table>
                  <div align = "center"><h3>Cursos Generales Obligatorios</h3></div>
                    <table id="example2" class="table table-bordered table-hover" style="color:#000">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencias</th>
                  </tr>
                  </thead> 
                  <tbody>
                <?php 
                $sql ="SELECT *
                   FROM general_courses INNER JOIN student_record USING (crse_label) WHERE stdnt_number = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
            
                  echo "<tr width='50%' style='background-color: #e3e4e5'>";
                  
                    echo "<td>{$row['crse_name']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row['crse_grade']}</td>";
                    if($row['crseR_status'] == 1){
                      echo "<td>Prox. Semestre</td>";
                      }else{
                      echo "<td></td>";}
                      echo "
                    <td>{$row['semester_pass']}</td>";
                    if(($row['crse_equivalence'] != NULL) || ($row['crse_recognition'] != NULL) && ($row['crse_ER_Status'] != 1)){
                      echo"
                    <td><button onclick='myFunction({$row['crse_label']})' class='yellow-button' style='color:white; width : 100%'>Confirmar Proceso</button></td>";
                  }elseif($row['crse_equivalence'] != NULL || $row['crse_recognition'] != NULL){
                    echo"
                    <td>{$row['crse_equivalence']}{$row['crse_recognition']}</td>";
                  }else{
                    echo"
                    <td></td>";
                  }
                  echo"
                  </tr>";}}?>
                </tbody>
                  </table>
                   <div align = "center"><h3>Electivas Libres</h3></div>
                    <table id="example2" class="table table-bordered table-hover" style="color:#000">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencias</th>
                  </tr>
                  </thead> 
                <tbody>
                <?php 
                $sql ="SELECT *
                   FROM free_courses INNER JOIN student_record USING (crse_label) WHERE stdnt_number = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  
                  
                  echo "<tr width='50%' style='background-color: #e3e4e5'>";
                
                    echo "<td>{$row['crse_name']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row['crse_grade']}</td>";
                    if($row['crseR_status'] == 1){
                      echo "<td>Prox. Semestre</td>";
                      }else{
                      echo "<td></td>";}
                      echo "
                    <td>{$row['semester_pass']}</td>
                    <td></td>
                  </tr> ";}}?>
                </tbody> 
                  </table>
                   <div align = "center"><h3>Electivas Departamentales</h3></div>
                    <table id="example2" class="table table-bordered table-hover" style="color:#000">
                     <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencias</th>
                  </tr>
                  </thead> 
                <tbody>
                <?php 
                $sql ="SELECT *
                   FROM departmental_courses INNER JOIN student_record USING (crse_label) WHERE stdnt_number = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                  
                
                  echo "<tr width='50%' style='background-color: #e3e4e5'>";
                  
                    echo "<td>{$row['crse_name']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row['crse_grade']}</td>";
                    if($row['crseR_status'] == 1){
                      echo "<td>Prox. Semestre</td>";
                      }else{
                      echo "<td></td>";}
                      echo "
                    <td>{$row['semester_pass']}</td>";
                    if(($row['crse_equivalence'] != NULL) || ($row['crse_recognition'] != NULL) && ($row['crse_ER_Status'] != 1)){
                      echo"
                    <td><button onclick='myFunction({$row['crse_label']})' class='yellow-button' style='color:white; width : 100%'>Confirmar Proceso</button></td>";
                  }elseif($row['crse_equivalence'] != NULL || $row['crse_recognition'] != NULL){
                    echo"
                    <td>{$row['crse_equivalence']}{$row['crse_recognition']}</td>";
                  }else{
                    echo"
                    <td></td>";
                  }
                  echo"
                  </tr>
                  
                            <!-- Modal de Equivalencias y Convalidaciones -->
                            <!-- Convalidacion-Equivalencia -->
                  <div id='equi-conv' class='w3-modal'>
                      <div class='w3-modal-content w3-animate-zoom' style='margin-top:10%; margin-bottom'>
                        <header class='w3-container' style='padding-top:5px'>
                          <span onclick='equi_conv()'
                          class='w3-button w3-display-topright'>&times;</span>
                          <h3>Convalidación/Equivalencias</h3>
                        </header>
                        <form method='post' action='private/confirm_equi_conv.php'>
                        <div class='w3-container'>
                        <div class='grid-container' style='margin-bottom:20px; margin-top:20px;'>
                        <div class='item-1'><input type='radio' name='estatus' value='0'> No he iniciado proceso</input></div>
                        <div class='item-2'><input type='radio' name='estatus' value='2'> En Proceso: Ya envié los documentos</input></div>
                        <div class='item-3'><input type='radio' name='estatus' value='1'> Completado: Ya recibí respuesta</input></div>
                        </div>
                        </div>

                        <input type='hidden' name='stdnt_number' value='$id'>
                        <footer class='w3-container' style='padding-bottom:10px; padding-top:10px'>
                        <button id='conv_env_submit' type='submit' class='btn btn-default' name='conv_env-submit' value='' style='float:right; '>Confirmar</button>
                        </footer>
                        </form>
                      </div>
                    </div><!-- /.Convalidacion-Equivalencia -->
                <!-- /Modal -->";
                  }}?>
                    </table>
                    <div class='warning-message'><h4 style='text-align:center'>¡RECORDATORIO! Debe tomar 6 créditos en avanzada.</h4></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
<!-- Culmina la parte del student_record academico. -->          
<!-- TAB para appointment. El student puede realizar una cita con la profesora. Escoge el dia y la hora, para sacar la cita. -->
    <div id="appointment" class="tabcontent active">
    <section class="appointment">
    <form action="private/process-appointment.php" method="POST" class="appointment-form">                 
    <?php 
        include 'private/appointment-status.php';
        $sql ="SELECT appt_id FROM appointment WHERE stdnt_number = '$id'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
             
                if($resultCheck > 0){  
                echo '<div class="success-message">La cita con el/la consejero(a) fue separada para el '.$appt_date.'.</div>';
                } else {
                    if((isset($_GET['is-date-empty']) AND boolval($_GET['is-date-empty'])) OR (isset($_GET['is-hour-chosen-empty']) AND boolval($_GET['is-hour-chosen-empty']))){
                    echo '<div class="error-message">*Escoga el día y la hora de la cita.</div>';
                        }
                    echo ' 
                    <input type="hidden" name="first-name" value="'.$_SESSION['stdnt_name'].'" placeholder="First Name" class="form-control" readonly>
                    <input type="hidden" name="last-name" value="'.$_SESSION['stdnt_lastname1'].' '.$_SESSION['stdnt_lastname2'].'" placeholder="Last Name"  class="form-control" readonly>
                           <input type="hidden" name="email"  value="'.$_SESSION['stdnt_email'].'" class="form-control" readonly> 
                                 <h3>Escoger Fecha y Hora</h3>  <div class="form-group d-flex">
                                         <div class="calendar-box">';

                                                $dateField = '<input type="text" name="date" onchange="getAvailableDates(this.value)" id="datepicker"  type="text" class="form-control"/>';
                                                if(isset($_GET['is-date-empty']) AND boolval($_GET['is-date-empty'])){
                                                    $dateField = '<input type="text" name="date" onchange="getAvailableDates(this.value)" id="datepicker"  type="text" class="invalid"/>';
                                                } 
                                                echo $dateField;
                                            
                                        echo '<div class="hour-chosen-container"></div>
                                            </div>
                                            <div class="spots-available">
                                             </div>
                                             </div>
                                             <div class="login-btn-container"><button type="submit" class="btn btn-yellow btn-pill">Confirmar Cita</button></div>';
                                }
                           ?>
                        </form>
                </section>
                  </div>
<!-- Culmina la parte de los TABS para las appointment. -->          
<!-- Este es el TAB de Sugerencias del student. Donde podra sugerir las clases de Electiva departamentales y confirmar para dejarle saber a la profesora cuales esta el student sugiriendo solo las electivas departamentales. -->
         <div id="Sugerencias" class="tabcontent">
            <form action="private/sugerencias.php" method="POST">
            <section>
                <div class="table">
                <div class="container-table100">
                    <h2>Electivas Departamentales</h2>
                          <div class="wrap-table100">
                            <div class="table100 ver2 m-b-110">
                              <table data-vertable="ver1">
                                <thead>
                                  <tr class="row100 head">
                                    <th class="column100 column1" data-column="column1">Sugerencias</th>
                                    <th class="column100 column2" data-column="column2">Código</th>
                                    <th class="column100 column3" data-column="column3">Descripción</th>
                                    <th class="column100 column4" data-column="column4">Créditos</th>
                                    <th style="background: transparent; border: none" class="column100 column5" data-column="column5"><button onclick="sugerir()" name="suge-submit" type="submit" class="btn btn-yellow btn-pill">SUGERIR</button></th>
                                  </tr>
                                </thead>
                                
                                <tbody>
                                  <?php
                                    $sql ="SELECT crse_name, crse_description, crse_credits, crse_label
                                    FROM departmental_courses WHERE crse_id = 9";
                                  $result = mysqli_query($conn, $sql);
                                  $resultCheck = mysqli_num_rows($result);
                            
                              if($resultCheck > 0){
                              while($row = mysqli_fetch_assoc($result)){
                                  echo "<tr class='row100'>
                                    <td align='center'>
                                    <input type='checkbox' class='case' name='sugerencia[]' id='sugerencia' value='{$row['crse_label']}' /> </td>
                                    <td class='column100 column1' data-column='column1'>{$row['crse_name']}</td>
                                    <td class='column100 column2' data-column='column2'>{$row['crse_description']}</td>
                                    <td class='column100 column3' data-column='column3'>{$row['crse_credits']}</td>
                                  </tr>";
                              }
                            }
                                  ?>
                                </tbody>
                              </table>
                              
                            </div>
                            </div>
                          </div>            
                </div>
                
                </section>    
             </form>
           </div>
<!-- Culmina la parte de los TABS para las Sugerencias. -->           
<!-- Este es el TAB de Comentarios que le hace el advisor/a al student. Donde podra ver que le escribe el/la consejera sobre algun comentario adiconal que tenga que decirle al student. -->           
            <div id="Comentario" class="tabcontent">
                <!-- Notes -->
             <?php
                $sql ="SELECT adv_comments
                      FROM student_record_details WHERE stdnt_number = '$id'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                 
                    echo "
            <div class='card'>
              <div class='card-header' style='background: #e0c200'>
                <h3 class='card-title' >Notas</h3>
              </div>
                
              <div>

              <form id='paper' method='get' action=''>
		            <p  id='text' name='text' rows='' style='overflow-y: auto; word-wrap: break-word; resize: none; height: 400px;'>{$row['adv_comments']}</p>
              </form>
                
            </div>
            <!-- /.card -->
          </div>";}}
          ?>
            </div>
      </div> 

      
 <!-- Este SCRIPT es para bregar con las appointment (en calendario) indicando de que fecha a que fecha estara disponible ese calendario, con las horas y dias disponibles de los advisors a cargo. -->
  <script src="index.js"></script> 
        <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
        <script src="jqueryui/jquery-ui.js"></script>
        <script>
            $("#datepicker").datepicker({
                changeMonth: true,
                minDate: new Date(2020, 09, 4),
                maxDate: new Date(2020, 12, 15)
            });
        </script>

        <script>
            function getAvailableDates(date){
                var xmlhttp = new XMLHttpRequest();
                 xmlhttp.onreadystatechange = function() {
             if (this.readyState == 4 && this.status == 200) {
               document.querySelector('.spots-available').innerHTML  =  this.responseText;
             
            }
      }
      let dateFormatted = date.split('/').reverse();
      const temp = dateFormatted[1];
      dateFormatted[1] = dateFormatted[2];
      dateFormatted[2] = temp;
      dateFormatted = dateFormatted.join('-');
      
      xmlhttp.open("GET", "private/get-available-dates.php?date=" + dateFormatted, true);
      xmlhttp.send();
    };
    
       function getHourOfMeeting(hour){
        let editHour = hour.split(' ');
        editHour = editHour[0];
        
        
        let input = document.createElement("INPUT");
        input.setAttribute("type", "text");
        input.className = 'hour-chosen';
        input.name = "hour-chosen";
        input.setAttribute('value', editHour);
        input.readOnly = true;
        document.querySelector('.hour-chosen-container').innerHTML = 'Hora: ';
        document.querySelector('.hour-chosen-container').appendChild(input);
       }
        </script>
<!-- Culmina la parte del SCRIPT del calendario para sacar appointment -->
<!-- Script para seleccionar todos los checkbox -->
<script>
function toggle(source) {
              checkboxes = document.getElementsByName('crse_label[]');
              for(var i=0, n=checkboxes.length;i<n;i++) {
                  checkboxes[i].checked = source.checked;
              }
            }
</script>
<!-- Culmina scripts de checkbox -->

<!-- script de confirmacion de equivalencias y convalidaciones -->
          <script>
            function myFunction(className) {
                  console.log(className); 
                  document.getElementById("conv_env_submit").value = className;
                  document.getElementById('equi-conv').style.display='block';
            }

            function equi_conv() {
                  document.getElementById('equi-conv').style.display='none';
            }
          </script>
<!-- /script de equi_conv -->

<!-- Aqui se encuentran varios SCRIPTS que hacen el funcionamiento de la pagina. -->     
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/main.js"></script>
  <script src="js/consejeria.js"></script>  
  <script>function toggle(source) {
              checkboxes = document.getElementsByName('crse_label[]');
              for(var i=0, n=checkboxes.length;i<n;i++) {
                  checkboxes[i].checked = source.checked;
              }}
  </script>
<!-- Culmina la parte de los JS. -->
</div>
</body>
</html>