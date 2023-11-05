<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bowlby+One&family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>

<?php 
    $sn = "localhost"; $un = "root"; $pw = "root"; $db = "dbgabriel";
    $con = mysqli_connect($sn, $un, $pw, $db);
    if(mysqli_connect_errno()){ echo "erro"; exit(); }

    
    function select ($tabela, $valor="*", $where="1=1"){
        global $con;
    
        $resultado = []; 
        $n = 0;
        $select = "SELECT $valor from $tabela where $where";
    
        $result = mysqli_query($con, $select);
    
        if ( $result->num_rows > 0 ) {
            while( $row = $result->fetch_assoc() ) {
                foreach ( $row as $key=>$value ){ 
                    $resultado[$n][$key] = $value;
                } 
                $n++;
            } 
        }
    
        return $resultado;
    }

    function mostrarTodos ($arr){

        foreach ($arr as $pet) {

            // url com codigo e nome do pet
            $url = 'integra.php?codigo='.$pet['code_'].'&nome='.$pet['name_'];

            echo 
            '<div class="col-xxl-3 col-4">
                <div class="card rounded overflow-hidden">
                    <a href="'.$url.'">
                    '.// imagem principal do pet
                    '
                        <img src="img/'.$pet['image_'].'" alt="" class="w-100 object-fit-cover" height="320">
                    </a>
    
                    <div class="p-3">
                    '.// código do pet
                    '
                        <p class="m-0 fs-sm">Cód. '.$pet['code_'].'</p>
    
                        <div class="d-flex align-items-center gap-2 mt-2 py-2">
                            '.// nome do pet
                            '
                            <h3 class="h4 m-0">'.$pet['name_'].'</h3>
                            '.

                            ($pet['sex_'] == 'm' ? 
                            // caso m
                            '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-gender-male" viewBox="0 0 16 16">
                                <path fill="#006AB0" fill-rule="evenodd" d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/>
                            </svg>'
                            :
                            // caso nao m (f)
                            '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-gender-female" viewBox="0 0 16 16">
                                <path fill="#FF7373" fill-rule="evenodd" d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z"/>
                            </svg>')

                            .'
                        </div>
    
                        '.// localização do pet
                        '
                        <p class="mb-4 fs-md">'.$pet['local_'].'</p>

                        
                        <a href="'.$url.'" class="btn btn-custom-2 d-flex align-items-center justify-content-center gap-2 w-100">
                            Quero Adotar
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>';

        }

    }



    // $animals = select("Pet");

    // print_r($animals);


    // mostrarTodos($animals);



    // $arrayAnimals = [];

    // foreach ($animals as $animal) {
        
    //     $obj = [];

    //     foreach ($animal as $key => $value) {
    //         print($key);
    //         echo ": ";
    //         print($value);
    //         echo "<br>";
    //         $obj[$key] = $value;
    //     }

    //     echo "<br><br>";
    //     $arrayAnimals[] = $obj;
    // }

    // print_r($arrayAnimals);

?>

    
</body>
</html>