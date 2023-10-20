<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<head>
    <title>Order Desk Tools</title>


    <?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include "./php/session/db.php"; 
    include "style/style.html";
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ?>


</head>

<body>

<img src="https://www.grillandpatio.com/image/IRG_index.png" style="text-align:center; margin-top:18px;">
    <div class="main-title">
        <p><u>
            Order Desk Tools
        </p></u>
    </div>
    <br>

            <div class="scaled">


            <div class="row hideBeforePW">
                    <div class="select-box hideBeforePW" id="storeSelectionDiv">
                                    <select name="store" class='custom-select' id="storeSelection" onchange="getStoreValue()">
                                        <option value="0" id="123" disabled selected>Select a Store</option>
                                        <option value="DIM">DimplexStore.com</option>
                                        <option value="FMP">FireMagicParts.com</option>
                                        <option value="FMS">FireMagicStore.com</option>
                                        <option value="FPG">FireplaceandGrill.com</option>
                                        <option value="GNP">GrillandPatio.com</option>
                                        <option value="RFS">RealFyreStore.com</option>
                                    </select>
                                <button id="storeSubmitButton" class="custom-button" onclick="getStore()">Confirm Store</button>
                    </div>
            </div>
                

    <div id="showAfterStoreSelected">
            <div class="hideBeforePW" style="text-align:center;">
                <p style="margin-top:-10px;">Store Selected: <span id="appendStore"></span></p>
                <button class="custom-button" onclick="reselectStore()">Change Store</button>
            </div>
                        <div class="row hideBeforePW">
                        <p class="subtitle">
                        What would you like to do?
                        </p>
                        <p>
                        </p>
                        <br>
                        </div>


                            <div class="row hideBeforePW">
                                <div class="col-3">
                            </div>
                            <div class="col-3">
                                <a href="php/coupons/createYourCoupon.php">
                                <button class="custom-button">Create a Coupon</button>
                                </a>
                            </div>

                            <div class="col-3">
                                <a href="php/releases/releaseProduct.php">
                                <button class="custom-button">Release a Product</button>
                                </a>
                            </div>
                            <div class="col-3">
                            </div>
                            </div>
                            <br>
                    
     </div>




                            <div style="display: flex; justify-content: center; align-items: center;">
                                <div class="select-box" id="hidemeAfter" style="margin-right: 25px;">
                                    <?php
                                    if ($r_set = $connection->query("call federatedb.usp_GetAgentList")){
                                        echo "<select id='A' name='agentname' class='custom-select'>";
                                        echo "<option value='1234' id='1234' disabled selected>Select an Agent</option>";
                                        while ($row = $r_set->fetch_assoc()) {
                                            echo "<option value='{$row['AgentID']}'>{$row['Agent']}</option>";
                                        }
                                        echo "</select>";
                                    }
                                    ?>
                                </div>

                                <div class="select-box" style="margin-right: 25px;">
                                    <input type="password" id="passwordInput" class="custom-input" placeholder="Enter Password">
                                </div>

                                <div class="select-box">
                                    <button id="passwordSubmitButton" class="custom-button" onclick="checkPassword()">Submit Password</button>
                                </div>
                            </div>



<script type="text/javascript" src="functions/functions.js"></script> 

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


</body>
</html>
