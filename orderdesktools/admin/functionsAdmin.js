let checkedValues = {}; 

function hideBeforePassword() {
    var elementsToHide = document.getElementsByClassName("showmeAfter1");
    
    for (var i = 0; i < elementsToHide.length; i++) {
        elementsToHide[i].style.display = 'none';
    }
}

hideBeforePassword();



/*
  // promise for password re-pulling
  function fetchData() {
    return new Promise((resolve, reject) => {
        var enteredPassword = document.getElementById("passwordInput").value;
        var enteredUsername = document.getElementById("A").value;

        $.ajax({
            url: "checkPassword.php",
            method: "POST",
            data: { username: enteredUsername, password: enteredPassword },
            dataType: "json",
            success: resolve,
            error: reject,
        });
    });
}
*/
function checkPassword() {
    var passwordInput = document.getElementById("passwordInput").value;

    $.ajax({
        url: "checkAdminPassword.php",
        method: "POST",
        data: { password: passwordInput },
        dataType: "json",
        success: function(data) {
            if (data.valid) {
                var elementsToUnhide = document.getElementsByClassName("showmeAfter1");
                for (var i = 0; i < elementsToUnhide.length; i++) {
                    elementsToUnhide[i].style.display = 'block';
                }

                document.getElementById("hidemeAfter1").style.display = 'none';
            } else {
                alert("Incorrect password. Please try again.");
            }
        },
        error: function(error) {
            console.log("Error:", error);
            alert("Error checking password. Please try again later.");
        }
    });
}





