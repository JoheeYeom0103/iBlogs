document.addEventListener("DOMContentLoaded", function () {
  const addCommentForm = document.getElementById("addCommentForm");

  const comment = document.querySelector('input[name="commentContent"]');

  /** @type {HTMLButtonElement} */
  const addSubmit = document.querySelector('button[name="addSubmit"]');

  addCommentForm.addEventListener("submit", function (event) {
    if (comment.value === "") {
      event.preventDefault();
      alert(
        "Empty comments are invalid. Please fill in the comment field before adding."
        ); // end of alert
        comment.style.backgroundColor = "#F9EDE2";
    } // end of if statement

    if (comment !== "") {
      comment.style.backgroundColor = "#FFFFFF";
    }

    // stll need to add code to verify if user is logged in or not


  }); // end of addCommentForm event listener
}); // end of document (DOMContentLoaded) event listener
