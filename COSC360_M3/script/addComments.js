document.addEventListener("DOMContentLoaded", function () {
  const addCommentForm = document.getElementById("addCommentForm");

  const comment = document.querySelector('input[name="commentContent"]');

  /** @type {HTMLButtonElement} */
  const addSubmit = document.querySelector('button[name="addSubmit"]');

  addCommentForm.addEventListener("submit", function (event) {
    if (comment === "") {
      event.preventDefault();
      alert(
        "Empty comments are invalid. Please fill in the comment field before adding."
      );

      if (comment === "" || comment === null) {
        comment.style.backgroundColor = "#F9EDE2";
      }
    } // end of outer if statement

    if (comment !== "") {
      comment.style.backgroundColor = "#FFFFFF";
    }

    // need to verify if user is logged in or not

    
  }); // end of addCommentForm event listener
}); // end of document (DOMContentLoaded) event listener
