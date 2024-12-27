document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM fully loaded");
    let isEditing = false;

    const editButton = document.getElementById('btn-edit-nilai');
    if (editButton) {
        console.log("Button found, adding event listener");
        editButton.addEventListener('click', function() {
            console.log("Button clicked");
            const editMessage = document.getElementById('edit-message');
            const editErrorMessage = document.getElementById('edit-error-message');

            // Select all input fields within the card body
            const inputs = document.querySelectorAll('.card-body input[type="text"]');

            if (!isEditing) {
                // Allow editing
                inputs.forEach(function(input) {
                    input.removeAttribute('readonly');
                });
                editMessage.style.display = 'block';
                editErrorMessage.style.display = 'none';
                isEditing = true;
            } else {
                // Disallow editing
                inputs.forEach(function(input) {
                    input.setAttribute('readonly', 'readonly');
                });
                editErrorMessage.style.display = 'block';
                editMessage.style.display = 'none';
                isEditing = false;
            }

            // Hide the messages after 2 seconds
            setTimeout(() => {
                editMessage.style.display = 'none';
                editErrorMessage.style.display = 'none';
            }, 2000);
        });
    } else {
        console.log("Button with ID 'btn-edit-nilai' not found.");
    }
});
document.addEventListener('DOMContentLoaded', function () {
    let isEditing = false;

    // Tombol Edit
    const editButton = document.getElementById('btn-edit-capel');

    // Elemen Pesan
    const editMessage = document.getElementById('edit-message');
    const editErrorMessage = document.getElementById('edit-error-message');

    // Fungsi untuk menampilkan pesan
    const showMessage = (messageElement) => {
        if (messageElement) {
            messageElement.style.display = 'block';

            // Sembunyikan pesan setelah 2 detik
            setTimeout(() => {
                messageElement.style.display = 'none';
            }, 2000);
        }
    };

    if (editButton) {
        editButton.addEventListener('click', function () {
            const textareas = document.querySelectorAll('.capel-textarea');
            const selectOptions = document.querySelectorAll('.capel-select');

            // Toggle editing mode
            isEditing = !isEditing;

            // Ubah properti readonly dan disabled untuk textarea dan select
            textareas.forEach(function (textarea) {
                textarea.toggleAttribute('readonly', !isEditing);
            });

            selectOptions.forEach(function (select) {
                select.disabled = !isEditing;
            });

            // Tampilkan pesan yang sesuai
            if (isEditing) {
                showMessage(editMessage);
            } else {
                showMessage(editErrorMessage);
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    let isEditing = false;
    const editButton = document.getElementById('btn-edit-lingkup');
    const editMessage = document.getElementById('edit-message');
    const editErrorMessage = document.getElementById('edit-error-message');

    if (editButton) {
        editButton.addEventListener('click', function() {
            const textareas = document.querySelectorAll('.lingkup-textarea');

            if (!isEditing) {
                textareas.forEach(function(textarea) {
                    textarea.removeAttribute('readonly');
                });
                editMessage.style.display = 'block';
                editErrorMessage.style.display = 'none';
                isEditing = true;
            } else {
                textareas.forEach(function(textarea) {
                    textarea.setAttribute('readonly', 'readonly');
                });
                editErrorMessage.style.display = 'block';
                editMessage.style.display = 'none';
                isEditing = false;
            }

            // Hide the messages after 2 seconds
            setTimeout(() => {
                editMessage.style.display = 'none';
                editErrorMessage.style.display = 'none';
            }, 2000);
        });
    }
});