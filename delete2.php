<?php
    require 'fungsi.php';

     
    $id=$_GET['id'];

    if(deleteData2($id)>0) {
        echo"<script>
        alert('data berhasil di hapus')
        document.location.href='kehadiran.php';
        </script>";
    } else{
        echo"<script>
        alert('data gagal di hapus')
        document.location.href='kehadiran.php';
        </script>";
    }
?>