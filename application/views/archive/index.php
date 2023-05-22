
    <h1>E-Archive</h1>
    
    <div class="card-body p-4">
                <div class="row">
                    <div class="wrapper" style="overflow-x: auto;">
                        <table class="table table-striped table-data" style="display: block; max-width: -moz-fit-content; max-width: fit-content; margin: 0 auto; font-size:80%;">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col"> # </th>
                                    <th scope="col">Nama Dokumen </th>
                                    <th scope="col">Jenis Dokumen </th>
                                    <th scope="col">Tipe File </th>
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
                                            <?php echo $arsip['file_type']; ?>
                                        </th>
                                        <td scope="col"> <?php
                                                            $original_date = $arsip['archive_date'];
                                                            echo getHari($original_date);
                                                            ?></td>
                                        </th>
                                        <td>
                                            <div class="akses-button">
                                                <a class="btn btn-warning text-dark" href="entry/editEntryData?id=<?php echo $value['id_entry']; ?>"><i class="fas fa-file-edit"></i></a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="akses-button">
                                                <a class="btn btn-danger text-dark" href="entry/deleteEntryData?id=<?php echo $value['id_entry']; ?>">
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
                                    <th scope="col">Tipe File </th>
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
 
    