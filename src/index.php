<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

$products = getProducts();

function getProducts () {
    $products = [
        ['name' => 'Margherita', 'price' => 8],
        ['name' => 'Hawaï', 'price' => 8.5],
        ['name' => 'Salami pepper', 'price' => 10],
        ['name' => 'Prosciutto', 'price' => 9],
        ['name' => 'Parmiggiana', 'price' => 9],
        ['name' => 'Vegetarian', 'price' => 8.5],
        ['name' => 'Four cheeses', 'price' => 10],
        ['name' => 'Four seasons', 'price' => 10.5],
        ['name' => 'Scampi', 'price' => 11.5]
    ];

    if(isset($_GET['food']) && $_GET["food"] == "0"){
            $products = [
                ['name' => 'Water', 'price' => 1.8],
                ['name' => 'Sparkling water', 'price' => 1.8],
                ['name' => 'Cola', 'price' => 2],
                ['name' => 'Fanta', 'price' => 2],
                ['name' => 'Sprite', 'price' => 2],
                ['name' => 'Ice-tea', 'price' => 2.2],
            ];
    };

    return $products;
};


//your products with their price.

if(isset($_POST["street"], $_POST["streetnumber"], $_POST["city"], $_POST["zipcode"], $_POST["email"],$_POST["submit"])){
    $email="";
    $street="";
    $streetnumber="";
    $city= "";
    $zipcode="";
    $submit=$_POST["submit"];
    if(filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)&&!empty($_POST["zipcode"])){
        $email=$_POST["email"];
    }else{ 
        $emailFillIn=$_POST["email"]; ;           
        $emailErr='<div class="alert alert-danger" role="alert">
        Enter a valide email!
        </div>';
        $submit=false;
    }
    if(empty($_POST["street"])){
        $streetFillIn=$_POST["street"];
        $streetErr='<div class="alert alert-danger" role="alert">
        Enter the street!
        </div>';
        $submit=false;
    }else{
        $street=$_POST["street"];            
    }
    if(filter_var($_POST["streetnumber"],FILTER_VALIDATE_INT)&&!empty($_POST["street"])){
        $streetnumber=$_POST["streetnumber"];
    }else{
        $streetnumberFillIn=$_POST["streetnumber"];
        $streetnumberErr='<div class="alert alert-danger" role="alert">
        Enter a number for streetnumber!
        </div>';
        $submit=false;
    }
    if(empty($_POST["city"])){
        $cityFillIn=$_POST["city"];
        $cityErr='<div class="alert alert-danger" role="alert">
        Enter the city!
        </div>';
        $submit=false;
    }else{
        $city=$_POST["city"];
    }
    if(filter_var($_POST["zipcode"],FILTER_VALIDATE_INT)&&!empty($_POST["zipcode"])){
        $zipcode=$_POST["zipcode"];            
    }else{
        $zipcodeFillIn=$_POST["zipcode"];
        $zipcodeErr='<div class="alert alert-danger" role="alert">
        Enter a number for zipcode!
        </div>';     
        $submit=false;                 
    }
    //save address checkbox
    if(isset($_POST['saveAddress'])){
        setcookie("street", $street, time()+60*60*24*7,"/");
        $streetFillIn=$_COOKIE["street"];
        setcookie("streetnumber", $streetnumber, time()+60*60*24*7,"/");
        $streetnumberFillIn=$_COOKIE["streetnumber"];
        setcookie("city", $city, time()+60*60*24*7,"/");
        $cityFillIn=$_COOKIE["city"];
        setcookie("zipcode", $zipcode, time()+60*60*24*7,"/");
        $zipcodeFillIn=$_COOKIE["zipcode"];
    }
    //the blue alert box above
    $niceAlert="Info received!"."</br>".
    "Your address is: $street, $streetnumber, $city $zipcode "."</br>".
    "Your email is: $email";   

    if(isset($_COOKIE['showTotalValue'])){
        $totalValue = 0;
        $totalValue = (float) $_COOKIE['showTotalValue'];
    }else{
        $totalValue = 0;
    }
    
    $deliverTime = 1;
    if(isset($_POST['express_delivery'])){
        $deliverTime = 0.5;
        $totalValue+=5;
    }
    foreach ($products AS $i => $product){
        if(isset($_POST["product-{$i}"])){
            $totalValue += $product['price'];
        }
    }
    setcookie("showTotalValue", "$totalValue", time()+60*60*24,"/");

    //mail
    $subject = 'the pizzas order';
    define("Greeting", "to $email
    Hello cher client,
    We have received your order and it will be sent to
    $street, $streetnumber, $city $zipcode in $deliverTime hr.
    The total price is $totalValue dollars.
    Thank you very much and bon apetit!");

    mail($email,$subject , "Greeting");
} 







require 'form-view.php';


