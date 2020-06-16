<?php 

if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
    $fileName = $_FILES['uploadedFile']['name'];
    $fileSize = $_FILES['uploadedFile']['size'];
    $fileType = $_FILES['uploadedFile']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

    $allowedFileExtension = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
    if (in_array($fileExtension, $allowedFileExtension)) {
        $uploadFileDir = './uploaded_files/';
        $dest_path = $uploadFileDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $message = 'File Succesfully Upload.';
            echo "Menuju File : <a href='".$uploadFileDir.$newFileName."'>".$newFileName."</a>";
        } else {
            $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
        }
    }
}

?>
