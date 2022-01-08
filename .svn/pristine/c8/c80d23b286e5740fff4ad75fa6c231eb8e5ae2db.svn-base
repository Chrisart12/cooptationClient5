document.addEventListener('DOMContentLoaded', () => {

    fa_eye_slash = document.getElementById("fa_eye_slash");
    fa_eye = document.getElementById("fa_eye");
    displayPassword = document.querySelector(".displayPassword");
    console.log("kfkfkkfl", displayPassword)
    if(displayPassword) {
        fa_eye.addEventListener("click", function() {
            if(displayPassword.type === 'password') {
                fa_eye.classList.remove("fa-eye")
                fa_eye.classList.add("fa-eye-slash")
                displayPassword.type = "text";
                // fa_eye.style.display = "none";
                // fa_eye_slash.style.display = "block";
            } else if (displayPassword.type === 'text'){
                fa_eye.classList.remove("fa-eye-slash")
                fa_eye.classList.add("fa-eye")
                displayPassword.type = "password";
            }
        })
    }
   
})