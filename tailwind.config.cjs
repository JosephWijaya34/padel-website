/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                main: "#0C3D3C",
                cta: "#D93B27",
                accent: "#E9EC90",
                background: "#F4F7F6",
                card: "#FFFFFF",
                text: "#0B0F10",
                secondary: "#163939",
            },
            fontFamily: {
                display: ["Rubik", "Inter", "ui-sans-serif", "system-ui"],
                sans: ["Inter", "ui-sans-serif", "system-ui"],
                tally: ['"Bebas Neue"', "Inter", "ui-sans-serif"],
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
