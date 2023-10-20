var storedLimit;       
var hasAvailable;
var hasUsed;

// hide elements before the password is entered
function hideBeforePassword() {
    var elementsToHide = document.getElementsByClassName("hideBeforePW");
    
    for (var i = 0; i < elementsToHide.length; i++) {
        elementsToHide[i].style.display = 'none';
    }
}


function reselectStore() {
    var reshowStoresSelection = document.getElementById("storeSelectionDiv");
    reshowStoresSelection.style.display = 'block';
    hideBeforeStore();
}


function getStoreValue() {
    let selectedStoreVar = document.getElementById("storeSelection").value;
    console.log(selectedStoreVar);
}


function getStore() {
    let selectedStoreVarPHP = document.getElementById("storeSelection").value;
    console.log(selectedStoreVarPHP);
    if (selectedStoreVarPHP == '0') 
    {
        alert("Try selecting a store.")  
    }
        else if (selectedStoreVarPHP != '0')  {
    $.ajax({
        url: './php/session/store_in_session.php',
        type: 'POST',
        data: { storeSelected: true, selectedStoreVarPHP: selectedStoreVarPHP },
        success: function(response) {
            console.log(response);
            hideElements();
            let addStoreText = document.getElementById("appendStore");
            addStoreText.innerHTML = selectedStoreVarPHP;
            if (selectedStoreVarPHP == 'DIM') {
                addStoreText.className = "dimText";
            }
            else if (selectedStoreVarPHP == 'FPG') {
                addStoreText.className = "fpgText";
            }
            else if (selectedStoreVarPHP == 'FMS') {
                addStoreText.className = "fmpfmsText";
            }
            else if (selectedStoreVarPHP == 'FMP') {
                addStoreText.className = "fmpfmsText";
            }
            else if (selectedStoreVarPHP == 'GNP') {
                addStoreText.className = "gnpText";
            }
            else if (selectedStoreVarPHP == 'RFS') {
                addStoreText.className = "rfsText";
            }
            
            showAfterStore();
        },
        error: function() {
            console.error('Error sending store selection.');
        }
    })}
};

    function hideElements() {
        var selectElement = document.getElementById("storeSelectionDiv");
        selectElement.style.display = 'none';
    }

hideBeforeStore();


function hideBeforeStore() {
    var selectWhatToDoDiv = document.getElementById("showAfterStoreSelected");
    selectWhatToDoDiv.style.display = 'none';
}


function showAfterStore() {
    var selectWhatToDoDiv = document.getElementById("showAfterStoreSelected");
    selectWhatToDoDiv.style.display = 'block';
}



hideBeforePassword();

  // promise for password re-pulling
function fetchData() {
    return new Promise((resolve, reject) => {
        var enteredPassword = document.getElementById("passwordInput").value;
        var enteredUsername = document.getElementById("A").value;

        $.ajax({
            url: "./php/session/checkPassword.php",
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


// check if password is correct
function checkPassword() {
 changeButtonStatus(0);
     var agent = document.getElementById("A").value;
    fetchData()
        .then(data => {
            if (data.valid) {
                const storedLimitStr = data.limit.toString();
                const hasAvailableStr = data.available.toString();
                const hasUsedStr = data.used.toString();
    
       
                localStorage.setItem("storedLimit", storedLimitStr);
                localStorage.setItem("hasAvailable", hasAvailableStr);
                localStorage.setItem("hasUsed", hasUsedStr);
    
            
                storedLimit = data.limit;
                hasAvailable = data.available;
                hasUsed = data.used;
            //      pullCurrentCoupons();

                var elementsToUnhide = document.getElementsByClassName("hideBeforePW");
                for (var i = 0; i < elementsToUnhide.length; i++) {
                    elementsToUnhide[i].style.display = '';
                }
            //      updateAvailableAmountDisplay(hasAvailable);
            //      updateAmountUsedDisplay(hasUsed);
                
                $("#passwordInput").hide();
                $("#passwordSubmitButton").hide();
                $("#hidemeAfter").hide();
                
     
                $.ajax({
                    url: './php/session/logged_in_status.php',
                    type: 'POST',
                    data: { logged_in: true , agentID: agent},
                    success: function(response) {
                      
                        console.log(response);
                    },
                    error: function () {
                  
                        console.error('Error sending login status.');
                    }
                });
            } else {
                alert("Incorrect username or password. Please try again.");
              changeButtonStatus(1);
                
          
                $.ajax({
                    url: './php/session/logged_in_status.php',
                    type: 'POST',
                    data: { logged_in: false },
                    success: function(response) {
                   
                        console.log(response);
                    },
                    error: function () {
                    
                        console.error('Error sending login status.');
                    }
                });
            }
        })
        .catch(error => {
            console.log("Error:", error);
            alert("Error checking password. Please try again later.");
            changeButtonStatus(1);
            

            $.ajax({
                url: './php/session/logged_in_status.php',
                type: 'POST',
                data: { logged_in: false },
                success: function(response) {
             
                    console.log(response);
                },
                error: function () {
             
                    console.error('Error sending login status.');
                }
            });
        });
}


var pwBox = document.getElementById("passwordInput");

pwBox.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("passwordSubmitButton").click();
    }
});


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