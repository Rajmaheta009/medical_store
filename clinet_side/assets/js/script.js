function toggleDarkMode() {
    document.addEventListener('DOMContentLoaded', function() {
        const darkModeToggle = document.getElementById('darkModeToggle');
        const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;

        // Apply saved theme on load
        if (currentTheme) {
            document.body.classList.remove('dark-mode', 'light-mode'); // Remove both classes
            document.body.classList.add(currentTheme);
            if (currentTheme === 'dark-mode') {
                darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            }
        }

        // Toggle dark mode
        darkModeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            document.body.classList.toggle('light-mode'); // Toggle both classes

            // Update button text
            if (document.body.classList.contains('dark-mode')) {
                darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                localStorage.setItem('theme', 'dark-mode');
            } else {
                darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                localStorage.setItem('theme', 'light-mode');
            }
        });
    });
}

// Call the function to set up the event listener
toggleDarkMode();