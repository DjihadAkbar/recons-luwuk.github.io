
<div id="accordion">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center text-center" id="headingOne" >
            <h5 class="mb-0">
                <button style="text-decoration:none;  display: block; color: black;" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div style="white-space:normal"> 
                    Pendapatan Harian
                    </div>
                </button>
            </h5>
            <div class="tambah-data mb-0">
                
                <?php
                    $dataAnchor = ['class' => 'btn btn-dark text-light akses-button'];
                    echo anchor('dashboard/entry/entryData', 'Tambah Data', $dataAnchor);
                    ?>
            </div>
        </div>
        
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body p-4">
                <div class="row">
                    <div class="wrapper" style="overflow-x: auto;">
                        <table id="table-data" class="table table-striped table-data"
                            style="display: block; max-width: -moz-fit-content; max-width: fit-content; margin: 0 auto; font-size:80%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"> # </th>
                                    <th scope="col">Last Login</th>
                                    <th scope="col">Pelabuhan </th>
                                    <th scope="col">Type </th>
                                    <th scope="col">Nama </th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Jenis Trip </th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Jabatan</th>
                                    <th colspan="2" scope="col">Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($user_accounts as $key => $value) {
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $no++; ?>
                                        </th>
                                        <td>
                                            <!-- <?php
                                            $original_date = $value['date'];

                                            // Creating timestamp from given date
                                            $timestamp = strtotime($original_date);

                                            // Creating new date format from that timestamp
                                            $new_date = date("d-m-Y", $timestamp);
                                            echo $new_date;

                                            ?> -->
                                        </td>
                                        <td>
                                            <?php
                                            echo $value['harbours'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $value['type']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['username']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['status']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['phone']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['jabatan']; ?>
                                        </td>
                                        <td>
                                            <div class="akses-button">
                                                <a class="btn btn-warning text-dark" href="admin/editAccount?id=<?php echo $value['id']; ?>"><i class="fas fa-file-edit"></i></a>
                                            </div>
                                        </td>
                                        <td>
                                            
                                            <div class="akses-button">
                                                <!-- <a data-toggle="modal" data-target="#deleteConfirmation" aria-expanded="true" class="dropdown-sidebar-asdp btn btn-danger text-dark " data-toggle="collapse" href="">
                                                    <i class="fas fa-delete-left"></i>
                                                </a> -->
                                                <a class="btn btn-danger text-dark" href="admin/deleteAccountid=<?php echo $value['id']; ?>">
                                                    <i class="fas fa-delete-left"></i>
                                                </a>
                                                
                                            </div>
                                            <!-- Modal delete
                                            <div class="modal fade" id="deleteConfirmation" tabindex="2" role="dialog"
                                                aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteConfirmationLabel">Logout Confirmation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                            <div class="delete-button">
                                                                <a class="btn btn-primary" href="entry/deleteEntryData?id=<?php echo $value['id_entry']; ?>">
                                                                <?php echo $value['id_entry']; ?>Sure
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            Modal Logout End -->
                                        </td>
                                    </tr>
                                    
                                    <?php
                                }
                                ?>
                            <tbody>
                            <tfoot class="thead-dark">
                                <tr>
                                    <th scope="col"> # </th>
                                    <th scope="col">Last Login</th>
                                    <th scope="col">Pelabuhan </th>
                                    <th scope="col">Type </th>
                                    <th scope="col">Nama </th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Jenis Trip </th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Telepon</th>
                                    <th scope="col">Jabatan </th>
                                    <th colspan="2" scope="col">Action </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


                                        