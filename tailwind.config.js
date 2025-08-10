/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                main: "#2A3439",
                secondary: "#BFFF00",
                blackmatte: '#1C1C1C',
                edit : '#FFC107',
                edithover : '#E0A800',
                emas: {
                    100: "#8D5F2E",
                    200: "#D7AF4B",
                    300: "#EBD58F",
                    400: "#654511",
                },
            },
            fontFamily: {
                oswald: ["oswald", "sans-serif"],
                roboto: ["quicksand", "sans-serif"],
            },
        },
    },
    plugins: [
        require("flowbite/plugin"),
    ],
};
