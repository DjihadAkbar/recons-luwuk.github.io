<div id="accordion">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center text-center" id="headingOne" >
            <h5 class="mb-0">
                <button style="text-decoration:none;  display: block; color: black;" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div style="white-space:normal"> 
                    Kapal
                    </div>
                </button>
            </h5>
            <div class="tambah-data mb-0">
                <?php
                $dataAnchor = ['class' => 'btn btn-dark text-light akses-button'];
                echo anchor('dashboard/master/kapal/tambahKapal', 'Tambah Data', $dataAnchor);
                ?>
            </div>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body p-4">
                <div class="row">
                    <div class="wrapper" style="overflow-x: auto; overflow-y: auto;">
                        <table id="table-data" class="table table-striped table-data table-vcenter"
                            style=" max-width: -moz-fit-content; max-width: fit-content; margin: 0 auto; font-size:80%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"> # </th>
                                    <th scope="col"> Id Kapal </th>
                                    <th scope="col">Kapal </th>
                                    <th scope="col">Code </th>
                                    <th scope="col">Perusahaan </th>
                                    <th scope="col">GRT </th>
                                    <th scope="col">Type </th>
                                    <th scope="col">Register Number </th>
                                    <th scope="col">IMO Number </th>
                                    <th scope="col">Tanda Pengenal </th>
                                    <th scope="col">MMSI </th>
                                    <th scope="col">Panjang Seluruh </th>
                                    <th scope="col">Lebar </th>
                                    <th scope="col">Sarat </th>
                                    <th scope="col">GT </th>
                                    <th scope="col">Build Year </th>
                                    <th scope="col">Galangan </th>
                                    <th scope="col">Pelabuhan Pendaftaran </th>
                                    <th scope="col">Berat Jangkar </th>
                                    <th scope="col">Action </th>
                                    <th scope="col"> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($kapal as $key => $value) {
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $no++; ?>
                                        </th>
                                        <td>
                                            <?php echo $value['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['kapal']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['code']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['company']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['grt']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['type']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['register_num']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['imo_num']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['id_card']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['mmsi']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['length_over_all']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['breadth']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['draft']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['gt']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['build_year']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['shipyard']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['registration_port']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['anchor_weight']; ?>
                                        </td>

                                        <td>
                                            <div class="akses-button">
                                            <a class="btn btn-warning text-dark" href="kapal/editDataKapal?id=<?php echo $value['id']; ?>"><i class="fas fa-file-edit"></i></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="akses-button">
                                                <a class="btn btn-danger text-dark delete-button" data-toggle="modal" data-target="#konfirmasi" data-href="kapal/deleteKapal?id=" data-id="<?php echo $value['id']; ?>" >
                                                <!-- <a class="btn btn-danger text-dark" href="kapal/deleteKapal?id=<?php echo $value['id']; ?>"> -->
                                                    <i class="fas fa-delete-left"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            <tbody>
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