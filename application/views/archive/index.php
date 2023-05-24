<div class="card-header d-flex justify-content-between align-items-center text-center"> 
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-dark text-light" data-toggle="modal" data-target="#exampleModal">
    + Tambah Data
    </button>
</div>    
<div class="card ">    
    <div class="card-body p-4 ml-auto mr-auto">
        <div class="row">
            <div class="wrapper" style="overflow-x: auto;">
                <table id="table-data" class="table table-striped table-data" style=" font-size:80%;">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"> # </th>
                            <th scope="col">Nama Dokumen </th>
                            <th scope="col">Jenis Dokumen </th>
                            <th scope="col">Lokasi Arsip </th>
                            <!-- <th scope="col">Tipe File </th> -->
                            <th scope="col">Tanggal Upload </th>
                            <th scope="col">Action </th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no = 1;
                    foreach($archive_list as $arsip){
                    ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $no++; ?>
                                </th>
                                <th scope="row">   
                                    <?php echo $arsip['document_name']; ?>
                                </th>
                                <th scope="row">   
                                    <?php echo $arsip['document_type']; ?>
                                </th>
                                <th scope="row">   
                                    <?php echo $arsip['archive']; ?>
                                </th>
                                <!-- <th scope="row">   
                                    <?php echo $arsip['file_type']; ?>
                                </th> -->
                                <td scope="col"> <?php
                                                $original_date = $arsip['archive_date'];
                                                echo $original_date;
                                                // echo getHari($original_date);
                                                ?></td>
                                </th>
                                <td>    
                                    <div class="akses-button">
                                        <a class="btn btn-warning text-dark delete-button" data-toggle="modal" data-target="#konfirmasi"  data-id="<?php echo $arsip['id']; ?>" ><i class="fas fa-file-edit"></i></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="akses-button">
                                        <a class="btn btn-danger text-dark" href="archive/deleteArchive?id=<?php echo $arsip['id']; ?>">
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
                            <th scope="col">Nama Dokumen </th>
                            <th scope="col">Jenis Dokumen </th>
                            <th scope="col">Lokasi Dokumen </th>
                            <!-- <th scope="col">Tipe File </th> -->
                            <th scope="col">Tanggal Upload </th>
                            <th scope="col">Action </th>
                            <th scope="col"> </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete -->
<div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    <div class="modal-footer">
        <?php
        $data = array(
            'content'       => 'Close',
            'type'          => 'button',
            'class'         => 'btn btn-secondary',
            'data-dismiss'  => 'modal'
        );
        
        echo form_button($data);
        ?>
        <a data-id="" class="btn btn-danger confirm-delete">Delete</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Add Archive -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambahkan Dokumen Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>

            <?php
        echo form_open(base_url('archive/addArchive'), ['class' => 'form-entry']);
        ?>
        
        <div class="form-group row">
            <label for="jenis_dokumen" class="label-wrap"> Jenis Dokumen </label>
            <div class="col">
                <select class="form-control" name="jenis_dokumen" id="jenis_dokumen" required>
                    <option value="">No Selected</option>
                    <option value="Nota Dinas">Nota Dinas</option>
                    <option value="Surat Keluar">Surat Keluar</option>
                    <option value="Surat Masuk">Surat Masuk</option>
                </select>
                <?php
                echo form_error('jenis_dokumen');
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="nama_dokumen" class="label-wrap"> Nama Dokumen </label>
            <div class="col">
                <?php
                $data = array(
                    'class'   => 'form-control',
                    'name'    => 'nama_dokumen',
                    'id'      => 'nama_dokumen',
                );
                
                echo form_input($data);
                echo form_error('nama_dokumen');
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="lokasi_dokumen" class="label-wrap"> Lokasi Dokumen </label>
            <div class="col">
                <?php
                $data = array(
                    'class'   => 'form-control',
                    'name'    => 'lokasi_dokumen',
                    'id'      => 'lokasi_dokumen',
                );
                
                echo form_input($data);
                echo form_error('lokasi_dokumen');
                ?>
            </div>
        </div>
    </div>
    </div>
    <div class="modal-footer">
        <?php
        $data = array(
            'content'       => 'Close',
            'type'          => 'button',
            'class'         => 'btn btn-secondary',
            'data-dismiss'  => 'modal'
        );
        
        echo form_button($data);
        ?>
        <div>
            <?php
            echo form_submit(['name' => 'submit','class' => 'btn btn-primary'], 'Submit');
            echo form_close();
            ?>
        </div>
      </div>
    </div>
  </div>
</div>