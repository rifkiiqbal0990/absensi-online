<?php
session_start();

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $databasename = "absensi";
    $conn = mysqli_connect($hostname,$username,$password,$databasename);


    // get data siswa

        function getsiswas(){
        global $conn;

        $querySiswa = mysqli_query($conn,"SELECT * FROM siswas");
        $siswas = mysqli_fetch_all($querySiswa,MYSQLI_ASSOC);
    
        return $siswas;
    }


    // get data kehadiran

        function getkehadiran(){
        global $conn;

        $id = $_SESSION['id'];

    if($_SESSION['role']== 'siswa'){
        $queryKehadiran = mysqli_query($conn,"SELECT * FROM kehadiran WHERE siswa_id = '$id'");
    } elseif ($_SESSION['role'] == 'admin') {
        $queryKehadiran = mysqli_query($conn,"SELECT * FROM kehadiran");
    }


        $kehadiran = mysqli_fetch_all($queryKehadiran,MYSQLI_ASSOC);
    
        return $kehadiran;
    }

    
     // detail data siswa

        function detailData($request){
        global $conn;
        
        $id = ($request["id"]);
        $nama = ($request["nama"]);
        $nis = ($request["nis"]);
        $kelas = ($request["kelas"]);
        $jurusan  = ($request["jurusan"]);
        $jenis_kelamin  = ($request["jenis_kelamin"]);
        $no_hp  = ($request["no_hp"]);
        $asal_sekolah = ($request["asal_sekolah"]);
        $alamat_sekolah = ($request["alamat_sekolah"]);
        $tanggalawal_pkl = ($request["tanggalawal_pkl"]);
        $tanggalakhir_pkl = ($request["tanggalakhir_pkl"]);
        $tgl_absensi  = ($request["tgl_absensi"]);
        $catatan_siswa  = ($request["catatan_siswa"]);

        $query = "SELECT * FROM siswas
        nama = '$nama',
        nis = '$nis',
        kelas = '$kelas',
        jurusan = '$jurusan',
        jenis_kelamin = '$jenis_kelamin',
        no_hp = '$no_hp',
        asal_sekolah = '$asal_sekolah',
        alamat_sekolah = '$alamat_sekolah',
        tanggalawal_pkl = '$tanggalawal_pkl',
        tanggalakhir_pkl = '$tanggalakhir_pkl',
        tgl_absensi = '$tgl_absensi',
        catatan_siswa = '$catatan_siswa' WHERE id=$id";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }


    // list kehadiran

        function listKehadiran($request){
        global $conn;
        
        $id = ($request["id"]);;
        $nama = ($request["nama"]);
        $waktu_masuk = ($request["waktu_masuk"]);
        $waktu_keluar = ($request["waktu_keluar"]);
        $deskripsi_kerja_harian  = ($request["deskripsi_kerja_harian"]);

        $query = "SELECT * FROM kehadiran
        nama = '$nama',
        waktu_masuk = '$waktu_masuk',
        waktu_keluar = '$waktu_keluar',
        deskripsi_kerja_harian = '$deskripsi_kerja_harian' WHERE id=$id";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }


    // isi kehadiran

        function isiKehadiran($request){
        global $conn;

        $nama = $_SESSION['nama'];
        $waktu_masuk = htmlspecialchars($request["waktu_masuk"]);
        $waktu_keluar  = htmlspecialchars($request["waktu_keluar"]);
        $deskripsi_kerja_harian  = htmlspecialchars($request["deskripsi_kerja_harian"]);
    
        if(empty($waktu_masuk) || empty($waktu_keluar) || empty($deskripsi_kerja_harian)) {
            echo "<script>
                alert('Tidak Boleh Ada Data Kosong')
            </script>";
            return false;
        }

        $siswa_id = $_SESSION['id'];

        $query= "INSERT INTO kehadiran(siswa_id, nama,waktu_masuk,waktu_keluar,deskripsi_kerja_harian) VALUES ('$siswa_id','$nama', '$waktu_masuk', '$waktu_keluar', '$deskripsi_kerja_harian')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }


    // tambah data siswa

        function tambahData($request){
        global $conn;

        $new_password = password_hash($request["password"], PASSWORD_DEFAULT);

        $role = htmlspecialchars($request["role"]);
        $nama = htmlspecialchars($request["nama"]);
        $nis = htmlspecialchars($request["nis"]);
        $kelas = htmlspecialchars($request["kelas"]);
        $jurusan= htmlspecialchars($request["jurusan"]);
        $jenis_kelamin= htmlspecialchars($request["jenis_kelamin"]);
        $no_hp = htmlspecialchars($request["no_hp"]);
        $asal_sekolah= htmlspecialchars($request["asal_sekolah"]);
        $alamat_sekolah= htmlspecialchars($request["alamat_sekolah"]);
        $tanggalawal_pkl = htmlspecialchars($request["tanggalawal_pkl"]);
        $tanggalakhir_pkl = htmlspecialchars($request["tanggalakhir_pkl"]);
        $tgl_absensi= htmlspecialchars($request["tgl_absensi"]);
        $catatan_siswa = htmlspecialchars($request["catatan_siswa"]);
    
    
    
        if(empty($new_password) || empty($nama) || empty($nis) || empty($kelas) || empty($jurusan) || empty($jenis_kelamin) || empty($no_hp) || empty($asal_sekolah) || empty($alamat_sekolah) || empty($tanggalawal_pkl) || empty($tanggalakhir_pkl) || empty($tgl_absensi) || empty($catatan_siswa)) {
            echo "<script>
            alert('Tidak Boleh Ada Data Kosong')
            </script>";
            return false;
        }


        $query= "INSERT INTO siswas(role,password,nama,nis,kelas,jurusan,jenis_kelamin,no_hp,asal_sekolah,alamat_sekolah,tanggalawal_pkl,tanggalakhir_pkl,tgl_absensi,catatan_siswa) VALUES ('$role', '$new_password', '$nama', '$nis', '$kelas', '$jurusan', '$jenis_kelamin', '$no_hp', '$asal_sekolah', '$alamat_sekolah', '$tanggalawal_pkl', '$tanggalakhir_pkl', '$tgl_absensi', '$catatan_siswa')";
        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
    }


     // DELETE DATA 1
        function deleteData1($id){
        global $conn;

        $query= "DELETE FROM siswas WHERE
        id=$id";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }


     // DELETE DATA 2
     function deleteData2($id){
        global $conn;

        $query= "DELETE FROM kehadiran WHERE
        id=$id";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }


     // edit data siswa

        function editData($request){
        global $conn;

        $new_password = password_hash($request["password"], PASSWORD_DEFAULT);
  
        $id = ($request["id"]);
        $role = htmlspecialchars($request["role"]);
        $nama = htmlspecialchars($request["nama"]);
        $nis = htmlspecialchars($request["nis"]);
        $kelas = htmlspecialchars($request["kelas"]);
        $jurusan = htmlspecialchars($request["jurusan"]);
        $jenis_kelamin = htmlspecialchars($request["jenis_kelamin"]);
        $no_hp = htmlspecialchars($request["no_hp"]);
        $asal_sekolah = htmlspecialchars($request["asal_sekolah"]);
        $alamat_sekolah = htmlspecialchars($request["alamat_sekolah"]);
        $tanggalawal_pkl = htmlspecialchars($request["tanggalawal_pkl"]);
        $tanggalakhir_pkl = htmlspecialchars($request["tanggalakhir_pkl"]);
        $tgl_absensi = htmlspecialchars($request["tgl_absensi"]);
        $catatan_siswa = htmlspecialchars($request["catatan_siswa"]);


        if(empty($nama) || empty($nis) || empty($kelas) || empty($jurusan) || empty($jenis_kelamin) || empty($no_hp)  || empty($asal_sekolah)  || empty($alamat_sekolah)  || empty($tanggalawal_pkl)  || empty($tanggalakhir_pkl)  || empty($tgl_absensi)  || empty($catatan_siswa)) {
            echo "<script>
            alert('Tidak Boleh Ada Data Kosong')
            </script>";
            return false;
        }

        $query = "UPDATE siswas SET
        password = '$new_password',
        role = '$role',
        nama = '$nama',
        nis = '$nis',
        kelas = '$kelas',
        jurusan = '$jurusan',
        jenis_kelamin = '$jenis_kelamin',
        no_hp = '$no_hp',
        asal_sekolah = '$asal_sekolah',
        alamat_sekolah = '$alamat_sekolah',
        tanggalawal_pkl = '$tanggalawal_pkl',
        tanggalakhir_pkl = '$tanggalakhir_pkl',
        tgl_absensi = '$tgl_absensi',
        catatan_siswa = '$catatan_siswa' WHERE id=$id";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }


    // edit kehadiran siswa

    function editKehadiran($request){
        global $conn;
        
        $id = ($request["id"]);
        $waktu_masuk = htmlspecialchars($request["waktu_masuk"]);
        $waktu_keluar  = htmlspecialchars($request["waktu_keluar"]);
        $deskripsi_kerja_harian  = htmlspecialchars($request["deskripsi_kerja_harian"]);
    
        if(empty($waktu_masuk) || empty($waktu_keluar) || empty($deskripsi_kerja_harian)) {
            echo "<script>
                alert('Tidak Boleh Ada Data Kosong')
            </script>";
            return false;
        }

        $siswa_id = $_SESSION['id'];
        
        $query = "UPDATE kehadiran SET
        waktu_masuk = '$waktu_masuk',
        waktu_keluar = '$waktu_keluar',
        deskripsi_kerja_harian = '$deskripsi_kerja_harian' WHERE id=$id";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }


      // REGISTER

    function register($request){
        global $conn;

        $nis = htmlspecialchars(strtolower($request['nis']));
        $password = htmlspecialchars(mysqli_escape_string($conn, $request['password']));

        $query_siswas = mysqli_query($conn, "SELECT nis FROM siswas WHERE nis = '$nis'");
        
        if(empty($nis) ||empty ($password)) {
            echo"<script>
                    alert('tidak boleh ada data yang kosong')
                    document.location.href='register.php';
                </script>";
            return false;
        }

        if(mysqli_fetch_all($query_siswas, MYSQLI_ASSOC)) {
            echo"<script>
                    alert('email sudah terdaftar')
                    document.location.href='register.php';
                </script>";
            return false;
        }

        $new_password = password_hash($password, PASSWORD_DEFAULT);
        
        $nama= htmlspecialchars($request["nama"]);
        $nis = htmlspecialchars($request["nis"]);
        $kelas = htmlspecialchars($request["kelas"]);
        $jurusan= htmlspecialchars($request["jurusan"]);
        $jenis_kelamin= htmlspecialchars($request["jenis_kelamin"]);
        $no_hp = htmlspecialchars($request["no_hp"]);
        $asal_sekolah= htmlspecialchars($request["asal_sekolah"]);
        $alamat_sekolah= htmlspecialchars($request["alamat_sekolah"]);
        $tanggalawal_pkl = htmlspecialchars($request["tanggalawal_pkl"]);
        $tanggalakhir_pkl = htmlspecialchars($request["tanggalakhir_pkl"]);
        $catatan_siswa = htmlspecialchars($request["catatan_siswa"]);


        $query = "INSERT INTO siswas(nama,nis,password,kelas,jurusan,jenis_kelamin,no_hp,asal_sekolah,alamat_sekolah,tanggalawal_pkl,tanggalakhir_pkl,catatan_siswa) VALUES ('$nama', '$nis', '$new_password', '$kelas', '$jurusan', '$jenis_kelamin', '$no_hp', '$asal_sekolah', '$alamat_sekolah', '$tanggalawal_pkl', '$tanggalakhir_pkl', '$catatan_siswa')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }   


        //LOGIN

    function login($request){
        global $conn;

        $nis = htmlspecialchars(strtolower(stripcslashes($request['nis'])));
        $password = htmlspecialchars(mysqli_real_escape_string($conn, $request['password']));
        $errorlogin="nis atau password salah";

        $query_siswas = mysqli_query($conn, "SELECT * FROM siswas WHERE nis = '$nis'");
        
        if(mysqli_num_rows($query_siswas)== 1){
            $datasiswas= mysqli_fetch_assoc($query_siswas);

            if(password_verify($password, $datasiswas['password'])){
                $_SESSION['login'] = true;
                $_SESSION['id'] = $datasiswas ['id'];
                $_SESSION['nama'] = $datasiswas['nama'];
                $_SESSION['role'] = $datasiswas['role'];

                header('location: index.php');
                exit;

            } else {
                return $errorlogin;

            }
        } 
        return $errorlogin;
        }

?>