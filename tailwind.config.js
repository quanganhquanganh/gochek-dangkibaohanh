/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/usernotnull/tall-toasts/config/**/*.php",
        "./vendor/usernotnull/tall-toasts/resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#353535",
                secondary: "#ededed",
                background: "#252525",
            },
        },
    },
    plugins: [],
};
