<?php
if (@$_GET['binp'] == 'sukses') {
    echo '<div class="row notif-sukses">';
    echo 'Input Biro Berhasil';
    echo '</div>';
} elseif (@$_GET['bedt'] == 'sukses') {
    echo '<div class="row notif-sukses">';
    echo 'Edit Biro Berhasil';
    echo '</div>';
} elseif (@$_GET['bdel'] == 'sukses') {
    echo '<div class="row notif-sukses">';
    echo 'Delete Biro Berhasil';
    echo '</div>';
} elseif (@$_GET['binp'] == 'gagal') {
    echo '<div class="row notif-gagal">';
    echo 'Input Biro Gagal';
    echo '</div>';
} elseif (@$_GET['bedt'] == 'gagal') {
    echo '<div class="row notif-gagal">';
    echo 'Edit Biro Gagal';
    echo '</div>';
} elseif (@$_GET['bdel'] == 'gagal') {
    echo '<div class="row notif-gagal">';
    echo 'Delete Biro Gagal';
    echo '</div>';
}
?>
<table class="table table-striped">
    <thead>
        <tr align="center">
            <th>No</th>
            <th>Nama Biro</th>
            <th>Divisi</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $get = $biro->Select(['*']);
        $inner = $biro->Inner(['t_location'], ['code_location']);
        $no = 1;
        foreach ($biro->QueryFetchAll($get . $inner) as $row) {
            echo "<tr align='center'>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>$row[biro_name]</td>";
            echo "<td>$row[location_name]</td>";
            echo "<td>";
        ?>
            <a class='btn btn-info font-weight-bold button-edit-biro' href='?view=biro&edt=biro&code=<?php echo $row["code_biro"] ?>'>Edit</a> | <a class='btn btn-danger font-weight-bold' href='?view=biro&del=biro&code=<?php echo $row['code_biro'] ?>' onclick="return confirm('Lanjutkan penghapusan <?php echo $row['biro_name'] ?> ?')">Delete</a>
        <?php
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<button class="btn btn-primary font-weight-bold button-tambah">Input</button>
<form class="form input" action="" method="POST">
    <hr>
    <div class="row">
        <div class="form-group col-lg-3">
            <input class="form-control" type="text" name="name" placeholder="Nama Biro">
        </div>
        <div class="form-group col-lg-3">
            <select class="form-control" name="code_location" id="code_location">
                <option value="">-- Pilih Divisi --</option>
                <?php
                foreach ($location->GetAll() as $row) {
                    echo "<option value='$row[code_location]'>$row[location_name]</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group col-lg-3">
            <button class="btn btn-primary font-weight-bold" type="submit" name="input-biro">Simpan</button>
        </div>
    </div>
</form>

<?php
if (isset($_GET['edt'])) {
    $data = $biro->GetById($_GET['code']);
    echo '<form class="form edit" action="" method="POST">';
    echo '<hr>';
    echo '<div class="row">';
    echo '<div class="form-group col-lg-3">';
    echo '<input class="form-control" type="text" name="name" placeholder="Nama Biro" value="' . $data['biro_name'] . '">';
    echo '</div>';
    echo '<div class="form-group col-lg-3">';
    echo '<select class="form-control" name="code_location" id="code_location">';
    echo '<option value="">-- Pilih Divisi --</option>';
    foreach ($location->GetAll() as $row) {
        $selected = ($data['code_location'] == $row['code_location']) ? "selected" : "";
        echo "<option value='$row[code_location]' $selected>$row[location_name]</option>";
    }
    echo '</select>';
    echo '</div>';
    echo '<div class="form-group col-lg-3">';
    echo '<button class="btn btn-primary font-weight-bold" type="submit" name="edit-biro">Simpan</button>';
    echo '</div>';
    echo '</div>';
    echo '</form>';
}
require_once 'process.php';
