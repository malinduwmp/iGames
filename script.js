// adminveryfication send 
var av;
function adminVerification() {
    
    var email = document.getElementById("e");

    var f = new FormData();
    f.append("e", email.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText.trim();
            if (t == "Success") {
                var adminVerificationModal = document.getElementById("verificationModal");
                av = new bootstrap.Modal(adminVerificationModal);
                av.show();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "adminVerificationProcess.php", true);
    r.send(f);
}

// admin verify

function verify() {
    

    var verification = document.getElementById("vcode");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                av.hide();
                window.location = "adminPanel.php";
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "verificationProcess.php?v=" + verification.value, true);
    r.send();
}
// change product image
function changeProductImage() {
    var images = document.getElementById("imageuploader");

    images.onchange = function () {
        var file_count = images.files.length;

        if (file_count <= 3) {
            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("i" + x).src = url;
            }
        } else {
            alert(file_count + " files uploaded. You can upload 03 or less than 03 files.");
        }
    }
}

// add product
function addProduct() {
    var category = document.getElementById("category");
    var age_limit = document.getElementById("age_limit");
    var title = document.getElementById("title");
    var cost = document.getElementById("cost");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");
    var fileUploader = document.getElementById("fileUploader");

    if (!category || !age_limit || !title || !cost || !desc || !image || !fileUploader) {
        alert("Please fill all fields.");
        return;
    }

    var f = new FormData();
    f.append("ca", category.value);
    f.append("b", age_limit.value);
    f.append("t", title.value);
    f.append("cost", cost.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("img" + x, image.files[x]);
    }

    // Validate and append the game file
    if (fileUploader.files.length > 0) {
        var gameFile = fileUploader.files[0];
        var allowedExtensions = /(\.zip)$/i;

        if (!allowedExtensions.exec(gameFile.name)) {
            alert('Invalid file type. Only zip files are allowed.');
            return;
        } else {
            f.append("gameFile", gameFile);
        }
    } else {
        alert('Please select a game file.');
        return;
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                alert("Game added successfully");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "addGameProcess.php", true);
    r.send(f);
}

//send id 
function sendId(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.open("updateGame.php", "_blank");
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "sendIdProcess.php?id=" + id, true);
    r.send();

}

//update Product 
function updateProduct() {
    var product_id = document.getElementById("product_id");
    var title = document.getElementById("title");
    var cost = document.getElementById("cost");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");
    var fileUploader = document.getElementById("fileUploader");

    // if (!product_id || !title || !cost || !desc) {
    //     alert("Please fill all fields.");
    //     return;
    // }

    var f = new FormData();
    f.append("id", product_id.value);
    f.append("t", title.value);
    f.append("cost", cost.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;
    if (file_count > 0) {
        for (var x = 0; x < file_count; x++) {
            f.append("img" + x, image.files[x]);
        }
    }

    if (fileUploader.files.length > 0) {
        var gameFile = fileUploader.files[0];
        var allowedExtensions = /(\.zip)$/i;

        if (!allowedExtensions.exec(gameFile.name)) {
            alert('Invalid file type. Only zip files are allowed.');
            return;
        } else {
            f.append("gameFile", gameFile);
        }
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                alert("Game updated successfully");
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "updateGameProcess.php", true);
    r.send(f);
}




//bock Games 

function blockProduct(id) {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "blocked") {
                document.getElementById("pb" + id).innerHTML = ".";
                document.getElementById("pb" + id).classList = "btn btn-danger";
                window.location.reload();

            } else if (txt == "unblocked") {
                document.getElementById("pb" + id).innerHTML = ".";
                document.getElementById("pb" + id).classList = "btn btn-success";
                window.location.reload();

            } else {
                alert(txt);
            }
        }
    }

    request.open("GET", "gamesBlockProcess.php?id=" + id, true);
    request.send();

}
//product model
var pm;
function viewProductModal(id) {
    var m = document.getElementById("viewProductModal" + id);
    if (m) {
        pm = new bootstrap.Modal(m);
        pm.show();
    } else {
        console.error("Modal with ID viewProductModal" + id + " not found.");
    }
}



// Add game category model
var cm;
function addNewCategory() {
    var m = document.getElementById("addCategoryModal");
    cm = new bootstrap.Modal(m);
    cm.show();
}

// Add Age Limit model 
var tm;
function addAgeLimit() {
    var m = document.getElementById("addAgeLimitModel");
    tm = new bootstrap.Modal(m);
    tm.show();
}

