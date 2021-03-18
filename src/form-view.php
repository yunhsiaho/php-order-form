<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Order Pizzas & drinks</title>
</head>
<body>
<?php
    $street=" ";
    $streetnumber=" ";
    $city= " ";
    $zipcode=" ";
    if(isset($_POST["street"], $_POST["streetnumber"], $_POST["city"], $_POST["zipcode"], $_POST["email"])){
        
        if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)&&!empty($_POST["zipcode"])){
            $email=$_POST["email"];
        }else{ 
            $email="Unknown email";           
            $emailErr='<div class="alert alert-danger" role="alert">
            Enter a valide email!
            </div>';
            // mail($email,"subject", "body");
        }
        if(empty($_POST["street"])){
            $street="Unknown street";
            $streetErr='<div class="alert alert-danger" role="alert">
            Enter the street!
            </div>';
        }else{
            $street=$_POST["street"];
        }
        if(filter_var($_POST["streetnumber"],FILTER_VALIDATE_INT)&&!empty($_POST["street"])){
            $streetnumber=$_POST["streetnumber"];
        }else{
            $streetnumber="Unknown streetnumber";
            $streetnumberErr='<div class="alert alert-danger" role="alert">
            Enter a number for streetnumber!
            </div>';
        }
        if(empty($_POST["city"])){
            $city="Unknown city";
            $cityErr='<div class="alert alert-danger" role="alert">
            Enter the city!
            </div>';
        }else{
            $city=$_POST["city"];
        }
        if(filter_var($_POST["zipcode"],FILTER_VALIDATE_INT)&&!empty($_POST["zipcode"])){
            $zipcode=$_POST["zipcode"];            
        }else{
            $zipcode="Unknown zipcode";
            $zipcodeErr='<div class="alert alert-danger" role="alert">
            Enter a number for zipcode!
            </div>';                        
        }
        $niceAlert="Info received!"."</br>".
        "Your address is: $street, $streetnumber, $city $zipcode "."</br>".
        "Your email is: $email";     
    }
    ?>

<div class="container">
<div class="alert alert-info" role="alert">
    <?=$niceAlert ?? ""?>
</div>
    <h1>Order pizzas in restaurant "the Personal Pizza Processors"</h1>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order pizzas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="email" class="form-control" value="<?=$email ?? ""?>"/>
                <?=$emailErr ?? "" ?>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="<?=$street ?? ""?>">
                    <?=$streetErr ?? "" ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?=$streetnumber ?? ""?>">
                    <?=$streetnumberErr ?? "" ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value="<?=$city ?? ""?>">
                    <?=$cityErr ?? "" ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?=$zipcode ?? ""?>">
                    <?=$zipcodeErr ?? "" ?>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products AS $i => $product): ?>
                <label>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?php echo number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>
        
        <label>
            <input type="checkbox" name="express_delivery" value="5" /> 
            Express delivery (+ 5 EUR) 
        </label>
            
        <button type="submit" class="btn btn-primary">Order!</button>
    </form>
    
    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in pizza(s) and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>