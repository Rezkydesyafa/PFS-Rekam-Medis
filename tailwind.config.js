import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                display: ["Inter", "sans-serif"],
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#2563EB",
                "background-light": "#f6f7f8",
                "background-dark": "#101922",
            },
        },
    },

    plugins: [forms],
};