// swap date format to db format
function formatDate(dateString, useUTC) {
    const date = new Date(dateString);
    if (useUTC) {
        const utcYear = date.getUTCFullYear();
        const utcMonth = (date.getUTCMonth() + 1).toString().padStart(2, '0');
        const utcDay = date.getUTCDate().toString().padStart(2, '0');
        return `${utcYear}-${utcMonth}-${utcDay}`;
    } else {
        const year = date.getFullYear();
        const month = (date.getMonth() + 1).toString().padStart(2, '0');
        const day = date.getDate().toString().padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
}











function updateReturnValue() {
    var FMPChecked = $("#FMP").prop("checked");
    var FMSChecked = $("#FMS").prop("checked");
    var FPGChecked = $("#FPG").prop("checked");
    var RFSChecked = $("#RFS").prop("checked");
    var DIMChecked = $("#DIM").prop("checked");
    var GNPChecked = $("#GNP").prop("checked");
    
    return {
        FMP: FMPChecked ? 1 : 0,
        FMS: FMSChecked ? 1 : 0,
        FPG: FPGChecked ? 1 : 0,
        RFS: RFSChecked ? 1 : 0,
        DIM: DIMChecked ? 1 : 0,
        GNP: GNPChecked ? 1 : 0
    };
}



let updatingCheckboxes = false;

$("#FMP, #FMS, #FPG, #RFS, #DIM, #GNP").off("change").change(function() {
    if (!updatingCheckboxes) {
        updatingCheckboxes = true;
        checkedValues = updateReturnValue();
        updatingCheckboxes = false;
        checkFields();
    }
});




function checkFields() {
    var couponName = document.getElementById("couponName").value;
    var couponCode = document.getElementById("couponCode").value;
    var couponType = document.getElementById("couponType").value;
    var couponAmount = document.getElementById("couponAmount").value;
    var minimumAmount = document.getElementById("minimumAmount").value;
    var dateStart = document.getElementById("dateStart").value;
    var dateEnd = document.getElementById("dateEnd").value;
    var usesPerCoupon = document.getElementById("usesPerCoupon").value;
    var usesPerCustomer = document.getElementById("usesPerCustomer").value;
    console.log(couponName);
    console.log(couponCode);
    console.log(couponType);
    console.log(couponAmount);
    console.log(minimumAmount);
    console.log(dateStart);
    console.log(dateEnd);
    console.log(usesPerCoupon);
    console.log(usesPerCustomer);

    checkedValues = updateReturnValue(); // Update checkedValues
    
    console.log("DIM: " + checkedValues.DIM);
    console.log("FMP: " + checkedValues.FMP);
    console.log("FMS: " + checkedValues.FMS);
    console.log("FPG: " + checkedValues.FPG);
    console.log("GNP: " + checkedValues.GNP);
    console.log("RFS: " + checkedValues.RFS);


    let formattedStartingDate = "";
    let formattedEndingDate = "";

    const startingDateInput = document.getElementById("dateStart");
    const endingDateInput = document.getElementById("dateEnd");

    const startingDateValue = startingDateInput.value;
    const endingDateValue = endingDateInput.value;

    formattedStartingDate = formatDate(startingDateValue, true); // Pass true to indicate UTC
    formattedEndingDate = formatDate(endingDateValue, true); // Pass true to indicate UTC




    startingDateInput.value = formattedStartingDate;
    endingDateInput.value = formattedEndingDate;

    console.log("Formatted Starting Date:", formattedStartingDate);
    console.log("Formatted Ending Date:", formattedEndingDate);
};




function createCouponB() {
    var couponName = document.getElementById("couponName").value;
    var couponCode = document.getElementById("couponCode").value;
    var couponType = document.getElementById("couponType").value;
    var couponAmount = document.getElementById("couponAmount").value;
    var minimumAmount = document.getElementById("minimumAmount").value;
    var startingDateValue = document.getElementById("dateStart").value;
    var endingDateValue = document.getElementById("dateEnd").value;
    var usesPerCoupon = document.getElementById("usesPerCoupon").value;
    var usesPerCustomer = document.getElementById("usesPerCustomer").value;
    
    // Check if any of the required fields are empty
    if (
        couponName === "" ||
        couponCode === "" ||
        couponType === "" ||
        couponAmount === "" ||
        minimumAmount === "" ||
        startingDateValue === "" ||
        endingDateValue === "" ||
        usesPerCoupon === "" ||
        usesPerCustomer === ""
    ) {
        alert("Please fill in all of the required fields.");
        return;
    }


    var anyCheckboxChecked = false;
    var checkboxes = document.querySelectorAll("#FMP, #FMS, #FPG, #RFS, #DIM, #GNP");
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            anyCheckboxChecked = true;
        }
    });
    if (!anyCheckboxChecked) {
        alert("Please select at least one store.");
        return; // Exit the function
    }


    var couponTypeElement = document.getElementById("couponType");
    var selectedOption = couponTypeElement.options[couponTypeElement.selectedIndex];
    var couponTypeText = selectedOption.innerText;
    
    // Format starting and ending dates
    formattedStartingDate = formatDate(startingDateValue, true).replace(/-/g, ''); // Remove dashes
    formattedEndingDate = formatDate(endingDateValue, true).replace(/-/g, ''); // Remove dashes
    var formattedStartingDateP = formatDate(startingDateValue, true);
    var formattedEndingDateP = formatDate(endingDateValue, true);
    console.log(formattedEndingDate);

    var requestData = {
        varCouponName: couponName,
        varCouponCode: couponCode,
        varCouponType: couponType,
        varCouponAmount: couponAmount,
        varMinimumAmount: minimumAmount,
        varDateStart: formattedStartingDate,
        varDateEnd: formattedEndingDate,
        varUsesPerCoupon: usesPerCoupon,
        varUsesPerCustomer: usesPerCustomer,
        varDIM: checkedValues.DIM,
        varFMP: checkedValues.FMP,
        varFMS: checkedValues.FMS,
        varFPG: checkedValues.FPG,
        varGNP: checkedValues.GNP,
        varRFS: checkedValues.RFS
    };

    var selectedStores = [];
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            selectedStores.push(checkbox.getAttribute("id"));
        }
    });
    var selectedStoresText = "stores: " + selectedStores.join(", ");



    if (confirm(
        "Are you sure that you want to create a coupon named " + couponName +
        " for a " + couponTypeText + " of " + couponAmount + " and with the coupon code " + couponCode +
        "? It will also have a starting date of " + formattedStartingDateP + ", an ending date of " + formattedEndingDateP +
        ", a minimum amount of " + minimumAmount + " until the coupon is activated, " +
        usesPerCoupon + " uses per coupon, and " + usesPerCustomer + " uses per customer " +
        "on " + selectedStoresText + "?"
    )) {
        setTimeout(function() {
            $.ajax({
                url: "createAdminCoupon.php",
                method: "POST",
                data: requestData,
                dataType: "json",
                success: function(data) {
                    if (data.valid) {
                        if (data.numCoupons !== null) {
                        if (data.numCoupons > 0) {
                            alert(data.numCoupons + " coupons created.");
                        }
                            else {
                                alert("Nice try dumbass. No coupons were created. Check if the coupon code already exists, maybe.")
                            }
                        } 
                    } else {
                        alert("Error creating coupon. Please try again.");
                    }
                },
                error: function(error) {
                    console.log("Error:", error);
                    alert("Error creating coupon. Please try again later.");
                }
            });
        }, 1000);
    }};