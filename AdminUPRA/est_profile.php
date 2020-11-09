<?php
session_start();
include("inc/connection.php");
$id = $_SESSION['stdnt_number'];
$id= $_SESSION['id'];
$name = $_SESSION['name'];

if(!isset($_SESSION['id'])){
  header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CONSEJERIA-UPRA | EXP.student</title>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- page css -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  <link rel="stylesheet" href="../css/conse.css">

  <style>
    #drop_zone {
            background-color: #EEE;
            border: #999 5px dashed;
            width: 100%;
            height: 30rem;
            padding: 8px;
            font-size: 18px;
        }

        .grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto;
  grid-gap: 10px;
  background-color: transparent;
  padding: 10px;
}

.grid-container > div {
  background-color: transparent;
  text-align: center;
  padding: 20px 0;
  font-size: 30px;
}

@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro);

body {
  background: #ffffff; 
  color: #414141;
  font: 400 17px/2em 'Source Sans Pro', sans-serif;
}

.select-box {
  cursor: pointer;
  position : relative;
  max-width:  20em;
  margin: 1rem auto;
  width: 100%;
}


#course-list {
  background-color: #ececec;
  padding: 0.5rem 1rem;
  width: 100%;
  border-radius: 0.5rem;
    font-size: 1.25rem;
}

.select,
.label {
  color: #414141;
  display: block;
  font: 400 17px/2em 'Source Sans Pro', sans-serif;
}

.select {
  width: 100%;
  position: absolute;
  top: 0;
  padding: 5px 0;
  height: 40px;
  opacity: 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  background: none transparent;
  border: 0 none;
}
.select-box1 {
  background: #ececec;

}

.label {
  position: relative;
  padding: 5px 10px;
  cursor: pointer;
}
.open .label::after {
   content: "▲";
}
.label::after {
  content: "▼";
  font-size: 12px;
  position: absolute;
  right: 0;
  top: 0;
  padding: 5px 15px;
  border-left: 5px solid #fff;
}
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

   <!-- Navbar -->
   <nav class="main-header navbar navbar-expand upra-amarillo navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.html" class="nav-link">Inicio</a>
      </li>
    </ul>
  </nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio.php" class="brand-link">
      <img src="img/university.jpg" alt="UPRA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CONSEJERIA UPRA</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
        <?php $sql = "SELECT adv_name, adv_lastnameU, adv_lastnameD FROM `advisor` WHERE adv_id = $id";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
              
                if($resultCheck > 0){
                $row = mysqli_fetch_assoc($result);
                ;}
            ?>
          <?php echo "<a class='d-block'>{$row['adv_name']} {$row['adv_lastnameU']} {$row['adv_lastnameD']}</a>" ?>
        </div>
      </div>
