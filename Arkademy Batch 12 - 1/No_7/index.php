<!doctype html>
<html lang="en">

<head>
    <title>Arkademy - Riska Aulia</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>
    <?php
    include "koneksi.php";
    $sql = "SELECT nama.id AS id_biodata, nama.name AS nama_diri, salary.id AS id_gaji, salary.name AS jumlah_gaji, work.id AS id_pekerjaan, work.name AS nama_pekerjaan FROM nama INNER JOIN work ON nama.id_work = work.id INNER JOIN salary ON work.id_salary = salary.id";
    $result = mysqli_query($conn, $sql);
    ?>
    <div class="container">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-1"><img src="assets/img/logo.png" height="75px" width="100px"></div>
                <div class="col-lg-8"><br>
                    <h2>ARKADEMY BOOTCAMP</h2>
                </div>
            </div>
        </div>
        <br>
        <br>
        <p>
            <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modalAdd" style="float: right;">ADD</button>
            <br>
            <table id="mytable" class="table table-bordered">
                <thead>
                    <th>Name</th>
                    <th>Work</th>
                    <th>Salary</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $data['nama_diri'] ?></td>
                            <td><?php echo $data['nama_pekerjaan'] ?></td>
                            <td><?php echo $data['jumlah_gaji'] ?></td>
                            <td>
                                <a href="delete.php?id=<?php echo $data['id_biodata'] ?>" class="delete-data button btn btn-default btn-md"><i class="fa fa-trash fa-sm"></i></a>
                                <button type="button" id="<?php echo $data['id_biodata'] ?>" class="view_data btn btn-default btn-md" onclick="edit()"><i class="fa fa-edit fa-sm"></i></button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
    </div>
    <div id="modalAdd" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ADD DATA</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="tambah.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="nameInput" placeholder="Name..." name="nama" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="workSelect" name="pekerjaan" required>
                                <?php
                                $sql = "SELECT DISTINCT work.id AS id_pekerjaan, work.name AS nama_pekerjaan FROM work INNER JOIN salary ON work.id_salary = salary.id";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $row['id_pekerjaan'] ?>"><?php echo $row['nama_pekerjaan'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="salarySelect" name="gaji" required>
                                <?php
                                $sql = "SELECT DISTINCT salary.id AS id_gaji, salary.name AS jumlah_gaji FROM salary";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $row['id_gaji'] ?>"><?php echo $row['jumlah_gaji'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-md">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modalEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDIT DATA</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="data-biodata">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    function hapus() {
        $('.delete_data').click(function() {
            var id = $(this).attr("id");
            setTimeout(function() {
                swal({
                    title: "Berhasil!",
                    text: "Data Berhasil dihapus!",
                    type: "success"
                }, function() {
                    window.location = "delete.php?id=" + id;
                });
            }, 1000);
        });
    }
    function tambah() {
        swal("Berhasil!", "Data Berhasil ditambahkan!", "success");
    }
    function edit() {
        $('.view_data').click(function() {
            var id = $(this).attr("id");
            $.ajax({
                url: 'detail.php', // set url -> ini file yang menyimpan query tampil detail data siswa
                method: 'post', // method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
                data: {
                    id: id
                }, // nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
                success: function(data) { // kode dibawah ini jalan kalau sukses
                    $('#data-biodata').html(data); // mengisi konten dari -> <div class="modal-body" id="data_siswa">
                    $('#modalEdit').modal("show"); // menampilkan dialog modal nya
                }
            });
        });
        //swal("Berhasil!", "Data Berhasil diubah!", "success");
    }
</script>
<script>
    jQuery(document).ready(function($) {
        $('.delete-link').on('click', function() {
            var getLink = $(this).attr('href');
            swal({
                title: 'Alert',
                text: 'Hapus Data?',
                html: true,
                confirmButtonColor: '#d9534f',
                showCancelButton: true,
            }, function() {
                window.location.href = getLink
            });
            return false;
        });
    });
</script>

    © 2019 GitHub, Inc.
    Terms
    Privacy
    Security
    Status
    Help
