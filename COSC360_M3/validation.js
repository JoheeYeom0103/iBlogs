/* Form Validation */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('profile-form');
    const requiredFields = form.querySelectorAll('.required');
    const userIdField = document.getElementById('userId');
    const passwordField = document.getElementById('password');
    const passwordConfirmationField = document.getElementById('passwordConfirmation');
    const emailField = document.getElementById('email');

    // check if every field is completed
    function completeCheck() {
        let isComplete = true;

        requiredFields.forEach(function(field) {
            if (field.value.trim() === '') {
                field.classList.add('highlight');
                isComplete = false;
            } else {
                field.classList.remove('highlight');
            }
        });

        return isComplete;
    }

    // check if every field is valid
    function validityCheck() {
        let isValid = true;

        // check if userid is valid (4~16characters)
        if (userIdField.value.length < 4 || userIdField.value.length > 16) {
            isValid = false;
            userIdField.classList.add('highlight');
        } else {
            userIdField.classList.remove('highlight');
        }

        // check if password is valid (12~14characters)
        if (passwordField.value.length < 12 || passwordField.value.length > 14) {
            isValid = false;
            passwordField.classList.add('highlight');
        } else {
            passwordField.classList.remove('highlight');
        }

        // check if password confirmation is valid (matches to the password) 
        if (passwordConfirmationField.value !== passwordField.value) {
            isValid = false;
            passwordConfirmationField.classList.add('highlight');
        } else {
            passwordConfirmationField.classList.remove('highlight');
        }

        if (emailField.value.indexOf('@') === -1) {
            isValid = false;
            emailField.classList.add('highlight');
        } else {
            emailField.classList.remove('highlight');
        }

        return isValid;
    }

    form.addEventListener('submit', function(e) {
        // if any of the field is either incomplete or invalid
        if (!completeCheck() || !validityCheck()) {
            // prevent submission
            e.preventDefault();
            // send an alert message
            alert("Please correct the highlighted fields.");
        }
    });

    // constantly update css every time there is a change in the input
    form.addEventListener('input', function(){
        completeCheck();
        validityCheck();
    });
});
