<?php
    require 'vendor/autoload.php';

$this->load->view('template/dashboard/header', $title);
if (!$this->session->userdata('logged_in'))
    redirect('login');
?>

<div class="dashboard">
    <nav id="sidebar" class="bg-dark">
        <img id="logo-asdp" class="mb-4 mr-4 ml-5 mt-4" src="<?php echo base_url('assets/images/Logo_ASDP.png'); ?>" alt="">
        <ul class="menu">
            <li class="<?php
            echo menuAktif('dashboard');
            ?>">
                <?php echo anchor('dashboard', 'Dashboard') ?>
            </li>
            <!-- <li class="<?php
            echo menuAktif('machine');
            ?>">
                <?php echo anchor('dashboard/machine', 'Mesin') ?>
            </li> -->
            <li class="<?php
            echo menuAktif('entry');
            ?>">
                <?php echo anchor('dashboard/entry', 'Entry Data') ?>
            </li>
            <li class="<?php
            echo menuAktif('master');
            ?>">
                <a href="#master" aria-expanded="true" class="dropdown-toggle dropdown-sidebar-asdp"
                    data-toggle="collapse">
                    Master
                </a>
                <ul id="master" class="collapse menu">
                    <li>
                        <?php echo anchor('dashboard/master/pelabuhan', 'Pelabuhan') ?>
                        <?php echo anchor('dashboard/master/lintasan', 'Lintasan') ?>
                        <?php echo anchor('dashboard/master/kapal', 'Kapal') ?>
                        <?php echo anchor('dashboard/master/tarif', 'Tarif') ?>
                    </li>
                </ul>
            </li>
            <!-- <li class="<?php
            echo menuAktif('administrasi');
            ?>">
                <a href=" #administrasi" aria-expanded="true" class="dropdown-toggle dropdown-sidebar-asdp"
                    data-toggle="collapse">
                    Administrasi
                </a>
                <ul id="administrasi" class="collapse menu">
                    <li>
                        <?php echo anchor('dashboard/administrasi/kategori', 'Kategori') ?>
                        <?php echo anchor('dashboard/kategori', 'Kategori') ?>
                        <?php echo anchor('dashboard/kategori', 'Kategori') ?>
                    </li>
                </ul>
            </li> -->
            <li class="<?php
            echo menuAktif('report');
            ?>">
                <a href=" #report" aria-expanded="true" class="dropdown-toggle dropdown-sidebar-asdp"
                    data-toggle="collapse">
                    Report
                </a>
                <ul id="report" class="collapse menu">
                    <li>
                        <?php echo anchor('dashboard/report', 'Report') ?>
                        <!-- <?php echo anchor('dashboard/kategori', 'Kategori') ?>
                        <?php echo anchor('dashboard/kategori', 'Kategori') ?> -->
                    </li>
                </ul>
            </li>
            <li class="<?php
            echo menuAktif('account');
            ?>">
                <?php echo anchor('dashboard/account', 'Account') ?>
            </li>
            <li class="<?php
            echo menuAktif('Logout');
            ?>">
                <a data-toggle="modal" data-target="#logoutConfirmation" href="" aria-expanded="true"
                    class="dropdown-sidebar-asdp" data-toggle="collapse">
                    Logout
                </a>

            </li>
        </ul>
    </nav>
    <div id="content">
        <nav id="navbar-dashboard" class="navbar navbar-expand bg-light">
            <button type="button" id="sidebarCollapse" class="btn btn-outline-dark">
                <i class="fa fa-align-justify"></i>
            </button>
            <div class="account-user">
                <i class="fa-solid fa-user fa-xl" >
                    <?php
                echo ($this->session->userdata('logged_in')) ? $this->session->userdata('name') : "";
                ?>
            </i>
        </div>
        </nav>

        <!-- Modal Logout -->
        <div class="modal fade" id="logoutConfirmation" tabindex="-1" role="dialog"
            aria-labelledby="logoutConfirmationLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutConfirmationLabel">Logout Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <div class="logout-button">
                            <?php
                            $dataAnchor = ['class' => 'btn btn-primary'];
                            echo anchor('logout', 'Sure', $dataAnchor);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Logout End -->


        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php
                    $count = count($this->uri->segment_array());
                    $uri = '';
                    for( $i = 0; $i < $count; $i++){ ?>
                        <?php
                            if($i == $count -1){ 
                                $uri = $uri ."/". $this->uri->segment($i + 1);
                            ?>
                                <li class="breadcrumb-item active" aria-current="page"> <?php echo preg_replace('/(?<!\ )[A-Z]/', ' $0', ucfirst($this->uri->segment($count)));?></li>
                            <?php } else {
                                $uri = $uri ."/". $this->uri->segment($i + 1);
                                ?>
                                <li class="breadcrumb-item"><a href=<?php echo base_url() . $uri; ?>> <?php echo ucfirst($this->uri->segment($i + 1));?></a></li>
                        <?php } ?>
                    <?php } ?>
                </ol>
            </nav>
            <!-- Content -->
            <!-- <h3 class="dashboard" style="white-space: normal;">
                <?php echo $title ?>
            </h3> -->
            <?php $this->load->view($contentView); ?>
            <!-- Content -->
            
            <!-- Passing User Type -->
            <?php
            $userType = $this->session->userdata('type');
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    var userType = "<?php echo "$userType" ?>";
    $('.akses-button').hide();
    if (userType == 'EDITOR') {
        $('.akses-button').show();
    }
    
    $(document).ready(function () {
        var title = "<?php echo $title; ?>"
        if (title != "Dashboard") {
            title = "<?php echo $title; ?>"
        } else {
            title = '';
        }

        $('table.table-data').DataTable({
            initComplete: function () {
                this.api()
                    .columns()
                    .every(function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>');
                            });
                    });
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'copy', title: title, className: 'btn btn-primary mr-1 mb-2',
                    text: '<i class="fas fa-copy"></i> ',
                    titleAttr: 'Copy to Clipboard',
                },
                {
                    extend: 'csv', title: title, className: 'btn btn-success mr-1 mb-2',
                    text: '<i class="fas fa-file-csv"></i> ',
                    titleAttr: 'Export to CSV',
                },
                {
                    extend: 'pdfHtml5', title: title, className: 'btn btn-danger mr-1 mb-2',
                    text: '<i class="fas fa-file-pdf"></i> ',
                    titleAttr: 'Export to PDF',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                {
                    extend: 'excelHtml5', title: title, className: 'btn btn-success mr-1 mb-2',
                    text: '<i class="fas fa-file-excel"></i> ',
                    titleAttr: 'Export to Excel',
                },
                {
                    extend: 'print', title: title, className: 'btn btn-secondary mr-1 mb-2',
                    text: '<i class="fa fa-print"></i> ',
                    titleAttr: 'Imprimir',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'

                },
            ],


        });
        var table = $('table.table-data').DataTable();
        $('table.table-data tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
        

    document.getElementById("tanggal_berangkat").valueAsDate = new Date();
    });
</script>
<?php $this->load->view('template/dashboard/footer'); ?>