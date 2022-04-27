<?php
$user = "root";
$pass = "";
$host = "127.0.0.1";
$dbdb = "testegroupweb";
    
$conn = new mysqli($host, $user, $pass, $dbdb);
   if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$telefone = $_POST['telefone'];
$nome = $_POST['nome'];
$email = $_POST['email'];

try{

    $result = $conn->query("INSERT INTO users
                                        (name, email, telephone, activated)
                                VALUES( '$nome','$email','$telefone', 1);");


    if($result){
        $idUser = $conn->insert_id;
        $numero = intval($_POST['numero']);
        $cep = intval($_POST['cep']);
        $addresses = $conn->query("INSERT INTO addresses
                                            ( user_id, street, house_number, neigborhood, city, state, zip_code)
                                    VALUES ( $idUser, '$_POST[rua]', $numero, '$_POST[bairro]', '$_POST[cidade]', '$_POST[estado]', $cep);");
        if(!$addresses){
            header('Location: error.html');
            die();
        }
    }


    header('Location: sucess.html');
    die();


}catch(Exception $e){
    header('Location: error.html');
    die();
}
