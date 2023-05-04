<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>
        <?php echo $title; ?>
    </title>
    <link rel="icon" href="<?php echo base_url('assets/images/16x16.png'); ?>">
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

    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url("assets/bootstrap-4.3.1-dist/css/bootstrap.min.css"); ?>">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/main.css"); ?>" />
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#a2d9ff" fill-opacity="0.5"
        d="M0,32L60,64C120,96,240,160,360,160C480,160,600,96,720,74.7C840,53,960,75,1080,90.7C1200,107,1320,117,1380,122.7L1440,128L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
    </path>
</svg>
<div class="container-fluid">

        <!-- Isi -->
        <div class="container col-md-4  text-center">
            <?php if ($this->session->flashdata('pesan')): ?>
                <div class="alert <?php echo $this->session->flashdata('alert') ?>">
                    <?php echo $this->session->flashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <img class="bd-placeholder-img-lg mb-4 logoIcon" src="<?php echo base_url('assets/images/logo_asdp_primary.png'); ?>" alt="">
            <?php
            echo form_open(base_url('login/prosesLogin'), ['class' => 'form-luwuk']);
            ?>
            <div class="form-group row">
                <?php
                $data = [
                    'name' => 'username',
                    'id' => 'username',
                    'class' => 'form-control',
                    'value' => set_value('username'),
                    'placeholder' => 'Username'

                ];
                echo form_error('username','<label for="username" class="error text-danger">', '</label>');
                echo form_input($data);

                ?>
                <?php
                $data = [
                    'name' => 'password',
                    'id' => 'password',
                    'class' => 'form-control',
                    'placeholder' => 'Password'
                    
                ];
                echo form_error('password', '<label for="password" class="error text-danger">', '</label>');
                echo form_password($data);
                
                ?>
                <?php
                echo form_submit(['name' => 'login', 'class' => 'form-input btn btn-dark btn-block'], 'Login');
                echo form_close();
                ?>
            </div>
            <a class="daftar_button" style="padding-top: 10px;" href="<?php echo base_url('register'); ?>">Daftar?</a>
            <p class="copyright" style="opacity: 50%; color: gray; padding-top: 5px;">&#169; ASDP Luwuk 2023</p>
        </div>
        <svg class="footer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#a2d9ff" fill-opacity="0.5"
            d="M0,192L80,213.3C160,235,320,277,480,277.3C640,277,800,235,960,218.7C1120,203,1280,213,1360,218.7L1440,224L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
        </svg>
    </div>

    <!-- Akhir Isi -->
</body>
<footer>
</footer>