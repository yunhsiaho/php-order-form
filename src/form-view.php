
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;600;700&family=Sansita+Swashed:wght@300;600;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Order Pizzas & drinks</title>
</head>
<body>

<div class="container ">
    <div class="alert alert-warning" role="alert">
        <?=$niceAlert ?? ""?>
    </div>
    <h1>Order pizzas in restaurant "the Personal Pizza Processors"</h1>
    <div class="row">   
        <div class="left col-5">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form"> 
                <div class="form-row ">
                    <div class="form-group col-md-12">
                        <label for="email">E-mail:</label>
                        <input type="text" id="email" name="email" class="form-control" value="<?=$emailFillIn ?? '' ?>" require/>
                        <?=$emailErr ?? ' ' ?>
                    </div>
                    <div></div>
                </div>

                <fieldset>
                    <legend>Address</legend>
                    <div class="form-row">                
                        <input type="checkbox" name="saveAddress" value="Yes" />
                        <label for="saveAddress">Save your address for next time</label>
                        <div class="form-group col-md-12">
                            <label for="street">Street:</label>
                            <input type="text" name="street" id="street" class="form-control" value="<?=$streetFillIn ?? ' ' ?>">
                            <?=$streetErr ?? "" ?>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="streetnumber">Street number:</label>
                            <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?=$streetnumberFillIn ?? ' ' ?>">
                            <?=$streetnumberErr ?? "" ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="city">City:</label>
                            <input type="text" id="city" name="city" class="form-control" value="<?=$cityFillIn ?? ' ' ?>">
                            <?=$cityErr ?? "" ?>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="zipcode">Zipcode</label>
                            <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?=$zipcodeFillIn ?? ' ' ?>">
                            <?=$zipcodeErr ?? "" ?>
                        </div>
                    </div>
                </fieldset>
            </form>    
        </div>
        <div class="right col-5">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form"> 
                <div class="d-flex flex-row flex-wrap  justify-content-center">
                    <a class="nav-link active" href="?food=1">Order pizzas</a>
                    <a class="nav-link" href="?food=0">Order drinks</a>
                </div>
                <fieldset>
                    <legend>Products</legend>
                    <?php foreach ($products AS $i => $product): ?>
                        <label>
                            <input type="checkbox" value="<?php echo number_format($product['price'],2) ?>" name="product-<?php echo $i?>"/> <?php echo $product['name'] ?> -
                            &euro; <?php echo number_format($product['price'], 2) ?></label><br />
                    <?php endforeach; ?>
                </fieldset>
                
                <label>
                    <input type="checkbox" name="express_delivery" value="5" /> 
                    Express delivery (+ 5 EUR) 
                </label>
                <br/>
                <br/>
                <button type="submit" class="btn btn-primary" name="submit">Order!</button>
            </form>
        </div>
    </div>
    <footer>
    You already ordered <strong>&euro; <?=$_COOKIE["showTotalValue"] ?? 0 ?></strong> in pizza(s) and drinks.</br>
    <i class="fas fa-fighter-jet"></i> Our drone will deliver your order in <strong><?php echo $deliverTime ?? '?' ?> hour</strong>.<hr/>
    </footer>
</div>

<style>
    body{
        background-color:#1e212d;
        /* color:darkblue;
        text-shadow:1px 1px 1.2px blue; */
        font-family: 'Caveat', cursive;
        font-family: 'Sansita Swashed', cursive;
        font-size:1.2vw;
        color:#faf3e0;
        text-align:center;
        align-items:center;
    }
    .container{
        width:80%;
        /* border:1px solid white; */
        justify-content:end; 
    }
    .left{
        margin-left:auto;
        margin-right:auto;
        justify-content:end; 
        padding:5%;
    }
    .right{
        margin-left:auto;
        margin-right:auto;
        padding:5%;
    }
    /* .col-5{
        border:1px solid white;
    } */
    footer {
        text-align: center;
    }
</style>
</body>
</html>
