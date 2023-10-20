
<?php 
session_start();
$_SESSION['checker'] = 0;
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo $_SESSION['checker'];
?>


 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Coupon Code</title>
    <style>

        #couponCodeHere {
            font-size: 85px;
            text-align: center;
        }

        .big {

            font-size: 100px;
            text-align: center;
        }
    </style>
</head>
<body>
<div id="couponCodeHere" style="font-size: 100px; text-align: center;"></div>


    <script>

const couponCodeElement = document.getElementById("couponCodeHere");
const couponCodeText = "Your coupon code is " + couponCode + ".";

const textNode = document.createTextNode(couponCodeText);
couponCodeElement.appendChild(textNode);

    </script>
</body>
</html>
