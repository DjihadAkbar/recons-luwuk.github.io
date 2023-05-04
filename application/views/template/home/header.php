<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>
        <?php echo $title; ?>
    </title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <!-- Script Barang Curah -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setCurrentDate();
        });

        $(document).ready(function () {
            $("#filter_kapal, #filter_lintasan, #filter_pelabuhan, #filter_trip, #filter_tanggal").on("change", function () {
                var kapal = $('#filter_kapal').find("option:selected").val();
                var lintasan = $('#filter_lintasan').find("option:selected").val();
                var pelabuhan = $('#filter_pelabuhan').find("option:selected").val();
                var trip = $('#filter_trip').find("option:selected").val();
                var tanggal = $('#filter_tanggal').find("option:selected").val();
                SearchData(kapal, lintasan, pelabuhan, trip)
            });
        });

        function SearchData(kapal, lintasan, pelabuhan, trip) {
            if (kapal == '' && lintasan == '' && pelabuhan == '' && trip == '') {
                $('#entryTable tbody tr').show();
            } else {
                $('#entryTable tbody tr:has(td)').each(function () {
                    var rowKapal = $.trim($(this).find('td:eq(1)').text());
                    console.log(rowKapal);
                    var rowRoute = $.trim($(this).find('td:eq(2)').text());
                    // console.log(rowRoute);
                    // var rowHarbour = $.trim($(this).find('td:eq(3)').text());
                    // console.log(rowHarbour);
                    // var rowTrip = $.trim($(this).find('td:eq(4)').text());
                    // console.log(rowTrip);
                    // var rowDate = $.trim($(this).find('td:eq(0)').text());
                    // console.log(rowDate);
                    if (kapal != '' && lintasan != '') {
                        if (rowKapal == kapal && rowRoute == lintasan) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    } else if ($(this).find('td:eq(1)').text() != '' || $(this).find('td:eq(1)').text() != '') {
                        if (kapal != '') {
                            if (rowKapal == kapal) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        }
                        if (lintasan != '') {
                            if (rowRoute == lintasan) {
                                $(this).show();
                            }
                            else {
                                $(this).hide();
                            }
                        }
                    }
                });
            }
        }


        function setCurrentDate() {
            var now = new Date();
            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear() + "-" + (month) + "-" + (day);
            $('#tanggal_berangkat').val(today);
            $('#filter_tanggal').val(today);
        }
    </script>


    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url("assets/bootstrap-4.3.1-dist/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/main.css"); ?>">


    <link rel="stylesheet" type="text/css" href="assets/main.css" />
    <style>
        #footer {
            position: fixed;
            margin-bottom: 10px;
            bottom: 0;
            width: 100%;
            /* Height of the footer*/
            height: 30px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #a2d9ff;">
        <a href="<?php echo base_url(); ?>" class="navbar-brand">ASDP Luwuk</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <?php
                    $dataAnchor = ['class' => 'nav-link'];
                    echo anchor('bulanan', 'Bulanan', $dataAnchor);
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                    $dataAnchor = ['class' => 'nav-link'];
                    echo anchor('bulanan', '', $dataAnchor);
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                    $dataAnchor = ['class' => 'nav-link'];
                    echo anchor('entry', 'Entry Data', $dataAnchor);
                    ?>
                </li>
                <li class="nav-item">
                    <?php
                    $dataAnchor = ['class' => 'nav-link'];
                    echo anchor('trip', 'Tes', $dataAnchor);
                    ?>
                </li>
            </ul>
        </div>
        <form class="form-inline my-2 my-lg-0">
            <h3 class="mr-2">
                <?php
                echo ($this->session->userdata('logged_in')) ? $this->session->userdata('name') : "";
                ?>
            </h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#logoutConfirmation">
                Log Out
            </button>

            <!-- Modal -->
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

            <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
        </form>
    </nav>