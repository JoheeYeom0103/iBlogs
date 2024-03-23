const deleteButton = document.querySelector('button[name="submit_delete"]');

// function deleteRow(btn) {
//   // Get the row to be deleted
//   var row = btn.parentNode.parentNode;
//   // Ensure that there's at least one row left in the table
//   if (row.parentNode.rows.length > 1) {
//     // Remove the row from the table
//     row.parentNode.removeChild(row);
//   } else {
//     alert("Cannot delete the last row!");
//   }
// }

document.querySelectorAll(".deleteForm").forEach((form) => {
  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent default form submission behavior
    const formData = new FormData(this); // Get form data
    const postId = formData.get("delete"); // Get post ID
    deletePost(postId); // Call function to delete post
  });
});

function deletePost(postId) {
  if (confirm("Are you sure you want to delete this post?")) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "adminDisplayUsers.php", true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        alert(xhr.responseText); // Show response from server
        // Optionally, update the UI to reflect post deletion
        const deletedPost = document.getElementById(`deleteForm${postId}`)
          .parentNode.parentNode;
        deletedPost.parentNode.removeChild(deletedPost);
      }
    };
    xhr.send(formData); // Send form data to server
  }
}
