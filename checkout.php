<?php
session_start();


var_dump($_SESSION);
//die;
$product_ids= $_SESSION['korpa'];
print_r(array_keys($product_ids));
$product_ids_string= implode(",",$product_ids);

//$array = array('lastname', 'email', 'phone');
//$comma_separated = implode(",", $array);

require_once('./connections_database.php');
$select= "SELECT id,ime_proizvoda,cijena FROM products WHERE id IN ({$product_ids_string})";

$rezultat = $conn->query($select);
$proizvodi=[];

if($rezultat->num_rows>0){
    while ($row = $rezultat->fetch_assoc())
    {
        $proizvodi [] = $row;
    }

}
var_dump($proizvodi);

//SELECT
//    column1,column2,...
//FROM
//    table_name
//WHERE
//	(expr|column_1) IN ('value1','value2',...);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chekout krope</title>
    <style>
        .container {
            width: 900px;
            margin: auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col {
            width: 25%;
        }

        .col-20 {
            width: 20%;
        }

        .col-80 {
            width: 80%;
        }

        .col-100 {
            width: 100%;
        }

        .product h5 {text-align: center;}

        .product-detail h5 {
            text-align: left;
        }

        .product img {
            width: 80%;
            margin: auto;
            display: block;
        }

        .product .specs a,
        .product-detail a.buy {
            background: red;
            color: white;
            text-decoration: none;
            padding: 2px 10px;
            border-radius: 10px;
            transition: background .3s, color .3s;
            border: solid thin red;
        }

        .specs {
            margin-top: 7px;
            justify-content: space-around;
            display: flex;
        }

        .product:hover .specs a,
        .product-detail:hover a.buy {
            background: orange;
            color: red;
        }

        .product .specs:hover a,
        .product-detail h5:hover a.buy {
            background: yellow;
            color: orange;
        }

        .product .specs a:hover,
        .product-detail a.buy:hover {
            background: white;
            color: red;
        }

        .cart {
            position: fixed;
            right: 5px;
            top: 5px;
            padding: 6px 11px;
            border-radius: 30px;
        }
        .cart:hover>svg>path {
            stroke: white;
        }

        .cart>svg>path {
            transition: stroke .4s;
        }

        .cart {
            transition: background .4s;
        }

        .cart:hover {
            background: black;
        }

        table.table {
            width: 70%;
            margin: auto;
        }

        table.table td+td, table.table tfoot th+th {
            text-align: right;
        }

        table.table thead, table.table tfoot {
            background-color: gainsboro;
        }

        table.table tbody tr td {
            border-bottom: solid thin black;
        }
    </style>
</head>
<body>


<a class="cart" href="/checkout.php">
    <svg width="50" height="50" viewBox="0 0 128 128" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8 8H19C19 8 19.941 16.2521 21.1896 27M21.1896 27C23.2225 44.4994 26.0707 68.6147 27 74.5C28.5 84 29.5 84 37 84H97.5C103.398 83.3094 105.275 80.9491 107 74.5L115.5 34C116.047 27.7841 113.437 26.9255 107 27H21.1896Z" stroke="#000000" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M49 108.5C49 113.194 45.1944 117 40.5 117C35.8056 117 32 113.194 32 108.5C32 103.806 35.8056 100 40.5 100C45.1944 100 49 103.806 49 108.5ZM97 108.5C97 113.194 93.1944 117 88.5 117C83.8056 117 80 113.194 80 108.5C80 103.806 83.8056 100 88.5 100C93.1944 100 97 103.806 97 108.5Z" stroke="#000000" stroke-width="8" />
    </svg>
</a>
<div class="container">
    <div class="row">
        <div class="col-h">
            <h1>Checkout korpe</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-100">
            <table class="table">
                <thead>
                <tr>
                    <th>Ime proizvoda</th>
                    <th>Cijena</th>
                    <th>Kolicina</th>
                    <th>Ukupno</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Proizvod 1</td>
                    <td>2.25 KM</td>
                    <td>4</td>
                    <td>9.00 KM</td>
                </tr>
                <tr>
                    <td>Proizvod 2</td>
                    <td>3.00 KM</td>
                    <td>1</td>
                    <td>3.00 KM</td>
                </tr>
                <tr>
                    <td>Proizvod 3</td>
                    <td>3.50 KM</td>
                    <td>5</td>
                    <td>17.50 KM</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="3">Ukupno</th>
                    <th>29.50 KM</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


</body>
</html>