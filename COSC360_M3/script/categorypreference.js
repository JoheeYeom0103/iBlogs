document.addEventListener("DOMContentLoaded", function() {

    const categoryForm = document.querySelector("#categoryForm");
    const checkboxes = document.querySelectorAll(".category-checkbox");
    const counter = document.querySelector("#categoryCounter");

    // function to update how many checkboxes are selected at one time
    function updateCounter() {
        // counter to see how many are checked
        const checkedCount = document.querySelectorAll(".category-checkbox:checked").length;
        counter.textContent = "Categories selected: " + checkedCount;

        if (checkedCount < 6 || checkedCount > 6) {
            counter.style.color = "red";
        } else {
            counter.style.color = "green";
        }
    }

    function checkSelectedCategories(){
        // generate an array of the checked boxes based on user input
        const checkedBoxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);
        // ensure that there are only 6 boxes checked - no more or less
        if(checkedBoxes.length === 6){
            return true;
        }else{
            return false;
        }
    }

    // everytime a new box is selected or deselected call the update counter function
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function() {
            updateCounter();
            checkSelectedCategories();
        });
    });

    // prevent default submission if there are more or less than 6 categories selected
    categoryForm.addEventListener("submit", function(event){
        if(!checkSelectedCategories()){
            event.preventDefault();
            alert("Please select 6 categories");
        }
    });

    // Initial update of the counter
    updateCounter();
});
