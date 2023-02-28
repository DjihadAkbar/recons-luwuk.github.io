<div id="accordion">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center text-center" id="headingOne" >
                <h5 class="mb-0">
                    <button style="text-decoration:none;  display: block; color: black;" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <div style="white-space:normal"> 
                        Lintasan
                        </div>
                    </button>
                </h5>
                <div class="tambah-data">
                    <?php
                    $dataAnchor = ['class' => 'btn btn-dark text-light akses-button'];
                    echo anchor('dashboard/master/lintasan/tambahLintasan', 'Tambah Data', $dataAnchor);
                    ?>
                </div>
            </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body p-4 ml-auto mr-auto">
                <div class="row">
                    <div class="wrapper" style="overflow-x: auto;">
                        <table id="table-data" class="table table-striped table-data" style="display: block; font-size:80%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col"> # </th>
                                    <th scope="col"> Lintasan </th>
                                    <th scope="col"> Pelabuhan Asal </th>
                                    <th scope="col"> Pelabuhan Tujuan </th>
                                    <th scope="col"> Segment </th>
                                    <th scope="col"> Distance </th>
                                    <th scope="col"> Travel Time </th>
                                    <th scope="col">Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($semuaLintasan as $key => $value) {
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $no++; ?>
                                        </th>
                                        <td>
                                            <?php echo $value['lintasan']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['asal']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['tujuan']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['segment']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['distance']; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['travel_time']; ?>
                                        </td>

                                        <td>
                                            <div class="row">
                                                <div class="akses-button col">
                                                    <?php
                                                    $dataAnchor = ['class' => 'btn btn-warning text-dark'];
                                                    echo anchor('users/login', '<i class="fas fa-file-edit"></i>', $dataAnchor);
                                                    ?>
                                                    <?php
                                                    $dataAnchor = ['class' => 'btn btn-danger text-dark'];
                                                    echo anchor('users/login', '<i class="fas fa-delete-left"></i>', $dataAnchor);
                                                    ?>
                                                </div>
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
