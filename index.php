<?php
    error_reporting(0);
    require_once 'vendor/autoload.php';
    use FlyingLuscas\Correios\Client;

    $correios = new Client;
    $address = '';
    $control = '';
    if (isset($_GET['cep']) && $_GET['cep'] != ''){
        try{
            $returned = $correios->zipcode()->find($_GET['cep']);
            if (!empty($returned)){
                $address .= $returned['street'] . ', ';
                $address .= $returned['district'] . ' - ';
                $address .= $returned['city'];
                $control = 'success';
            }
        } catch (Error $e) {
            $address = 'CEP inválido';
            $control = 'danger';
        }
    }else {
        $address = 'Por favor, digite um CEP';
        $control = 'warning';
    }
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta CEP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="position-absolute top-50 start-50 translate-middle">
        <h1 class="display-1">Consulta CEP</h1>
        <form method="get" action="index.php">
            <div class="mb-3 mx-4 w-50">
                <label for="cep" class="form-label">CEP</label>
                <input id=cep name="cep" type="text" value="<?= $_GET['cep'] ?>" class="form-control">
                <button class="btn btn-primary my-2">Buscar</button>
            </div>
        </form>
        <div class="text-<?= $control ?> mx-4">
            <p><?= $address ?></p>
        </div>
    </div>
</body>
</html>