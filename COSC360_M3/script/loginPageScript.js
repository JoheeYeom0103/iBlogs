document.addEventListener('DOMContentLoaded', function() {
    const usernameInput = document.querySelector('.username-input');
    const passwordInput = document.querySelector('.password-input');

    // Add input event listener for username
    usernameInput.addEventListener('input', function(){
        if(this.value.trim() !== ''){
            this.style.backgroundColor = "#FFFFFF";
        }
    });

    // Add input event listener for password
    passwordInput.addEventListener('input', function(){
        if(this.value.trim() !== ''){
            this.style.backgroundColor = "#FFFFFF";
        }
    });

    //get the login form element
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function(event){

        const username = usernameInput.value.trim();
        const pass = passwordInput.value.trim();

        if(username === '' || pass === ''){
            alert("Please fill in highlighted fields!");
            event.preventDefault();
            if (username === '') {
                //when username is empty, make the background pink
                usernameInput.style.backgroundColor = "#F9EDE2";
            }
            if (pass === '') {
                //when password is empty, make the background pink
                passwordInput.style.backgroundColor = "#F9EDE2";
            }
        }
    });
});