// add category verification
var vc;
var e;
var n;
function verifyCategory() {

    var ncm = document.getElementById("addCategoryVerificationModal");
    vc = new bootstrap.Modal(ncm);

    e = document.getElementById("e").value;
    n = document.getElementById("n").value;

    var f = new FormData();
    f.append("email", e);
    f.append("name", n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                cm.hide();
                vc.show();
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "addNewCategoryProcess.php", true);
    r.send(f);
}


// add age_limit verifycation

var tvc;
var type_email;
var type_id;
var type_name;
function verifyAge() {
    var tncm = document.getElementById("addTypeVerificationModal");
    tvc = new bootstrap.Modal(tncm);

    type_email = document.getElementById("admin_email_t").value;
    type_name = document.getElementById("type_name").value;
    type_name = document.getElementById("type_id").value;


    var f = new FormData();
    f.append("email", type_email);
    f.append("limit", type_name);
    f.append("name", type_id);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "Success") {
                tm.hide();
                tvc.show();
            } else {
                alert(t);
            }
        }
    }
    r.open("POST", "addNewAgeLimitProcess.php", true);
    r.send(f);
}

//remove frome category list 

function removeCategory(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "deleted") {
                alert(t);
                window.location.reload();
                
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "removeCategoryProcess.php?id=" + id, true);
    r.send();
}


// remove from age limit 

function removeAgeLimit(age_id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "deleted") {
                alert (t)
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "removeAgelimitProcess.php?age_id=" + age_id, true);
    r.send();
}

//add category 

function saveCategory() {
    var txt = document.getElementById("txt").value;

    var f = new FormData();
    f.append("t", txt);
    f.append("e", e);
    f.append("n", n);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                vc.hide();
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "SaveCategoryProcess.php", true);
    r.send(f);
}


//add age limit 
function saveAge() {
    var txt = document.getElementById("v_code").value;

    var f = new FormData();
    f.append("t", txt);
    f.append("e", type_email);
    f.append("a",type_id )
    f.append("n", type_name);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                tvc.hide();
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "SaveAgeLimitProcess.php", true);
    r.send(f);
}




//Slider 
const slider = document.querySelector('.slider');

function activate(e) {
    const items = document.querySelectorAll('.item');
    e.target.matches('.next') && slider.append(items[0])
    e.target.matches('.prev') && slider.prepend(items[items.length - 1]);
}

document.addEventListener('click', activate, false);

function download() {
    print()
}


// printInvoice
function printInvoice1() {
    window.open('Gamereport.php', '_blank');
}

// change view userSingnin…

function changeView() {
    var signInBox = document.getElementById("signInBox");
    var signUpBox = document.getElementById("signUpBox");

    signInBox.classList.toggle("d-none");
    signUpBox.classList.toggle("d-none");
}


//show password 
function togglePasswordVisibility(passwordFieldId, iconId) {
    var passwordField = document.getElementById(passwordFieldId);
    var icon = document.getElementById(iconId);
    
    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

//signupProcess
function signUp() {
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var username = document.getElementById("username");
    var email = document.getElementById("email");
    var password = document.getElementById("signUpPassword");
    var gender = document.getElementById("gender");
    var dob = document.getElementById("dob");

    var dobValue = new Date(dob.value);
    var today = new Date();

    // Check if DOB is in the future
    if (dobValue > today) {
        document.getElementById("msg").innerHTML = "Date of birth cannot be in the future.";
        document.getElementById("msgdiv").className = "d-block text-white";
        return;
    }

    var form = new FormData();

    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("username", username.value);
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("gender", gender.value);
    form.append("dob", dob.value);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var text = request.responseText.trim();

            if (text === "success") {
                alert("Registration Successful");
                window.location.reload();
            } else {
                document.getElementById("msg").innerHTML = text;
                document.getElementById("msgdiv").className = "d-block text-white";
            }
        }
    };

    request.open("POST", "userSignUpProcess.php", true);
    request.send(form);
}




// singnin Process
function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");

    var f = new FormData();
    f.append("email", email.value);
    f.append("password", password.value);
    f.append("rememberme", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText.trim();
            if (t == "success") {
                window.location = "index.php";
            } else {
                document.getElementById("msg2").innerHTML = t;
            }
        }
    };

    r.open("POST", "userSignInProcess.php", true);
    r.send(f);
}



// // alert
// function showAlert(type, message) {
//     const msgDiv = document.getElementById("msgdiv");
//     const alertDiv = document.getElementById("alertdiv");
//     const msg = document.getElementById("msg");
//     alertDiv.classList.remove("alert-success", "alert-danger");
//     msg.classList.remove("text-success", "text-danger");

