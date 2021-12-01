<?php
if (isset($_POST['input-biro'])) {
    if ($biro->InputBiro()) {
        echo "<script>window.location='../index/?view=biro&binp=sukses';</script>";
    } else {
        echo "<script>window.location='../index/?view=biro&binp=gagal';</script>";
    }
}

if (isset($_POST['edit-biro'])) {
    if ($biro->EditBiro()) {
        echo "<script>window.location='../index/?view=biro&bedt=sukses';</script>";
    } else {
        echo "<script>window.location='../index/?view=biro&bedt=gagal';</script>";
    }
}

if (isset($_GET['del'])) {
    if ($biro->DeleteBiro()) {
        echo "<script>window.location='../index/?view=biro&bdel=sukses';</script>";
    } else {
        echo "<script>window.location='../index/?view=biro&bdel=gagal';</script>";
    }
}
