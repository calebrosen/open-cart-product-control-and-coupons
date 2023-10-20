
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

window.addEventListener("load", function() {
    let navigationType = window.performance.getEntriesByType("navigation")[0].type;

    if (navigationType === "reload" || navigationType === "back_forward") {
        window.location.href = '../../index.php';
    }
});


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

const storedLimitStr = localStorage.getItem("storedLimit");
const hasAvailableStr = localStorage.getItem("hasAvailable");
const hasUsedStr = localStorage.getItem("hasUsed");


const storedLimit = parseInt(storedLimitStr, 10); 
const hasAvailable = parseFloat(hasAvailableStr); 
const hasUsed = parseFloat(hasUsedStr);


console.log("Stored Limit:", storedLimit);
console.log("Has Available:", hasAvailable);
console.log("Has Used:", hasUsed);




let hasAvailableAmount = parseFloat(localStorage.getItem("hasAvailable"));
updateAvailableAmountDisplay(hasAvailableAmount);
 updateAmountUsedDisplay(hasUsed);

// Function to update the amountUsed element
function updateAmountUsedDisplay(hasUsed) {
    var amountUsedElement = document.getElementById("amountUsed");
    amountUsedElement.textContent = parseFloat(hasUsed).toFixed(0); 
};

// Function to update the availableAmount element
function updateAvailableAmountDisplay(hasAvailable) {
    var availableAmountElement = document.getElementById("availableAmount");
    availableAmountElement.textContent = parseFloat(hasAvailable).toFixed(0);
};



function confirmCreate() {
    // checkPassword();

    changeSubmitButtonStatus(0);
  //  var store = document.getElementById("store").value;
    var createCouponButton = document.getElementById("createCouponB");
    var storeText = $("#store option:selected").text();
    var couponAmount = parseFloat($("#couponAmount").text().replace("$", ""));
    var couponAmountSpan = document.getElementById("couponAmount");
    var couponAmountText = couponAmountSpan.textContent.trim();
    var couponAmountValue = parseFloat(couponAmountText.replace("$", ""));

    console.log("Agent:", agentID3);
    console.log("Coupon Amount:", couponAmount);
    console.log("hasAvailable:", hasAvailable);
    console.log("Store:", selectedStoreJS);

    if (hasAvailable < couponAmount) {
        alert("Nice try. You can't create a coupon for $" + couponAmount + " when you have a balance of $" + hasAvailable);
        changeSubmitButtonStatus(1);
  //  } else if (parseInt(store) === 0) {
  //     alert("You didn't even select a store!");
  //     changeSubmitButtonStatus(1);
    } else if (couponAmountValue === 0) {
        alert("You can't create a coupon for $0. Maybe next time.");
        changeSubmitButtonStatus(1);
    } else {
        if (confirm("Are you sure you want to create this coupon for $" + couponAmount + " on " + selectedStoreJS + "?")) {
            $.ajax({
                url: "./createCoupon.php",
                method: "POST",
                data: { agent: agentID3, store: selectedStoreJS, couponAmount: couponAmount },
                success: function(response) {
                    console.log("Server Response:", response);
                    if (response.success) {
                        var couponCode = response.message; 
                        window.location.href = "couponPage.html?code=" + couponCode;
                    } else {
                        handleError("Error creating coupon. Server response: " + response.message);
                        changeSubmitButtonStatus(1);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    handleError("Error creating coupon. AJAX error: " + errorThrown);
                    changeSubmitButtonStatus(1);
                }
            });
        } else {
            // user cancelled the confirmation
            changeSubmitButtonStatus(1);
        }
    }
}


   pullCurrentCoupons();

function handleError(errorMessage) {
    console.log(errorMessage);
    alert("An error occurred. Please try again or contact support.");
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
}

function handleError(errorMessage) {
    console.error(errorMessage);
};

$(document).ready(function() {
    const rows = $("tbody tr");

    function updateCouponAmount() {
        let totalCouponAmount = 0;

        rows.each(function() {
            const amountCell = $(this).find("td:first-child");
            const quantityCell = $(this).find("td:nth-child(2)");

            const amountValue = parseFloat(amountCell.text().replace("$", ""));
            const quantityValue = parseInt(quantityCell.text());

            if (!isNaN(amountValue) && !isNaN(quantityValue)) {
                const couponAmountForRow = amountValue * quantityValue;
                totalCouponAmount += couponAmountForRow;
            }
        });

        const couponAmountElement = $("#couponAmount");
        couponAmountElement.text(totalCouponAmount.toFixed(0)); // change decimal places
    }

    $(".increment-button").on("click", function() {
        const value = parseFloat($(this).data("value"));
        const quantityCell = $(this).closest("tr").find("td:nth-child(2)");

        let quantity = parseInt(quantityCell.text());
        quantity += 1;
        quantityCell.text(quantity);

        updateCouponAmount();
    });

    $(".decrement-button").on("click", function() {
        const value = parseFloat($(this).data("value"));
        const quantityCell = $(this).closest("tr").find("td:nth-child(2)");

        let quantity = parseInt(quantityCell.text());
        if (quantity > 0) {
            quantity -= 1;
            quantityCell.text(quantity);

            updateCouponAmount();
        }
    });

    updateCouponAmount();
});