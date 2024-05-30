function onsubmitFunction() {
    var name = document.getElementById('name').value.trim();
    var username = document.getElementById('username').value.trim();
    var emailid = document.getElementById('emailid').value.trim();
    var password = document.getElementById('password').value.trim();
    var confirmPassword = document.getElementById('confirmPassword').value.trim();


    if (name.length == 0 || username.length == 0 || emailid.length == 0 || password.length == 0 || confirmPassword.length == 0) {
        alert('Please Fill out all Mandontary Fields');
        return false;
    } else if (password.length < 5) {
        alert('Please Enter Password more than 5 words');
        return false;
    } else if (confirmPassword != password) {
        alert('Password and Confirm Password Do not match');
        return false;
    } else {
        return true;
    }

}

function loginFunction() {
    var username = document.getElementById('username').value.trim();
    var password = document.getElementById('password').value.trim();

    if (username.length == 0 || password.length == 0) {
        alert('Please Fill out all Mandontary Fields');
        return false;
    } else {
        return true;
    }

}

function updateFunction() {
    var name = document.getElementById('name').value.trim();
    var emailid = document.getElementById('emailid').value.trim();

    if (name.length == 0 || emailid.length == 0) {
        alert('Please Fill out all Mandontary Fields');
        return false;
    } else {
        return true;
    }

}

function changePasswordFunction() {
    var oldPassword = document.getElementById('oldPassword').value.trim();
    var newPassword = document.getElementById('newPassword').value.trim();
    var confirmPassword = document.getElementById('confirmPassword').value.trim();


    if (oldPassword.length == 0 || newPassword.length == 0 || confirmPassword.length == 0) {
        alert('Please Fill out all Mandontary Fields');
        return false;
    } else if (newPassword.length < 5 || confirmPassword.length < 5) {
        alert('Please Enter Password more than 5 words');
        return false;
    } else if (newPassword != confirmPassword) {
        alert('Password and Confirm Password Do not match');
        return false;
    } else {
        return true;
    }
}

function addhammerFunction() {
    var hammerImage = document.getElementById('hammerImage').value.trim();
    var title = document.getElementById('title').value.trim();
    var description = document.getElementById('description').value.trim();
    var seeking = document.getElementById('seeking').value.trim();

    if (hammerImage.length == 0 || title.length == 0 || description.length == 0 || seeking.length == 0) {
        alert('Please Fill out all Mandontary Fields');
        return false;
    } else {
        return true;
    }
}

function addQuantity() {
    var el = document.querySelector("#quantityValue");
    el.value = ++el.value;
}

function removeQuantity() {
    var el = document.querySelector("#quantityValue");
    if (el.value > 1) {
        el.value = --el.value;
    }
}


function addUpdateQuantity(val) {
    let el = document.querySelector(`#${val}`);
    el.value = ++el.value;
}

function removeUpdateQuantity(val) {
    let el = document.querySelector(`#${val}`);
    if (el.value > 1) {
        el.value = --el.value;
    }
}

function deleteWatchRow(val) {
    let el = document.querySelector(`#${val}`);
    el.remove()
}