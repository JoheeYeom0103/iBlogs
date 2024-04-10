<?php

// Form has been submitted (The user clicked either 'save' or 'cancel')
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // The user clicked saved 
    if (isset($_POST['submit'])) {

        // Initialise $isValid to keep track of validity of every fields
        $isValid = true;
        
        // Handle Profile Image
        if(isset($_FILES['changeImg'])) {

            $img_name = $_FILES['changeImg']['name']; // File name
            $img_size = $_FILES['changeImg']['size']; // File size
            $tmp_name = $_FILES['changeImg']['tmp_name']; // File's temporary name (Key in the $_FILES Array)
            $error = $_FILES['changeImg']['error']; // Upload Error Number
        
            // If the user has been uploaded an image & there is no error
            if($error == 0) {
                // If image size is greater than 10mb (maximum size)
                if($img_size > 10000000) { 
                    echo "<script>alert('File size too big')</script>";
                // If image size is less than 10mb
                } else {
                    // The uploaded file's extension
                    /* pathinfo("fileName", PATHINFO_EXTENSION): return a file extension in string */
                    $img_extension = pathinfo($img_name, PATHINFO_EXTENSION);
                    
                    // Change the string into lower case
                    /* strtolower("fileExtensionName") */
                    $img_extension_lowercase = strtolower($img_extension);
                   
                    // Create an string array of valid extension names
                    $allowed_extension = array("jpg", "jpeg", "png");
        
                    // If the image extension is one of the allowed extension
                    /* in_array("fileExtensionName", "validExtensionName") */
                    if(in_array($img_extension_lowercase, $allowed_extension)) {

                        // Generate a unique/random image name
                        /* unique("StartingString", true): generate a string starting with the specified string */
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_extension_lowercase;

                        // Final location of the uploaded file
                        $img_upload_path = 'uploads/' . $new_img_name;
        
                        // Move the uploaded file to the final location
                        /* move_uploaded_file("fileTempName", "FinalLocation") */
                        /* Permission Needed!! Use this command: chmod -R 777 /Applications/XAMPP/xamppfiles/htdocs/cosc360_editaccount/uploads */
                        move_uploaded_file($tmp_name, $img_upload_path);
        
                        // Update the ProfileImg field of User entity with the new image
                        $imgSQL = "UPDATE user SET ProfileImg = ? WHERE UserId = ?";
                        $imgPstmt = mysqli_prepare($connection, $imgSQL);
                        if ($imgPstmt) {
                            mysqli_stmt_bind_param($imgPstmt, "ss", $new_img_name, $old_userId);
                            $success = mysqli_stmt_execute($imgPstmt);
                            if ($success) {
                                $isValid = true;
                            } else {
                                echo "<script>alert('Failed to update database')</script>";
                            }
                            mysqli_stmt_close($imgPstmt);
                        } else {
                            echo "<script>alert('Failed to prepare statement')</script>";
                        }
                    // If the image extension is not one of the allowed extension
                    } else {
                        echo "<script>alert('Wrong file type')</script>";
                    }
                }
            // The user has not attempted to upload any image
            } else if($error == 4){
                // Ignore "UPLOAD_ERR_NO_FILE,"
            
            // The user has attempted to upload an image & Error occurred
            }else {
                echo "<script>alert('Unknown error happened')</script>";
            }
        // The user has attempted to upload an image & Error occurred & No image submitted
        } else {
            echo "<script>alert('Image not submitted')</script>";
        }        
     

        $new_userId = getInputValue('userId');
        $new_firstName = getInputValue('firstName');
        $new_lastName = getInputValue('lastName');
        $new_password = getInputValue('password');
        $new_email = getInputValue('email');

        // Validate each field
        foreach ($_POST as $field => $value) {
            if (!isFieldValid($field, $value)) {
                $isValid = false;
                break;
            }
        }
        // If all fields are valid, update user data
        if ($isValid) {
            $updateSQL = "UPDATE user SET UserId=?, FirstName=?, LastName=?, Email=?, Password=? WHERE UserId=?";
            $updatePstmt = mysqli_prepare($connection, $updateSQL);

            if ($updatePstmt) {
                mysqli_stmt_bind_param($updatePstmt, "ssssss", $new_userId, $new_firstName, $new_lastName, $new_email, $new_password, $old_userId);
                $success = mysqli_stmt_execute($updatePstmt);

                if ($success) {
                    // Save the new data into the old variables
                    $old_userId = $new_userId;
                    $old_firstname = $new_firstName;
                    $old_lastname = $new_lastName;
                    $hashed_password = md5($new_password);
                    $old_password = $hashed_password;
                    $old_email = $new_email;
                    echo "<script>alert('Changes have been successfully saved!'); window.location.href = 'editaccountpage.php';</script>";
                } else {
                    echo "<script>alert('Failed to save changes')</script>";
                }

                mysqli_stmt_close($updatePstmt);
            }
        } else {
            // If not valid, show error message
            echo "<script>alert('Correct the highlighted fields')</script>";
        }
    } elseif (isset($_POST['cancel'])) {
        // Redirect to a page after cancellation
        header('Location: editaccountpage.php');
        exit; 
    }
}
?>
