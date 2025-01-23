document.addEventListener('DOMContentLoaded', () => {
    // Create a button for toggling the theme
    const themeToggle = document.createElement('button');
    themeToggle.textContent = '🌓';
    themeToggle.classList.add('theme-toggle');
    document.body.appendChild(themeToggle);

    // Check if a theme is saved in localStorage and apply it
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.body.classList.add(savedTheme);
    }

    // Add an event listener to the theme toggle button
    themeToggle.addEventListener('click', () => {
        // Toggle the 'dark-theme' class on the body
        document.body.classList.toggle('dark-theme');
        
        // Determine the current theme and save it to localStorage
        const currentTheme = document.body.classList.contains('dark-theme') 
            ? 'dark-theme' 
            : '';
        
        localStorage.setItem('theme', currentTheme);
    });
});