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


function changeButtonStatus(test) {
    const buttonForPassword = document.getElementById("passwordSubmitButton"); 
    if (test === 0) {
        buttonForPassword.disabled = true;
    }
    else {
        buttonForPassword.disabled = false;
    }
     
    
    
};


function changeSubmitButtonStatus(param) {
    const confirmButton = document.getElementById("createCouponB");
    if (param === 0) {
        confirmButton.disabled = true;
    }
    else {
        confirmButton.disabled = false;
    }
};

$(document).ready(function() {
    $('#releaseList').selectize( {
        create: false,
        diacritics: false,
        onFocus: function() {     
            this.clear( false );  
                            }                        
        })
    });


//$(document).ready(function() {
//    $('#store').selectize();
//});

$(document).ready(function() {
    $('#setQuantity').selectize();
});


function goToHomePage() {
    let confirmation1 = confirm("Are you sure you want to go to the home page?");
    if (confirmation1) {
        window.location.replace("../../index.php");
    }
}



function confirmRelease() {
    var selectedValueForRelease = document.getElementById("releaseList").value;
//  var selectedStore = document.getElementById("store").value;
    var selectedQuantity = document.getElementById("setQuantity").value;
    console.log(selectedValueForRelease);
    console.log(selectedStoreJS);
    console.log(selectedQuantity);
    console.log(agentIDforRelease);
    
   // if (selectedStore == 0) {
   //     alert("You forgot to select a store.");
    if (selectedValueForRelease == 0) {
        alert("You forgot to select a product.");
    } else if (selectedQuantity == 0) {
        alert("You forgot to select a quantity.");
    } else {
        var confirmation = confirm("Are you sure that you want to release a quantity of " + selectedQuantity + "x " + selectedValueForRelease + " on " + selectedStoreJS + "?");
        
        if (confirmation) {
            $.ajax({
                url: "releaseSelectedProduct.php",
                method: "POST",
                data: { agent: agentIDforRelease, store: selectedStoreJS, product: selectedValueForRelease, quantity: selectedQuantity },
                success: function (response) {
                    var amountReleased = response.message; 
                    if (response.success) {
                        console.log(response);
                        alert("You have released " + amountReleased + "x " + selectedValueForRelease + "'s on " + selectedStoreJS);
                    }
                    else {
                        console.error("Server error: " + response.message);
                        alert("An error occurred while processing your request. Please try again later.");
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error: " + error);
                    alert("An error occurred while communicating with the server. Please try again later.");
                }
            });
        }
    }
}




/*
if (response.success) {
    var amountReleased = response.message; 
    window.location.href = "couponPage.html?code=" + couponCode;
} else {
    handleError("Error creating coupon. Server response: " + response.message);
    changeSubmitButtonStatus(1);
}


function pullCurrentCoupons() {

    let noCouponsParagraph = document.getElementById("noCouponsCreated");
    var existingCouponsTable = document.getElementById("couponsTable");

    $.ajax({
        url: "pullCurrentCoupons.php",
        method: "POST",
        data: { agent: agentID3 },
        success: function(response) {
            console.log("Server Response:", response);
            
            if (response.success && response.coupons.length > 0) {
                populateTable(response.coupons);
            }
            else {
                existingCouponsTable.hidden = true;
                noCouponsParagraph.hidden = false;
                handleError("No coupons available.");
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            handleError("Error pulling table. AJAX error: " + errorThrown);
        }
    });
};




function hideNoCouponsParagraph() {
    let noCouponsParagraph = document.getElementById("noCouponsCreated");
    noCouponsParagraph.hidden = true;
};

hideNoCouponsParagraph();

function populateTable(coupons) {
    var tableBody = $("#couponsTable tbody");
    tableBody.empty();

    coupons.forEach(function(coupon) {
        var row = $("<tr>");
        row.append($("<td>").text(coupon.store));
        row.append($("<td>").text(coupon.code));
        row.append($("<td>").text(coupon.discount));
        row.append($("<td>").text(coupon.date_added));
        row.append($("<td>").text(coupon.order_id));
        tableBody.append(row);
        
    
    });
    setTimeout(() => {
        replaceZeroWithMessage();
    }, "500");
    };


function replaceZeroWithMessage() {
    var cTable = document.getElementById("couponsTable");
    var cells = cTable.getElementsByTagName("td");

    for (var i = 0; i < cells.length; i++) {
        if (cells[i].textContent === "0") {
            cells[i].textContent = "No order placed";
        }
    }
}*/

function handleError(errorMessage) {
    console.error(errorMessage);
};



