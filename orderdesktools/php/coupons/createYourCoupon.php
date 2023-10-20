<head>
<?php 

    include('../session/db.php');
    include('../../style/style.html');
    error_reporting(E_ALL);
    include('../session/logged_in_status.php');
    include('../session/store_in_session.php');

    ini_set('display_errors', 1);


        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
            $agentID = $_SESSION['agentID'];
        } else {
            echo "User is not logged in";
        }

?>

<title>Coupon Creator</title>
<link rel="icon" type="image/x-icon" href="https://www.grillandpatio.com/image/IRG.png">
</head>

    <script>

        var agentID3 = "<?php echo isset($agentID) ? $agentID : ''; ?>";
        console.log(agentID3);

        var selectedStoreJS = "<?php echo isset($_SESSION['selectedStoreVarPHP']) ? $_SESSION['selectedStoreVarPHP'] : '';?>";
        console.log(selectedStoreJS);


    </script>

            <div class="main-title">
                <p><u>
                    Create a Coupon
                </p></u>
            </div>



                <table class="table tables table-bordered">
                    <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Quantity</th>
                            <th>Increment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="10bucks">$10</td>
                            <td id="10mult">0</td>
                            <td><button class="increment-button gbutton" data-value="10">Add 1</button>&nbsp;&nbsp;&nbsp;<button class="decrement-button rbutton" data-value="10m">Remove 1</button></td>
                        </tr>
                        <tr>
                            <td id="25bucks">$25</td>
                            <td id="25mult">0</td>
                            <td><button class="increment-button gbutton" data-value="25">Add 1</button>&nbsp;&nbsp;&nbsp;<button class="decrement-button rbutton" data-value="25m">Remove 1</button></td>
                        </tr>
                        <tr>
                            <td id="50bucks">$50</td>
                            <td id="50mult">0</td>
                            <td><button class="increment-button gbutton" data-value="50">Add 1</button>&nbsp;&nbsp;&nbsp;<button class="decrement-button rbutton" data-value="50m">Remove 1</button></td>
                        </tr>
                        <tr>
                            <td id="100bucks">$100</td>
                            <td id="100mult">0</td>
                            <td><button class="increment-button gbutton" data-value="100">Add 1</button>&nbsp;&nbsp;&nbsp;<button class="decrement-button rbutton" data-value="100m">Remove 1</button></td>
                        </tr>
                        <tr>
                            <td id="250bucks">$250</td>
                            <td id="250mult">0</td>
                            <td><button class="increment-button gbutton" data-value="250">Add 1</button>&nbsp;&nbsp;&nbsp;<button class="decrement-button rbutton" data-value="250m">Remove 1</button></td>
                        </tr>
                    </tbody>
                </table>
                <br>  

                    <p class="belowTable">Amount of this coupon: <span class="greentext">$</span><span id="couponAmount" class="greentext">0</span>
                        </p>
                    <button class="button-35" role="button" id="createCouponB" onclick="confirmCreate()">Create Coupon</button>


                    <p class="belowTable1 ">Your current coupon balance: <span class="greentext">$</span><span id="availableAmount" class="greentext">
                    </p>
                        <hr class="hr-text">
                        <p class="belowTable1">Amount used this month: <span class="greentext">$</span><span id="amountUsed" class="greentext">
                    </p>



                            <table id="couponsTable" border="1"  class="table tables table-bordered">
                                <thead>
                                    <tr>
                                        <th>Store</th>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Creation Date</th>
                                        <th>Order ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <td colspan="5" style="font-size: 21px;">Loading...</td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="belowTable1" id="noCouponsCreated">You haven't created any coupons this month.</div>
                            <br>
            
<script type="text/javascript" src="../../functions/couponFunctions.js"></script>
