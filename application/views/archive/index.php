<div class="card-header d-flex justify-content-between align-items-center text-center"> 
    <div class="tambah-data">  
        <?php
        $dataAnchor = ['class' => 'btn btn-dark text-light akses-button','data-toggle'=>'modal','data-target'=>'#exampleModal'];
        echo anchor('archive/addArchive', '+ Tambah Data', $dataAnchor);
        ?>
        
    </div> 
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
                                        <a class="btn btn-warning text-dark" href="entry/editEntryData?id=<?php echo $arsip['id']; ?>"><i class="fas fa-file-edit"></i></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="akses-button">
                                        <a class="btn btn-danger text-dark" href="entry/deleteEntryData?id=<?php echo $arsip['id']; ?>">
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
                            <th scope="col">Lokasi Arsip </th>
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
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>