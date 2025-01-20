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
                <div class="form-group">
                  <label for="exampleInputPassword1">centre d'interet</label>
                  <?php
                  $s = $connecte->prepare("select * from c_interet");
                  $s->execute(); ?>
                  <select>
                    <option value="" disabled selected>selectionner un centre</option>
                    <?php
                    while ($row = $s->fetch(PDO::FETCH_OBJ)) {
                    ?>
                      <option><?php echo ($row->Désignation) ?></option>;
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Mode de Paiement</label>
                  <?php
                  $s = $connecte->prepare("select * from paiement");
                  $s->execute(); ?>
                  <select>
                    <option value="" disabled selected>Selectionner un Mode</option>
                    <?php
                    while ($row = $s->fetch(PDO::FETCH_OBJ)) {
                    ?>
                      <option><?php echo ($row->Mode) ?></option>;
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
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
                  <th>Bénéficiare</th>
                  <th>M-Paiement</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $select = $connecte->prepare("select * from  entrees");
                $select->execute();
                while ($row = $select->fetch(PDO::FETCH_OBJ)) {
                  echo '
          <tr>
          <td>' . $row->id_entrees . '</td>
          <td>' . $row->date_entree . '</td>
          <td>' . $row->Montant . '</td>
          <td>' . $row->centre . '</td>
          <td>' . $row->Paiement . '</td>
          </tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">Analyse</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <?php
            $total = 0;
            $caisse = 0;
            $cheque = 0;
            $dette = 0;
            $select = $connecte->prepare("select * from  entrees");
            $select->execute();
            while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
              $total = $total + $row['Montant'];
              $mode = $row['Paiement'];
              if($row['Paiement'] == 'caisse')
              {
                $caisse = $caisse + $row['Montant'];
              }
              if($row['Paiement'] == 'chéque')
              {
                $cheque = $cheque + $row['Montant'];
              }
              if($row['Paiement'] == 'dette')
              {
                $dette = $dette + $row['Montant'];
              }
            }
            ?>
            <div class="col-md-3"
              <div class="total1">
              <h5 style="color:white;background-color:black;text-align:center">TOTAL DES ENTREES</h5>
              <h4 style="text-align:center"><?php echo ($total) . 'DA' ?></h4>
            </div>
            <div class="col-md-3"
              <div class="total2">
              <h5 style="color:white;background-color:black;text-align:center">TOTAL DES ACHATS CAISSE</h5>
              <h5 style="text-align:center"><?php echo ($caisse . 'DA') ?></h5>
            </div>
            <div class="col-md-3"
              <div class="total2">
              <h5 style="color:white;background-color:black;text-align:center">TOTAL DES ACHATS CHEQUES</h5>
              <h5 style="text-align:center"><?php echo ($caisse . 'DA') ?></h5>
            </div>
            <div class="col-md-3"
              <div class="total2">
              <h5 style="color:white;background-color:black;text-align:center">TOTAL DES ACHATS DETTES</h5>
              <h5 style="text-align:center"><?php echo ($caisse . 'DA') ?></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
</div>
<?php
include_once("pied.php");
?>