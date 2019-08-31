<?php
include "koneksi.php";
if ($_POST['id']) {
    $id = $_POST['id'];
    // mengambil data berdasarkan id
    $sql = "SELECT nama.id AS id_biodata, nama.name AS nama_diri, salary.id AS id_gaji, salary.name AS jumlah_gaji, work.id AS id_pekerjaan, work.name AS nama_pekerjaan FROM nama INNER JOIN work ON nama.id_work = work.id INNER JOIN salary ON work.id_salary = salary.id WHERE nama.id = $id";
    $result = $conn->query($sql);
    foreach ($result as $baris) { ?>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" class="form-control" id="idInput" value="<?php echo $baris['id_biodata'] ?>" name="nama">
            <div class="form-group">
                <input type="text" name="nama" class="form-control" id="nameInput" value="<?php echo $baris['nama_diri'] ?>" name="nama">
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
            <button type="submit" class="btn btn-success btn-md" style="float: right;">EDIT DATA</button>
        </form>
    <?php
    }
}
?>