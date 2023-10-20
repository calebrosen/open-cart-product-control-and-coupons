<head>

    <title>Release a Product</title>

    <?php 
    include('../session/db.php');
    include('../../style/style.html');
    error_reporting(E_ALL);
    include('../session/logged_in_status.php');
    include('../session/store_in_session.php');
    ini_set('display_errors', 1);
    
/*
    if ($_SESSION['checker'] !== 1) {

    header("Location: index.php");
    exit();  
    }
*/

    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
        $agentID = $_SESSION['agentID'];
    } else {
        echo "User is not logged in";
    }
  

    ?>
    
</head>




    <script>

        var agentIDforRelease = "<?php echo isset($agentID) ? $agentID : ''; ?>";
        console.log(agentIDforRelease);

        var selectedStoreJS = "<?php echo isset($_SESSION['selectedStoreVarPHP']) ? $_SESSION['selectedStoreVarPHP'] : '';?>";
        console.log(selectedStoreJS);

    </script>



<body>

<div class="main-title">
    <p><u>
        Release a Product
    </p></u>
</div>
<br>


<br>


<div class="productRelease" style="text-align:center;">

<?php 

$pullProducts = "CALL federatedb.usp_pullReleasableProducts_v3('" . $_SESSION['selectedStoreVarPHP'] . "')";



    if  ($r_set = $connection->query($pullProducts))
        {
            echo '<select name="product" id="releaseList" class="selectize">';
            echo '<option value="0" id="first" style="padding: 9px;" disabled selected>Enter a Product Here</option>';
            
            while ($row = $r_set->fetch_assoc()) {
                echo '<option value="' . $row['mpn'] . '" style="padding: 9px;">' . $row['mpn'] . '</option>';
            }
            
            echo '</select>';
        }
?>
</div>

<br>
<div class="productReleaseBox"  style="text-align:center;">
<select id="setQuantity" name="Quantity" class="selectize" style="margin-top:-15px;">
    <option value="0" disabled selected>Quantity to Release</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
</select>
    </div>

</div>

<br>



<button class="button-35 leftalignedText" role="button" id="createCouponB" style="padding: 20px; margin-top:150px; font-size:30px; text-align:center;" onclick="confirmRelease()">Release Product</button>
<button class="button-35 leftalignedText" role="button" style="padding: 20px; margin-top:150px; font-size:30px; text-align:center;" onclick="goToHomePage()">Go Back</button>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
  integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
  integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>
<script type="text/javascript" src="../../functions/releaseFunctions.js"></script>
</body>