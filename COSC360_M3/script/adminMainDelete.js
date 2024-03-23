//TODO update this so that the table rows are deleted asynchronously

const deleteButton = document.querySelector('button[id="delete"]');

function deleteRow(btn) {
  // Get the row to be deleted
  var row = btn.parentNode.parentNode;
  // Ensure that there's at least one row left in the table
  if (row.parentNode.rows.length > 1) {
    // Remove the row from the table
    row.parentNode.removeChild(row);
  } else {
    alert("Cannot delete the last row!");
  }
}
