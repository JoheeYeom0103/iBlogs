//TODO update this so that the table rows are deleted asynchronously

$(document).ready(function () {
  $(".deleteCommentForm").submit(function (event) {
    event.preventDefault(); // Prevent default form submission

    var form = $(this);
    console.log("Form submitted"); // Debugging
    var postUrl = form.attr("action");
    var postData = form.serialize(); // Serialize form data for AJAX

    $.ajax({
      type: "POST",
      url: postUrl,
      data: postData,
      success: function (response) {
        // Update the table or display a success message
        console.log("AJAX request successful"); // Add this line to check if the AJAX request is successful
        console.log(response);
        form.closest("tr").remove(); // Remove the deleted row from the table
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        alert("Error deleting comment js. Please try again.");
      },
    });
  });
});
