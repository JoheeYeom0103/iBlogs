document.addEventListener('DOMContentLoaded', function() {
    const inputs = [
        document.querySelector('.username-input'),
        document.querySelector('.password-input'),
        document.querySelector('.confirm-password-input'),
        document.querySelector('.firstname-input'),
        document.querySelector('.lastname-input'),
        document.querySelector('.email-input'),
        document.querySelector('.terms-checkbox')
    ];

    // Add input event listener for each field in the inputs array
    inputs.forEach(input => {
        input.addEventListener('input', function(){
            if(this.value.trim() !== ''){
                this.style.backgroundColor = '#ffffff';
            }
        });
    });

    //get the signup form element
    const signUpForm = document.getElementById('signUpForm');
    signUpForm.addEventListener('submit', function(event){

        // check for empty inputs also initialize an error counter so that 
        //we can make sure only one error message is displayed at a time
        let errorCount = 0;
        inputs.forEach(input => {
            if (input.value.trim() === '') {
                errorCount++;
                input.style.backgroundColor = '#F9EDE2';
            }
        });

        // displays an error message as a browser alert when there is exactly one error
        if (errorCount === 1) {
            alert("Please correct the highlighted field!");
            event.preventDefault();
            return;
        } else if (errorCount > 1) {
            alert("Please correct the highlighted fields!");
            event.preventDefault();
            return;
        }

        // retrieve values that need additional validation
        const email = inputs[5].value.trim();
        const password = inputs[1].value.trim();
        const confirmPass = inputs[2].value.trim();
        const username = inputs[0].value.trim();

        // make sure username is between 4 and 16 chars
        if(username.length < 4 || username.length > 16){
            alert("Username must be between 4 and 16 characters!");
            inputs[0].style.backgroundColor = "#F9EDE2";
            event.preventDefault();
            return;
        }

        // make sure both password inputs match
        if (confirmPass !== password) {
            alert("Passwords do not match!");
            inputs[2].style.backgroundColor = "#F9EDE2";
            event.preventDefault();
            return;
        }

        // make sure password is between 12 and 14 chars
        if(password.length < 12 || password.length > 14){
            alert("Password must be between 12 and 14 characters!");
            inputs[1].style.backgroundColor = "#F9EDE2";
            event.preventDefault();
            return;
        }
        
        // make sure email is in a valid form
        if (email === '' || !validateEmail(email)) {
            alert("Invalid email address!");
            inputs[5].style.backgroundColor = "#F9EDE2";
            event.preventDefault();
            return;
        }
    });
});

function validateEmail(email){
    //creates pattern: something@something.something
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}
