<?php 

$conn = mysqli_connect("localhost", "root", "", "db_upload");

function tambah($data) {
    global $conn;
    
    $namaFile = upload();
    if (!$namaFile) {
        return false;
    }

    $query = "INSERT INTO `file` (`id`, `nama_file`)
            VALUES ('', '$namaFile')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['uploadedFile']['name'];
    $ukuranFile = $_FILES['uploadedFile']['size'];
    $error = $_FILES['uploadedFile']['error'];
    $tmpName = $_FILES['uploadedFile']['tmp_name'];

    if ($error == 4) {
        echo "
            <script>
                alert('Upload File terlebih dahulu!');               
            </script>
            ";
        return false;            
    }

    $ekstensiFileValid = ['jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc'];
    $ekstensiFile = explode(".", $namaFile);
    $ekstensiFile = strtolower(end($ekstensiFile));
    if( !in_array($ekstensiFile, $ekstensiFileValid)) {
        echo "
            <script>
                alert('Ekstensi File Dilarang!');               
            </script>
            ";
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;
    
    move_uploaded_file($tmpName, 'img/'.$namaFileBaru);

    return $namaFileBaru;
}

    if (isset($_POST["uploadBtn"])) {
        if ( tambah($_POST) > 0) {
            echo "
                <script>
                    alert('File Berhasil Ditambah!');               
                </script>
                ";
            echo "File Succesfully Uploaded!";
        } else {
            echo "
                <script>
                    alert('File Gagal Ditambah!');
                    document.location.href = 'index.php';
                </script>
                ";
        }
    }

?>
