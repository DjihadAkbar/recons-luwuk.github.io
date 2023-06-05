<div id="accordion">

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center text-center" id="headingOne" >
            <h5 class="mb-0">
                <button style="text-decoration:none;  display: block; color: black;" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div style="white-space:normal"> 
                    RKA
                    </div>
                </button>
            </h5>
            <div class="tambah-data">  
                <?php
                $dataAnchor = ['class' => 'btn btn-dark text-light akses-button'];
                echo anchor('dashboard/master/rka/tambahRka', 'Tambah Data', $dataAnchor);
                ?>
            </div>
    </div>
    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body p-4 ml-auto mr-auto">
            <div class="row">
                <div class="wrapper" style="overflow-x: auto;">
                    <table class="table table-striped table-data" style=" font-size:80%;">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col"> # </th>
                                <th scope="col"> Pelabuhan </th>
                                <th scope="col"> Rute </th>
                                <th scope="col"> Kapal </th>
                                <th scope="col"> Bulan </th>
                                <th scope="col"> Tahun </th>
                                <th scope="col"> Target Trip </th>
                                <th scope="col"> Target Pendapatan </th>
                                <th scope="col"> Action </th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($target as $key => $value) {
                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $no++; ?>
                                    </th>
                                    <td>
                                        <?php echo $value['harbour']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['route']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['ferry']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['month']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['year']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['trip']; ?>
                                    </td>
                                    <td>
                                        <?php echo $value['target']; ?>
                                    </td>
                                    <td>
                                        <div class="akses-button">
                                        <a class="btn btn-warning text-dark" href="pelabuhan/editDataPelabuhan?id=<?php echo $value['id_harbours']; ?>"><i class="fas fa-file-edit"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="akses-button">
                                            <a class="btn btn-danger text-dark delete-button" data-toggle="modal" data-target="#konfirmasi" data-href="pelabuhan/deletePelabuhan?id=" data-id="<?php echo $value['id_harbours']; ?>" >
                                            <!-- <a class="btn btn-danger text-dark" href="pelabuhan/deletePelabuhan?id=<?php echo $value['id_harbours']; ?>"> -->
                                                <i class="fas fa-delete-left"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        <tbody>
                        <tfoot class="thead-dark">
                            <tr>
                                <th scope="col"> # </th>
                                <th scope="col"> Pelabuhan </th>
                                <th scope="col"> Rute </th>
                                <th scope="col"> Kapal </th>
                                <th scope="col"> Bulan </th>
                                <th scope="col"> Tahun </th>
                                <th scope="col"> Target Trip </th>
                                <th scope="col"> Target Pendapatan </th>
                                <th scope="col"> Action </th>
                                <th scope="col"> </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal Delete -->
<div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan Data</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
    <div class="modal-body">Hapus Data?</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <a data-id="" data-href="" class="btn btn-danger text-dark confirm-delete">Hapus</a>
    </div>
  </div>
</div>
</div>