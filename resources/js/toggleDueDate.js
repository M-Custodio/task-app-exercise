document.addEventListener("DOMContentLoaded", function () {
    const dueDateInput = document.getElementById("due_date");
    const noDueDateCheckbox = document.getElementById("no_due_date");

    function toggleDueDate() {
        if (noDueDateCheckbox.checked) {
            dueDateInput.disabled = true;
            dueDateInput.value = "";
        } else {
            dueDateInput.disabled = false;
        }
    }

    if (noDueDateCheckbox) {
        noDueDateCheckbox.addEventListener("change", toggleDueDate);
        toggleDueDate(); // Initialize on page load
    }
});
