
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Order Pizzas & drinks</title>
</head>
<body>

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
                <input type="text" id="email" name="email" class="form-control" value="<?=$emailFillIn ?? ""?>" require/>
                <?=$emailErr ?? "" ?>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>
            <div class="form-row">                
                <input type="checkbox" name="saveAddress" value="Yes" />
                <label for="saveAddress">Save your address for next time</label>
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="<?=$streetFillIn ?? ""?>">
                    <?=$streetErr ?? "" ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input type="text" id="streetnumber" name="streetnumber" class="form-control" value="<?=$streetnumberFillIn ?? ""?>">
                    <?=$streetnumberErr ?? "" ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value="<?=$cityFillIn ?? ""?>">
                    <?=$cityErr ?? "" ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?=$zipcodeFillIn ?? ""?>">
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
        <button type="submit" class="btn btn-primary" name="submit">Order!</button>
        
    </form>
    
    <footer>
    You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in pizza(s) and drinks.
    And your order will be arrived in <?php echo $deliverTime ?> hour.
    </footer>
</div>

<style>
    /* body{
        background:url("back1.png") repeat;
        color:darkblue;
        text-shadow:1px 1px 1.2px blue;
    } */
    footer {
        text-align: center;
    }
</style>
</body>
</html>
