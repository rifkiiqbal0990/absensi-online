<?php
    require 'fungsi.php';

     
    $id=$_GET['id'];

    if(deleteData1($id)>0) {
        echo"<script>
        alert('data berhasil di hapus')
        document.location.href='listdatasiswa.php';
        </script>";
    } else{
        echo"<script>
        alert('data gagal di hapus')
        document.location.href='listdatasiswa.php';
        </script>";
    }
?>