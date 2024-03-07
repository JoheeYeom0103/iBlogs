document.addEventListener("DOMContentLoaded", function () {
  const createPostForm = document.getElementById("createPostForm");

  const title = document.querySelector('input[name="title"]');
  const category = document.querySelector('select[name="category"]');
  const textarea = document.querySelector(".content .diary-entry");

  /** @type {HTMLButtonElement} */
  const publicPost = document.querySelector('button[name="publicPost"]');
  /** @type {HTMLButtonElement} */
  const privatePost = document.querySelector('button[name="privatePost"]');

  createPostForm.addEventListener("submit", function (event) {
    if (title.value === "" || category.value === "" || textarea.value === "") {
      alert("Please fill in highlighted fields before submitting.");
      event.preventDefault();

      if (title.value === "") {
        title.style.backgroundColor = "#F9EDE2";
      }
      if (category.value === "") {
        category.style.backgroundColor = "#F9EDE2";
      }
      if (textarea.value === "") {
        textarea.style.backgroundColor = "#F9EDE2";
      }
    } // end of outer if statement

    if (title.value !== "" && category.value !== "" && textarea.value !== "") {
      title.style.backgroundColor = "#FFFFFF";
      category.style.backgroundColor = "#FFFFFF";
      textarea.style.backgroundColor = "#FFFFFF";

      if (
        publicPost.name !== event.submitter.name &&
        privatePost.name !== event.submitter.name
      ) {
        let text =
          "Are you sure you want this post to be public? \nClick OK if you'd like to proceed and post publically. \nClick Cancel if you'd like to go back and change your share settings. ";

        if (!confirm(text)) {
          event.preventDefault(); // stops the page from reloading and the form data from being sent to the server.
        } // end of if confirm
      } // end of visibility if statement
    } // end of outer if statement
  }); // end of createPostForm event listener
}); // end of document (DOMContentLoaded) event listener
