<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>
        <?php echo $title; ?>
    </title>
    <link rel="icon" href="<?php echo base_url('assets/images/TitleBarLogo_ASDP.png'); ?>">
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

    <div class="container-fluid mb-5 mt-3" style="padding-top:15px;">
        <div class="row">
            <div class="col-8">
                <h1>
                    Register
                </h1>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        Buat Akun
                    </div>
                    <div class="card-body">
                        <?php
                        echo form_open(base_url('register/prosesInput'), ['class' => 'form-luwuk']);
                        ?>
                        <div class="form-group row">
                            <label for="pelabuhan" class="col-4"> Pelabuhan </label>
                            <div class="col">
                                <?php

                                $options = array(
                                    '' => 'No Selected',
                                    'LUWUK' => 'Luwuk',
                                    'BANGGAI' => 'Banggai',
                                    'BOBONG' => 'Bobong',
                                    'AMPANA' => 'Ampana',
                                    'PASOKAN' => 'Pasokan',
                                    'DOLONG' => 'Dolong',
                                    'BONITON' => 'Boniton',
                                    'GORONTALO' => 'Gorontalo',
                                    'WAKAI' => 'Wakai',
                                    'KOLONODALE' => 'Kolondale',
                                    'BATURUBE' => 'Baturube',
                                    'SAIYONG' => 'Saiyong',
                                    'PAGIMANA' => 'Pagimana',
                                    'MARISA' => 'Marisa',
                                    'TOBOLI' => 'Toboli',
                                );

                                echo form_dropdown('pelabuhan', $options, set_value('pelabuhan'), 'class="form-control" id="pelabuhan"');
                                echo form_error('pelabuhan');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-4"> Type </label>
                            <div class="col">

                                <?php
                                $options = array(
                                    '' => 'No Selected',
                                    'Viewer' => 'Viewer',
                                    'Editor' => 'Editor',
                                );

                                echo form_dropdown('type', $options, set_value('type'), 'class="form-control" id="type"');
                                echo form_error('type');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="name" class="col-4">
                                Nama
                            </label>
                            <div class="col">

                                <?php

                                $data = [
                                    'name' => 'name',
                                    'id' => 'name',
                                    'class' => 'form-control',
                                    'value' => set_value('name'),
                                    'placeholder' => 'Nama',
                                ];

                                echo form_input($data);
                                echo form_error('name');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="username" class="col-4">
                                Username
                            </label>
                            <div class="col">

                                <?php

                                $data = [
                                    'name' => 'username',
                                    'id' => 'username',
                                    'class' => 'form-control',
                                    'value' => set_value('username'),
                                    'placeholder' => 'Username',
                                ];

                                echo form_input($data);
                                echo form_error('username');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="password" class="col-4">
                                Password
                            </label>
                            <div class="col">

                                <?php

                                $data = [
                                    'name' => 'password',
                                    'id' => 'password',
                                    'class' => 'form-control',
                                    'placeholder' => 'Password',
                                ];

                                echo form_password($data);

                                echo form_error('password');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="confirm_password" class="col-4">
                                Konfirmasi Password
                            </label>
                            <div class="col">
                                <?php
                                $data = [
                                    'name' => 'confirm_password',
                                    'id' => 'confirm_password',
                                    'class' => 'form-control',
                                    'placeholder' => 'Confirm Password',
                                ];

                                echo form_password($data);
                                echo form_error('confirm_password');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="email" class="col-4">
                                Email
                            </label>
                            <div class="col">

                                <?php

                                $data = [
                                    'name' => 'email',
                                    'id' => 'email',
                                    'class' => 'form-control',
                                    'value' => set_value('email'),
                                    'placeholder' => 'Email',
                                ];

                                echo form_input($data);
                                echo form_error('email');
                                ?>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="phone" class="col-4">
                                Telepon
                            </label>
                            <div class="col">

                                <?php

                                $data = [
                                    'name' => 'phone',
                                    'id' => 'phone',
                                    'class' => 'form-control',
                                    'value' => set_value('phone'),
                                    'placeholder' => 'Phone',
                                ];

                                echo form_input($data);
                                echo form_error('phone');
                                ?>
                            </div>
                        </div>
                        <?php
                        echo form_submit(['name' => 'submit', 'class' => 'btn btn-dark btn-block'], 'Submit');
                        echo form_close();
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>