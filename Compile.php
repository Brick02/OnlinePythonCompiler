<?php
echo '';
function generateRandomString($length = 16) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
$rand = generateRandomString();
$target_dir = "uploads/";
$target_file = $target_dir .$rand . '/' . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($imageFileType != "py" ) {
    echo "Sorry, your file is not a python file.  ";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "your file was not uploaded.";

} else {
    mkdir("E:\wamp64\www\uploads/" . $rand , 0777, true);
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been compiled!";
    } else {
        echo "Sorry, there was an error compiling your file.";
    }
}

$testpy = basename( $_FILES["fileToUpload"]["name"]);
$testexe = $testpy;
$testexe = substr($testexe,0,-2) . "exe";
echo $testexe;
$path = "E:\wamp64\www\uploads/" . $rand . "/";

if ($uploadOk != 0) {
	shell_exec("e:&&cd E:\wamp64\www\uploads/" . $rand . "&&pyinstaller --distpath ". $path . " --onefile ".$path . $testpy);	
}
if ($uploadOk != 0) {
	echo '
	<style> 
body {
    background-image: url("/data/background.jpg");
    background-color: #cccccc;
    
}
</style>
<h2>Thank you for using Python2exe.com</h2>
	<a href="'."uploads/". $rand . '/' .$testexe.'">'.$testexe.'</a>';
}
?>
