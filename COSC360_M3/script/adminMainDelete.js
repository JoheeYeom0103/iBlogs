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
    xhr.open("POST", "delete_post.php", true);
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

// Remove the unnecessary deleteButton selector
// const deleteButton = document.querySelector('button[name="submit_delete"]');

// document.querySelectorAll(".deleteForm").forEach((form) => {
//   form.addEventListener("submit", function (event) {
//     event.preventDefault(); // Prevent form submission
//     const formData = new FormData(this); // Get form data
//     const postId = formData.get("delete"); // Get post ID
//     deletePost(postId); // Call function to delete post
//   });
// });

// Attach event listeners to all delete forms
// document.querySelectorAll(".deleteForm").forEach((form) => {
//   form.addEventListener("submit", function (event) {
//     event.preventDefault(); // Prevent default form submission behavior
//     const formData = new FormData(this); // Get form data
//     const postId = formData.get("delete"); // Get post ID
//     deletePost(postId); // Call function to delete post
//   });
// });

// Attach event listeners to all delete forms
// document.querySelectorAll(".deleteForm").forEach((form) => {
//   form.addEventListener("submit", async function (event) {
//     event.preventDefault(); // Prevent default form submission behavior
//     const response = await fetch("adminDeletePost.php");
//     if (!response.ok) {
//       console.log("Post not deleted");
//       return;
//     }
//     const data = await response.json(); // Get form data
//     if (data.success) {
//       console.log("Form submitted"); // Check if the form submission event is triggered
//       const formData = new FormData(this); // Get form data
//       const postId = formData.get("delete"); // Get post ID
//       console.log("Post ID:", postId); // Check if the post ID is retrieved correctly
//       if (confirm("Are you sure you want to delete this post?")) {
//         console.log("User confirmed deletion"); // Check if the confirm method works
//         deletePost(postId); // Call function to delete post
//       } else {
//         console.log("Deletion cancelled by user"); // Log cancellation
//       }
//       console.log("Post deleted");
//     }
//   });
// });

// Function to delete a post
// function deletePost(postId) {
//   if (confirm("Are you sure you want to delete this post?")) {
//     var formData = new FormData();
//     formData.append("delete", postId);
//     var xhr = new XMLHttpRequest();
//     xhr.open("POST", '<?php echo $_SERVER["PHP_SELF"]; ?>', true);
//     xhr.onload = function () {
//       if (xhr.status === 200) {
//         // Handle the response
//         alert(xhr.responseText);
//         // Optionally, remove the deleted post from the DOM
//         var row = document.getElementById("deleteForm" + postId).parentNode
//           .parentNode;
//         row.parentNode.removeChild(row);
//       }
//     };
//     xhr.send(formData);
//   }
// }
