<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"
    style="background-color: #a2d9ff; padding: 6rem 5rem; ">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="..." class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="..." class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#a2d9ff" fill-opacity="1"
        d="M0,128L21.8,138.7C43.6,149,87,171,131,197.3C174.5,224,218,256,262,266.7C305.5,277,349,267,393,229.3C436.4,192,480,128,524,133.3C567.3,139,611,213,655,218.7C698.2,224,742,160,785,138.7C829.1,117,873,139,916,128C960,117,1004,75,1047,69.3C1090.9,64,1135,96,1178,106.7C1221.8,117,1265,107,1309,128C1352.7,149,1396,203,1418,229.3L1440,256L1440,0L1418.2,0C1396.4,0,1353,0,1309,0C1265.5,0,1222,0,1178,0C1134.5,0,1091,0,1047,0C1003.6,0,960,0,916,0C872.7,0,829,0,785,0C741.8,0,698,0,655,0C610.9,0,567,0,524,0C480,0,436,0,393,0C349.1,0,305,0,262,0C218.2,0,175,0,131,0C87.3,0,44,0,22,0L0,0Z">
    </path>
</svg>
<div class="row">
    <table class="table table-striped w-10">
        <thead class="thead-dark">
            <tr>
                <th scope="col"> # </th>
                <th scope="col">
                    Pelabuhan
                </th>
                <th scope="col">
                    Otorisasi
                </th>
                <th scope="col">
                    Nama
                </th>
                <th scope="col">
                    Username
                </th>
                <th scope="col">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($usersData as $key => $value) {
                ?>
                <tr>
                    <th scope="row">
                        <?php echo $no++; ?>
                    </th>
                    <td>
                        <?php echo $value['harbours']; ?>
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
                    <?php
                    ?>
                </tr>
                <?php
            }
            ?>
        <tbody>
    </table>
</div>