//     if (type === "success") {
//         alertDiv.classList.add("alert-success");
//         msg.classList.add("text-success");
//     } else {
//         alertDiv.classList.add("alert-danger");
//         msg.classList.add("text-danger");
//     }
    
//     msgDiv.classList.remove("d-none");
//     msg.textContent = message;
// }


// froget password
var model;

function forgotPassword() {
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText.trim();
            if (t == "success") {
                alert("Verification code has been sent to your email. Please check your inbox");
                var m = document.getElementById("forgotPasswordModal");
                var modal = new bootstrap.Modal(m); // Correct initialization for Bootstrap 5
                modal.show(); // Show the modal
            } else {
                alert(t);
            }
        }
    };

    r.open("GET", "forgotPasswordProcess.php?e=" + encodeURIComponent(email.value), true);
    r.send();
}

// reset password
function resetpw() {
    var vcode = document.getElementById("vc");
    var np = document.getElementById("npi");
    var rnp = document.getElementById("rnp");
    var email = document.getElementById("email2");

    var f = new FormData();
    f.append("e", email.value);
    f.append("v", vcode.value);
    f.append("n", np.value);
    f.append("r", rnp.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText.trim();
            if (text == "success") {
                alert("Password reset success");
                model.hide(); // Hide the modal after success
            } else {
                alert(text);
            }
        }
    };

    r.open("POST", "resetPassword.php", true);
    r.send(f);
}


//change image view 
function previewProfileImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('profileImgPreview');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}


//update user profile
function updateProfile(){

    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var username = document.getElementById("username");
    var dob = document.getElementById("dob");

    var form = new FormData();
    form.append("fname", fname.value);
    form.append("lname", lname.value);
    form.append("username", username.value);
    form.append("dob", dob.value);
    

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText.trim();
            if (t == "success") {
                window.location.reload();
                alert("Sucsessfully Updated Your Profile")
            } else {
                alert(t);
            }
        }
    };


    r.open("POST", "updateProfileProcess.php", true);
    r.send(form);

}

// user profile image fileUploader
function uploadImg() {
    var img = document.getElementById("imgUploader");

    var f = new FormData();
    f.append("i", img.files[0]);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText.trim();

            if (response == "empty") {
                alert("Please select your profile image.");
            } else if (response == "File type is not allowed.") {
                alert(response);
            } else if (response == "Failed to move the uploaded file.") {
                alert(response);
                
            } else {
                document.getElementById("i").src = response;
                img.value = "";
                window.location.reload();
            }
        }
    };

    request.open("POST", "userProfileImgUpload.php", true);
    request.send(f);
}

// signout 
function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText.trim();

            if (t == "success") {

                window.location = "index.php";

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "signoutProcess.php", true);
    r.send();

}


// // product loading 
// function loadProduct(page) {
//     var f = new FormData();
//     f.append("p", page);

//     var request = new XMLHttpRequest();
//     request.onreadystatechange = function () {
//         if (request.readyState == 4 && request.status == 200) {
//             document.getElementById("pid").innerHTML = request.responseText;
//         }
//     };

//     request.open("POST", "loadGames.php", true);
//     request.send(f);
// }

// scroll to product

// function scrollTogame() {
//     document.getElementById('product-sectionq').scrollIntoView({ behavior: 'smooth' });
// }

function scrollTogame() {
    const productSection = document.getElementById('prsectionq');
    if (productSection) {
        productSection.scrollIntoView({ behavior: 'smooth' });
    } else {
        console.error('Element with ID "product-section" not found.');
    }
}


function scrollToTop(){

    const productSection = document.getElementById('home-section');
    if (productSection) {
        productSection.scrollIntoView({ behavior: 'smooth' });
    } else {
        console.error('Element with ID "product-section" not found.');
    }
}

function basicSearch(event, page) {
    event.preventDefault(); // Prevent the form from submitting and reloading the page

    var text = document.getElementById("kw").value;

    var f = new FormData();
    f.append("t", text);
    f.append("page", page);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText.trim();
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}


// add to watchlis 
function addToWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText.trim();
            if (t == "Added") {
                alert("Game added to the watchlist");
                window.location.reload();
            } else if (t == "Removed") {
                alert("Game removed from watchlist");
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "addWatchListProcess.php?id=" + id, true);
    r.send();

}
// removeFrom watchlist

function removeFromWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText.trim();
            if (t == "Deleted") {
                alert("This product remove form watchlist ")
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "removeFromWatchListProcess.php?id=" + id, true);
    r.send();
}

