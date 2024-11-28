{
    let isEditing = false;

    document.getElementById('btn-edit-nilai').addEventListener('click', function() {
        const editMessage = document.getElementById('edit-message');
        const editErrorMessage = document.getElementById('edit-error-message');

        // Select all input fields within the card body
        const inputs = document.querySelectorAll('.card-body input[type="text"]');

        if (!isEditing) {
            // Allow editing
            inputs.forEach(function(input) {
                input.removeAttribute('readonly'); // Remove readonly attribute
            });
            editMessage.style.display = 'block';
            editErrorMessage.style.display = 'none';
            isEditing = true; // Set editing state to true
        } else {
            // Disallow editing
            inputs.forEach(function(input) {
                input.setAttribute('readonly', 'readonly'); // Add readonly attribute
            });
            editErrorMessage.style.display = 'block';
            editMessage.style.display = 'none';
            isEditing = false; // Set editing state to false
        }

        // Hide the messages after 2 seconds
        setTimeout(() => {
            editMessage.style.display = 'none';
            editErrorMessage.style.display = 'none';
        }, 2000);
 });
}
{
    const successModal = document.getElementById('successModal');
    if (successModal) {
        // Show the modal
        $(successModal).modal('show');

        // Set a timeout to hide the modal after 1 second (1000 milliseconds)
        setTimeout(() => {
            $(successModal).modal('hide');
        }, 1500);
    }
}