const checkbox = document.getElementById('terms_tambah');
    const submitButton = document.querySelector('.btn-tambah');

    // Fungsi untuk mengubah status tombol berdasarkan status checkbox
    function toggleButton() {
        submitButton.disabled = !checkbox.checked;
    }

    // Panggil fungsi saat halaman dimuat dan setiap kali status checkbox berubah
    window.onload = toggleButton;
    checkbox.addEventListener('change', toggleButton);