// toogle hart : 

function toggleHeart(button) {
    button.classList.toggle('animated');
    
    // Optionally, you can also toggle the heart icon itself
    const icon = button.querySelector('i');
    if (icon.classList.contains('fas')) {
        icon.classList.remove('fas');
        icon.classList.add('far');
    } else {
        icon.classList.remove('far');
        icon.classList.add('fas');
    }
}


//add to watchlist 

function addToCart(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText.trim();
        }
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText.trim();
            if (t == "New Game added to the Cart") {
                alert(t);
                window.location.reload();
            } else if (t == "AA") {
                alert("This Game Already added to cart");
                window.location.reload();
            } else if (t == "This game is over your age limit") {
                alert(t);
            } else {
                alert("This Game Already added to cart");
            }
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}


//remove cart

function removeFromCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText.trim();
            if (t == "deleted") {
                alert("This product remove form Cart")
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromCartProcess.php?id=" + id, true);
    r.send();

}


/* <advancedSearch */
function advancedSearch(page) {
    var t = document.getElementById("t").value;
    var cat = document.getElementById("c1").value;
    var b = document.getElementById("b1").value;
    var pf = document.getElementById("pf").value;
    var pt = document.getElementById("pt").value;
    var s = document.getElementById("s").value;

    var form = new FormData();
    form.append("t", t);
    form.append("cat", cat);
    form.append("b", b);
    form.append("pf", pf);
    form.append("pt", pt);
    form.append("s", s);
    form.append("page", page);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "advancedSearchProcess.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("view_area").innerHTML = xhr.responseText;
        }
    };
    xhr.send(form);
}

// paynow

function paynow(pid) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            if (obj.error) {
                alert(obj.error);
                window.location = "index.php";
                return;
            }

            var umail = obj["umail"];
            var amount = obj["amount"];

            payhere.onCompleted = function onCompleted(orderId) {
                console.log("Payment completed. OrderID:" + orderId);
                //alert("Payment completed. OrderID:" + orderId);
                saveInvoice(orderId, pid, umail, amount);            };

            payhere.onDismissed = function onDismissed() {
                console.log("Payment dismissed");
            };

            payhere.onError = function onError(error) {
                console.log("Error:" + error);
            };

            var payment = {
                "sandbox": true,
                "merchant_id": "1227443",
                "return_url": "http://localhost/iGames/singleProductView.php?id=" + pid,
                "cancel_url": "http://localhost/iGanes/singleProductView.php?id=" + pid,
                "notify_url": "http://sample.com/notify",
                "order_id": obj["id"],
                "items": obj["item"],
                "amount": amount,
                "currency": obj["currency"],
                "hash": obj["hash"],
                "first_name": obj["fname"],
                "last_name": obj["lname"],
                "email": umail,
                "phone": obj["mobile"],
                "address": obj["address"], // Keep it empty
                "city": obj["city"], // Keep it empty
                "country": "Sri Lanka",
                "delivery_address": obj["address"], // Keep it empty
                "delivery_city": obj["city"], // Keep it empty
                "delivery_country": "Sri Lanka",
                "custom_1": "",
                "custom_2": ""
            };

            payhere.startPayment(payment);
        }
    }

    r.open("GET", "payNowProcess.php?id=" + pid, true);
    r.send();
}

// saveInvoice 
function saveInvoice(orderId, pid, umail, amount) {
    var f = new FormData();
    f.append("o", orderId);
    f.append("i", pid);
    f.append("m", umail);
    f.append("a", amount);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                window.location = "invoice.php?id=" + orderId;    
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveInvoiceProcess.php", true);
    r.send(f);
}

var m;
function addFeedback(id) {
    
    var feedbackModal = document.getElementById("feedbackModal" + id);
    m = new bootstrap.Modal(feedbackModal);
    m.show();
}


// adminveryfication send 

//bock users

function blockUser(email) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText.trim();
            if (txt == "blocked") {
                document.getElementById("ub" + email).innerHTML = ".";
                document.getElementById("ub" + email).classList = "btn btn-danger";
            } else if (txt == "unblocked") {
                document.getElementById("ub" + email).innerHTML = ".";
                document.getElementById("ub" + email).classList = "btn btn-success";
            } else {
                alert(txt);
            }
        }
    }

    r.open("GET", "userBlockProcess.php?email=" + email, true);
    r.send();

}

// admin signout

function signoutA() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText.trim();

            if (t == "success") {

                window.location.adminSignIn.php();

            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "signoutProcessA.php", true);
    r.send();

}


// cheuout
