<?php
include_once("../connection.php");
session_start();

include_once("entete.php");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><samp style="color:tomato">E</samp>ntrées</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header">
          <h5 class="m-0">DONNEES</h5>
        </div>

        <div class="row">
          <div class="col-md-4">
            <form role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date des Entrées</label>
                  <input type="date" class="form-control" id="date" placeholder="Date">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Montant des Entrées</label>
                  <input type="bouble" class="form-control" value="0" id="montant" placeholder="Montant">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
              </div>
            </form>
          </div>
          <div class="col-md-8">
            <table class="table table-striped">
              <tr>
                <thead>
                  <th>ID</th>
                  <th>Date</th>
                  <th>Montant</th>
              </tr>
              </thead>
                <tbody>
         <?php 
         $select= $connecte->prepare("select * from  entrees");
         $select->execute();
         while($row = $select->fetch(PDO::FETCH_OBJ)){
          echo'
          <tr>
          <td>'.$row->id_entrees.'</td>
          <td>'.$row->date_entree.'</td>
          <td>'.$row->Montant.'</td>
          </tr>';}
         ?>
                </tbody>
            </table>
          </div>
        </div>

      </div>

      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<?php
include_once("pied.php");
?>