<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
            <a href="inicio.php" class="nav-link">
               <i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <p>Inicio</p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="lista.php" class="nav-link">
               <i class="fas fa-stopwatch-20"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <p>Lista de Conteo de Clases</p>
            </a>
          </li>
           <li class="nav-item has-treeview menu-open">
            <a href="calendar.php" class="nav-link">
               <i class="far fa-calendar-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <p>Calendario</p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open"><a href="../private/logout_admin.php" class="nav-link">
              <i class="fa fa-sign-out-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;
              <p>Cerrar Sesión</p>
            </a></li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">file Académico del student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio.php">Inicio</a></li>
              <li class="breadcrumb-item active">file Académico del student</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary" style="border-top: 3px solid #e0c200;">
              <div class="card-body box-profile">
                    <?php
                    $sql = "SELECT stdnt_number, stdnt_email, stdnt_number, stdnt_lastname1, stdnt_lastname2, stdnt_name, stdnt_initial, crse_label
                    FROM student WHERE stdnt_number = $id";
                  $result = mysqli_query($conn, $sql);
                  $resultCheck = mysqli_num_rows($result);
            
                $sentenciaSQL= "SELECT SUM(C)
                FROM ((SELECT crse_credits AS C
                FROM mandatory_courses
                INNER JOIN  student_record USING(crse_label)
                WHERE student_record.stdnt_number = $id)
                UNION ALL
                (SELECT crse_credits AS C
                FROM general_courses
                INNER JOIN student_record USING(crse_label)
                WHERE student_record.stdnt_number = $id)
                UNION ALL (SELECT crse_credits AS C
                FROM departmental_courses
                INNER JOIN student_record USING(crse_label)
                WHERE student_record.stdnt_number = $id)
                UNION ALL (SELECT crse_credits AS C
                FROM free_courses
                INNER JOIN student_record USING(crse_label)
                WHERE student_record.stdnt_number = $id)) t1";
                $resultSUM = mysqli_query($conn, $sentenciaSQL);
                $creditos=mysqli_fetch_assoc($resultSUM);
                if ($creditos['SUM(C)']=== NULL){
                  $creditos['SUM(C)']=0;
              }
               
           
              if($resultCheck > 0){
              $row = mysqli_fetch_assoc($result);
               echo "<h3 class='profile-username text-center'>{$row['stdnt_name']} {$row['stdnt_lastname1']} {$row['stdnt_lastname2']}</h3>
                <p class='text-muted text-center'>{$row['stdnt_email']}</p>
                <p class='text-muted text-center'>{$row['stdnt_number']}</p>
                <ul class='list-group list-group-unbordered mb-3'>
                  <li class='list-group-item'>
                    <b>Créditos Aprobados</b> <a class='float-right'>{$creditos['SUM(C)']}</a>
                  </li>
                  <li class='list-group-item'>
                    <b>Año</b> <a class='float-right'>4</a>
                  </li>
                  <li class='list-group-item'>
                    <b>Secuencia:</b> <a class='float-right'>{$row['crse_label']}</a>
                  </li>
                   
                </ul>";?>
                <button onclick="document.getElementById('id02').style.display='block'" class="w3-button w3-round-xlarge upra-amarillo" style="color:white; width : 100%">Actualizar file</button>
              <?php
                echo "</div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           
            <!-- About Me Box -->
            <div class='card' >
              <div class='card-header' style='background: #e0c200'>
                <h3 class='card-title' >Notas</h3>
              </div>
              <!-- /.card-header -->
              <div>

              <form id='paper' method='get' action=''>
           <textarea placeholder='Escribe una nota aqui.' id='text' name='text' rows='' style='overflow-y: auto; word-wrap: break-word; resize: none; height: 400px;'></textarea>
              </div><button type='submit' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%;'>Crear</button>
              </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>";
              }
          ?>
          <script>
              $(document).ready(function(){
                 $('#text').autosize();
            });
            </script>
          <!-- /.col -->
          <div class="card" id="style-2" style="overflow-y: scroll; overflow-x: auto; height: 850px; width: 75%;border-top: 3px solid #e0c200;">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div align='center'><h3>UNIVERSIDAD DE PUERTO RICO EN ARECIBO</h3>
                                    <h3>DEPARTAMENTO DE CIENCIAS DE CÓMPUTOS</h3>
                                    <h3>EVALUACIÓN BACHILLERATO EN CIENCIAS DE CÓMPUTOS</h3></div>
            </div>
                
                <!-- /.Comienzo de file del student -->
            <div class="container tables">
                <div class="tab">
                    <button class="tablinks active" onclick="openCity(event, 'file')">file del student</button>
                    <button class="tablinks" onclick="openCity(event, 'Examinar')">Cursos a Examinar</button>
                  </div>
                
                  <!-- Tab content -->
    <div id="file" class="tabcontent active">
    <section class="content">
      <div class="card-body">
                <div align = "center"><h3>Cursos de Concentración <a href="#"><i class="far fa-edit" onclick="document.getElementById('id01').style.display='block'"></i></a></h3></div>
