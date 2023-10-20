<script
  src="https://code.jquery.com/jquery-3.7.0.js"
  integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
  crossorigin="anonymous"></script>

<head>
    <title>Admin Coupon Code Dashboard</title>
    <?php 
    include "db.php"; 
    include "style.html";
    ?>

</head>

<body>
    <div class="main-title">
        <p>
        Admin Coupon Code Dashboard
        </p>
    </div>

<br>

<div id="hidemeAfter1">
    <div class="input-class">
        <input type="password" id="passwordInput" class="custom-input" placeholder="Enter Password"></input>
        <input type="button" value="Login" id="theButton" class="theButton" onclick="checkPassword()"></input>  
    </div>
</div>

<div id="showmeAfter1" class="showmeAfter1">
    
<table class="table tables table-bordered"  style="width:1000px">
        <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
 
        <tr>
                <td >
                    <label for="couponName">Coupon Name</label>
                </td>
                <td>
                <input type="text" id="couponName" name="fname" placeholder="Coupon name" maxlength="50">
                </td>
        </tr>
        <tr>
                <td >
                    <label for="couponCode">Coupon Code</label>
                </td>
                <td>
                <input type="text" id="couponCode" name="fname" maxlength="11">
                </td>
        </tr>
        <tr>
                <td >
                    <label for="couponType">Coupon Type</label>
                </td>
                <td>
                <select type="text" id="couponType" name="fname" style="width:205px; height:25px;">
                    <option value="P">Percentage</option>
                    <option value="F">Fixed Amount</option>
</select>
                </td>
        </tr>
        <tr>
                <td >
                    <label for="couponAmount">Coupon Amount</label>
                </td>
                <td>
                <input type="number" id="couponAmount" placeholder="Coupon Amount" name="fname">
                </td>
        </tr>
        <tr>
                <td >
                    <label for="minimumAmount">Minimum Amount (0 for none)</label>
                </td>
                <td>
                <input type="number" id="minimumAmount" name="fname" value="0">
                </td>
        </tr>
        <tr>
                <td >
                    <label for="dateStart">Date Start</label>
                </td>
                <td>
                <input type="date" id="dateStart" name="fname" style="width:205px; height:25px;">
        </tr>
        <tr>
                <td >
                    <label for="dateEnd">Date End</label>
                </td>
                <td>
                <input type="date" id="dateEnd" name="fname"  style="width:205px; height:25px;">
                </td>
        </tr>
        <tr>
                <td >
                    <label for="usesPerCoupon">Uses Per Coupon (0 for unlimited)</label>
                </td>
                <td>
                <input type="number" id="usesPerCoupon" name="fname" value="1">
                </td>
        </tr>
        <tr>
                <td >
                    <label for="usesPerCustomer">Uses Per Customer (0 for unlimited)</label>
                </td>
                <td>
                <input type="number" id="usesPerCustomer" name="fname" value="1">
                </td>
        </tr>
 
 
 
 
        <tr>
                <td >
                    <label for="DIM">DimplexStore.com</label>
                </td>
                <td>
                    <input type="checkbox" id="DIM" name="DIM" value="DIM"> 
                </td>
            </tr>
            <tr>
                <td >
                    <label for="FMP">FireMagicParts.com</label>
                </td>
                <td>
                    <input type="checkbox" id="FMP" name="FMP" value="FMP"> 
                </td>
            </tr>
            <tr>
                <td >
                    <label for="FMS">FireMagicStore.com</label>
                </td>
                <td>
                    <input type="checkbox" id="FMS" name="FMS" value="FMS"> 
                </td>
            </tr>
            <tr>
                <td >
                <label for="FPG">FireplaceandGrill.com</label>
                </td>
                <td>
                    <input type="checkbox" id="FPG" name="FPG" value="FPG"> 
                </td>
            </tr>
            <tr>
                <td >
                    <label for="GNP">GrillandPatio.com</label>
                </td>
                <td>
                    <input type="checkbox" id="GNP" name="GNP" value="GNP"> 
                </td>
            </tr>
            <tr>
                <td >
                    <label for="RFS">RealFyreStore.com</label>
                </td>
                <td>
                    <input type="checkbox" id="RFS" name="RFS" value="RFS"> 
                </td>
            </tr>
        </tbody>
    </table>





<br>
    
    <!--   <div class="page-container">
    
  
    <div class="left-column">
    <p class="lowerAdmin1">Select the Stores
    </p>
        <div class="checkbox-container">
            <label for="DIM"><input type="checkbox" value="DIM" class="checkboxes" id="DIM">DimplexStore</label>
            <label for="FPG"><input type="checkbox" value="FPG" class="checkboxes" id="FPG">FireplaceAndGrill</label>
            <label for="FMP"><input type="checkbox" value="FMP" class="checkboxes" id="FMP">FireMagicParts</label>
            <label for="FMS"><input type="checkbox" value="FMS" class="checkboxes" id="FMS">FireMagicStore</label>
            <label for="GNP"><input type="checkbox" value="GNP" class="checkboxes" id="GNP">GrillAndPatio</label>
            <label for="RFS"><input type="checkbox" value="RFS" class="checkboxes" id="RFS">RealFyreStore</label>
        </div>
    </div>
    <div class="middle-column" style="display: flex; flex-direction: column; align-items: flex-start;">
    <p class="lowerAdmin2">Select the Dates</p>
    <label for="startingDate" class="lowerAdmin3">Starting date:</label>
    <input id="startingDate" name="dateInput" placeholder="2023-08-17">
    <br>
    <br>
    <label for="endingDate" class="lowerAdmin3">Ending date:</label>
    <input id="endingDate" name="dateInput" placeholder="2023-08-18">
</div>


    <div class="right-column">
     <p class="lowerAdmin2">Coupon Criteria</P>
    
        
        <div class="leftAlign1">
        Type of coupon: <select name="typeOfCoupon" class="selectAmount">
                <option value="F">Fixed Amount</option> 
                <option value="P">Percentage</option>
            </select>
            <br>
        Minimum total: <input placeholder="Enter 0 for none" style="margin-top: 15px;" id="minimumTotalAdmin"></input>
        <br>
        Uses per coupon: <input placeholder="Enter 0 for unlimited" style="margin-top: 15px;" id="usesPerCouponAdmin"></input>
        <br>
        Uses per cust: <input placeholder="Enter 0 for unlimited" style="margin-top: 15px;" id="usesPerCustomerAdmin"></input>
            
        </div>
</div>
    </div>
    <br>
<div class="row">
<p class="lowerAdmin2">
<u>Name, Code, and Amount</u>
</p>    
<br>
    <div class="col-4">
    Coupon Name
    <br>
    <input id="couponNameAdmin" name="couponName" placeholder="Coupon Name">
    </div>

    <div class="col-4">
    Coupon Code
    <br>
    <input id="couponCodeAdmin" name="couponCode" placeholder="Max 10 Characters">
    </div>

    <div class="col-4">
    Coupon Amount
    <br>
    <input id="couponAmountAdmin" name="couponAmount" placeholder="Coupon Amount">
    </div>

</div>
-->



<button class="button-35 hideBeforePW" role="button" id="createCouponB" onclick="createCouponB()">Create Coupon</button>
</div>
</div>
<br>


    <script type="text/javascript" src="functionsAdmin.js"></script>  
</body>