<!-- </div>   -->
                <br>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencia</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php
                   $sql ="SELECT crse_label, crse_name, crse_description, crse_credits, crse_grade, crse_status, semester_pass, estatus_R
                   FROM mandatory_courses INNER JOIN student_record USING (crse_label) WHERE stdnt_number = $id
                   UNION
                   (SELECT crse_label, crse_name, crse_description, crse_credits, '', '', '', ''
                   FROM mandatory_courses WHERE crse_label 
                   NOT IN (SELECT crse_label
                   FROM student_record WHERE student_record.stdnt_number = $id))";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
             
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                 
                  if($row['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: rgb(85,255,0,0.3)'>"; 
                  }else if ($row['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: rgb(51,85,255,0.3)'>"; 
                  }else{
                  echo "<tr width='50%' style='background-color: rgb(230,0,38,0.3)'>";
                  }
                    echo "<td>{$row['crse_name']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row['crse_grade']}</td>";
                    if($row['estatus_R'] == 1){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$id'>
                      <input type='hidden' id='crse_label' name='crse_label' value='{$row['crse_label']}'>
                      <input type='hidden' id='estatus_R' name='estatus_R' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#c72837;  width : 100%'>recomendada</button></td>
                      </form>";
                    }else if($row['crse_status'] == 0){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$id'>
                      <input type='hidden' id='crse_label' name='crse_label' value='{$row['crse_label']}'>
                      <input type='hidden' id='estatus_R' name='estatus_R' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#10c13f;  width : 100%'>recomendar</button></td>
                      </form>";
                    }else{
                      echo "<td><p style= 'margin-left : 50%'>—</p></td>";
                    }
                    echo"
                    <td>{$row['semester_pass']}</td>
                    <td></td>
                  </tr> ";}}?>
 
                     
                </tbody>
                  </table>
                  <br>
                  <div align = "center"><h3>Cursos Generales Obligatorios <a href="#"><i class="far fa-edit" onclick="document.getElementById('id01').style.display='block'"></i></a></h3></div>
                  <br>
                    <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencia</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php
                $sql ="SELECT crse_label, crse_name, crse_description, crse_credits, crse_grade, crse_status, semester_pass, estatus_R
                FROM general_courses INNER JOIN student_record USING (crse_label) WHERE stdnt_number = $id
                UNION
                (SELECT crse_label, crse_name, crse_description, crse_credits, '', '', '', ''
                FROM general_courses WHERE crse_label 
                NOT IN (SELECT crse_label
                FROM student_record WHERE student_record.stdnt_number = $id))";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
             
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                 
                  if($row['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: rgb(85,255,0,0.3)'>"; 
                  }else if ($row['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: rgb(51,85,255,0.3)'>"; 
                  }else{
                  echo "<tr width='50%' style='background-color: rgb(230,0,38,0.3)'>";
                  }
                    echo "<td>{$row['crse_name']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row['crse_grade']}</td>
                    ";
                    if($row['estatus_R'] == 1){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$id'>
                      <input type='hidden' id='crse_label' name='crse_label' value='{$row['crse_label']}'>
                      <input type='hidden' id='estatus_R' name='estatus_R' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#c72837;  width : 100%'>recomendada</button></td>
                      </form>";
                    }else if($row['crse_status'] == 0){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$id'>
                      <input type='hidden' id='crse_label' name='crse_label' value='{$row['crse_label']}'>
                      <input type='hidden' id='estatus_R' name='estatus_R' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#10c13f;  width : 100%'>recomendar</button></td>
                      </form>";
                    }else{
                      echo "<td><p style= 'margin-left : 50%'>—</p></td>";
                    }
                    echo"
                    <td>{$row['semester_pass']}</td>
                    <td></td>
                  </tr> ";}}?>
                </tbody>
                  </table>
                  <br>
                   <div align = "center"><h3>Electivas Libres <a href="#"><i class="far fa-edit" onclick="document.getElementById('id01').style.display='block'"></i></a></h3></div>
                   <br>
                    <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencia</th>
                  </tr>
                  </thead>
                <tbody>
                <?php
                $sql ="SELECT crse_label, crse_name, crse_description, crse_credits, crse_grade, crse_status, semester_pass, estatus_R
                FROM free_courses INNER JOIN student_record USING (crse_label) WHERE stdnt_number = $id
                UNION
                (SELECT crse_label, crse_name, crse_description, crse_credits, '', '', '', ''
                FROM free_courses WHERE crse_label 
                NOT IN (SELECT crse_label
                FROM student_record WHERE student_record.stdnt_number = $id))";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
             
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                 
                  if($row['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: rgb(85,255,0,0.3)'>"; 
                  }else if ($row['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: rgb(51,85,255,0.3)'>"; 
                  }else{
                  echo "<tr width='50%' style='background-color: rgb(230,0,38,0.3)'>";
                  }
                    echo "<td>{$row['crse_name']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row['crse_grade']}</td>
                    ";
                    if($row['estatus_R'] == 1){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$id'>
                      <input type='hidden' id='crse_label' name='crse_label' value='{$row['crse_label']}'>
                      <input type='hidden' id='estatus_R' name='estatus_R' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#c72837;  width : 100%'>recomendada</button></td>
                      </form>";
                    }else if($row['crse_status'] == 0){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$id'>
                      <input type='hidden' id='crse_label' name='crse_label' value='{$row['crse_label']}'>
                      <input type='hidden' id='estatus_R' name='estatus_R' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#10c13f;  width : 100%'>recomendar</button></td>
                      </form>";
                    }else{
                      echo "<td><p style= 'margin-left : 50%'>—</p></td>";
                    }
                    echo"
                    <td>{$row['semester_pass']}</td>
                    <td></td>
                  </tr> ";}}?>
                </tbody>
                  </table>
                  <br>
                   <div align = "center"><h3>Electivas Departamentales <a href="#"><i class="far fa-edit" onclick="document.getElementById('id01').style.display='block'"></i></a></h3></div>
                   <br>
                    <table id="example2" class="table table-bordered table-hover">
                     <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Recomendación</th>
                    <th>Año Aprobó</th>
                    <th>Convalidación/Equivalencia</th>
                  </tr>
                  </thead>
                <tbody>
                <?php
                $sql ="SELECT crse_label, crse_name, crse_description, crse_credits, crse_grade, crse_status, semester_pass, estatus_R
                FROM departmental_courses INNER JOIN student_record USING (crse_label) WHERE stdnt_number = $id
                UNION
                (SELECT crse_label, crse_name, crse_description, crse_credits, '', '', '', ''
                FROM departmental_courses WHERE crse_label 
                NOT IN (SELECT crse_label
                FROM student_record WHERE student_record.stdnt_number = $id))";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
             
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                 
                  if($row['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: rgb(85,255,0,0.3)'>"; 
                  }else if ($row['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: rgb(51,85,255,0.3)'>"; 
                  }else{
                  echo "<tr width='50%' style='background-color: rgb(230,0,38,0.3)'>";
                  }
                    echo "<td>{$row['crse_name']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row['crse_grade']}</td>
                    ";
                    if($row['estatus_R'] == 1){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$id'>
                      <input type='hidden' id='crse_label' name='crse_label' value='{$row['crse_label']}'>
                      <input type='hidden' id='estatus_R' name='estatus_R' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#c72837;  width : 100%'>recomendada</button></td>
                      </form>";
                    }else if($row['crse_status'] == 0){
                      echo "<form action='inc/recommend.php' method='post'>
                      <input type='hidden' id='stdnt_number' name='stdnt_number' value='$id'>
                      <input type='hidden' id='crse_label' name='crse_label' value='{$row['crse_label']}'>
                      <input type='hidden' id='estatus_R' name='estatus_R' value='1'>
                      <td><button onclick='recommend()' name='rec-submit' class='w3-button w3-round-xlarge' style='color:white; background-color:#10c13f;  width : 100%'>recomendar</button></td>
                      </form>";
                    }else{
                      echo "<td><p style= 'margin-left : 50%'>—</p></td>";
                    }
                    echo"
                    <td>{$row['semester_pass']}</td>
                    <td></td>
                  </tr> ";}}?>

                    </table>
                 
              </div>
 
    </section>
    </div>
                <!-- /.Final de file del student -->
                
                
       <!-- Comienzo de Examinar -->  
   <div id="Examinar" class="tabcontent">
            <section>
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr width="50%" bgcolor="#e0c200">
                    <th>Cursos</th>
                    <th>Descripción</th>
                    <th>Créditos</th>
                    <th>Nota</th>
                    <th>Semestre Aprobó</th>
                    <th>Acomodar</th>
                  </tr>
                  </thead>
                <tbody>
                <?php
                $sql ="SELECT stdnt_number, crse_name, crse_description, crse_credits, crse_grade, semester_pass, crse_status
                   FROM free_courses INNER JOIN student_record USING (crse_label) WHERE special_id = 2 AND stdnt_number = $id";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);
                  $modal = 'document.getElementById("id03").style.display="block"';
                if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                 
                  if($row['crse_status'] == 1){
                    echo "<tr width='50%' style='background-color: rgb(100,149,237,0.3)'>";
                  }else if ($row['crse_status'] == 2){
                    echo "<tr width='50%' style='background-color: rgb(237,99,124,0.3)'>";
                  }else{
                  echo "<tr width='50%'>";}
                    echo "<td>{$row['crse_name']}</td>
                    <td>{$row['crse_description']}</td>
                    <td>{$row['crse_credits']}</td>
                    <td>{$row['crse_grade']}</td>
                    <td>{$row['semester_pass']}</td>
                    <td><button onclick='$modal' class='w3-button w3-round-xlarge upra-amarillo' style='color:white; width : 100%'>Acomodar</button></td>
                  </tr>";}}?>
                </tbody>
                  </table>
            </section>    
         </div>
      </div>
              <!-- /.Final de Examinar -->  
                


            <!-- Modals -->



            <!-- Edit -->
    <div id="id01" class="w3-modal" style="padding-left:20%">
    <div class="w3-modal-content w3-animate-zoom">
      <header class="w3-container" style="padding-top:5px">
        <span onclick="document.getElementById('id01').style.display='none'"
        class="w3-button w3-display-topright">&times;</span>
        <h3>Editar</h3>
      </header>
      <div class="w3-container">
          <br>
      <form action='edtiest.php' method='post'>
                          <div class='input-group mb-3'>
                          <input type='text' name='item_id' class='form-control' placeholder='CURSO'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-chalkboard-teacher'></span>
                            </div>
                          </div>
                        </div>
                                                                     
                         <div class='input-group mb-3'>
                          <input type='text' name='item_id' class='form-control' placeholder='CAMBIAR NOMBRE AL CURSO'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-chalkboard-teacher'></span>
                            </div>
                          </div>
                        </div>

                          <div class='input-group mb-3'>
                              <textarea rows='4' cols='50' name='description' class='form-control' placeholder='DESCRIPCIÓN'></textarea>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fa fa-font'></span>
                            </div>
                          </div>
                        </div>

                          <div class='input-group mb-3'>
                          <input type='text' name='item_id' class='form-control' placeholder='NOTA'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-clipboard'></span>
                            </div>
                          </div>
                        </div>
                                                           
                          <div class='input-group mb-3'>
                          <input type='text' name='name' class='form-control' placeholder='MATRICULADO'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-user'></span>
                            </div>
                          </div>
                        </div>
                                                       
                          <div class='input-group mb-3'>
                          <input type='text' name='name' class='form-control' placeholder='RECOMENDACIÓN'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-comment-dots'></span>
                            </div>
                          </div>
                        </div>
                                                               
                          <div class='input-group mb-3'>
                          <input type='text' name='name' class='form-control' placeholder='AÑO APROBADO'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-comment-dots'></span>
                            </div>
                          </div>
                        </div>
                          <div class='input-group mb-3'>
                          <input type='text' name='name' class='form-control' placeholder='CONVALIDACIÓN'>
                          <div class='input-group-append'>
                            <div class='input-group-text'>
                              <span class='fas fa-comment-dots'></span>
                            </div>
                          </div>
                        </div>
          </form>           
      </div>                                                     
      <footer class="w3-container" style="padding-bottom:10px; padding-top:0px">
      <button type='button' class='btn btn-default' data-dismiss='modal' style="float:right; ">APLICAR</button> 
      </footer>   
    </div>
  </div>

            <!-- /.Edit -->

            <!-- file -->
  <div id='id02' class='w3-modal' style='padding-left:20%'>
            <div class='w3-modal-content w3-animate-zoom'>
              <header class='w3-container' style='padding-top:5px'>
                <span onclick='document.getElementById("id02").style.display="none"'
                class='w3-button w3-display-topright'>&times;</span>
                <h3>Subir file</h3>
              </header>
              <div class='w3-container'>
                  <br>
                <div id="drop_zone" ondrop="uploadFile(event)" ondragover="return false">
                <div style="margin: auto; width: 50%; padding-left: 7rem; padding-top: 13rem;">
                  <input type="file" id="myfile" name="myfile">
                          </div>
                </div>   
              </div>
              <footer class='w3-container' style='padding-bottom:10px; padding-top:10px'>
              <button type='button' class='btn btn-default' onclick='history.go(0)' style='float:right; '>APLICAR</button>
              </footer>
            </div>
          </div>
            <!-- /.file -->
            <!-- Cursos a Examinar -->
          <div id='id03' class='w3-modal' style='padding-left:20%'>
            <div class='w3-modal-content w3-animate-zoom'>
              <header class='w3-container' style='padding-top:5px'>
                <span onclick='document.getElementById("id03").style.display="none"'
                class='w3-button w3-display-topright'>&times;</span>
                <h3>Acomodar</h3>
              </header>
              <div class='w3-container'>
                  <br>
                <form action="conv_env.php" method="POST">
                <div class="grid-container">
                <div class='item-1'>
                          <button type="button" name="tabla" value="1" class='btn btn-primary' style="width: 100%; color: white">
                              <i class='fas fa-pencil-alt'></i>
                              Concentración
                  </button>
                  </div>
                <div class='item-2'>
                          <button type="button" name="tabla" value="2" class='btn btn-warning' style="width: 100%; color: white">
                              <i class='fas fa-pencil-alt'></i>
                              General Obli.
                  </button>
                  </div>
                          <div class='item-3'>
                          <button type="button" name="tabla" value="3" class='btn btn-danger'style="width: 100%; color: white">
                             <i class='fas fa-pencil-alt'></i>
                              Elect. Dept.
                  </button>
                        </div>
                        <div class='item-4'>
                          <button type="button" name="tabla" value="4" class='btn btn-info' style="width: 100%; color: white">
                              <i class='fas fa-pencil-alt'></i>
                              Elect. Libre
                  </button>
                        </div>
                  </div>
              </div>
              <div class="grid-container" style="margin-left:18%">
              <div class='item-1'>
                    <input type="radio" name="tipo" value="convalidacion"> Convalidación</input>
                  </div>
                  <div class='item-2'>
                    <input type="radio" name="tipo" value="equivalencia"> Equivalencia</input>
                  </div>
              </div>
              <div class="select-box">
                
                      
          <select name="courses" id="course-list">
          <?php
                $sql ="SELECT crse_name, crse_label
                FROM mandatory_courses";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                 if($resultCheck > 0){
                while($row = mysqli_fetch_assoc($result)){
                echo "<option value='{$row['crse_label']}'>{$row['crse_name']}</option>";
                }} 
                
                ?>
          </select>

              </div>
              <footer class='w3-container' style='padding-bottom:10px; padding-top:10px'>
              <button type='submit' class='btn btn-default' onclick='conv_env()' name='conv_env-submit' style='float:right;'>APLICAR</button>
              </form>
              </footer>
            </div>
          </div>
            <!-- /.Cursos a Examinar -->
            
            <!-- /.Modals -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<script>
        function openCity(evt, clase) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(clase).style.display = "block";
          evt.currentTarget.className += " active";
        }
        </script>
<script>
    function $(el){
        return document.getElementById(el);
    }

    function uploadFile(event){
    event.preventDefault();
    var file = event.dataTransfer.files[0];
// alert(file.name+" | "+file.size+" | "+file.type);
var formdata = new FormData();
formdata.append("file1", file);
var ajax = new XMLHttpRequest();
ajax.upload.addEventListener("progress", progressHandler, false);
ajax.addEventListener("load", completeHandler, false);
ajax.addEventListener("error", errorHandler, false);
ajax.addEventListener("abort", abortHandler, false);
ajax.open("POST", "../private/file_upload_parser.php");
ajax.send(formdata);

    }

    function progressHandler(event){
$("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
var percent = (event.loaded / event.total) * 100;
$("progressBar").value = Math.round(percent);
$("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
    }

    function completeHandler(event){
$("status").innerHTML = event.target.responseText;
$("progressBar").value = 0;
    }

    function errorHandler(event){
$("status").innerHTML = "Upload Failed";
    }

    function abortHandler(event){
$("status").innerHTML = "Upload Aborted";
    }

</script> 
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a>CONSEJERIA-UPRA</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<script>

  // REDIRECT TO PHP SCRIPT THAT WILL PUT THE STUDENT RECORD IN A TXT FILE
    function $(el){
        return document.getElementById(el);
    }

    function uploadFile(event){
    event.preventDefault();
    var file = event.dataTransfer.files[0];
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("file1", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.open("POST", "inc/add_record_to_project.php");
	ajax.send(formdata);

    }
    
</script>
</body>
</html>
