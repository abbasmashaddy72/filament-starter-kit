const plugin = require("tailwindcss/plugin");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./app/Colors/**/*.php",
        "./app/Helpers/Utilities.php",
        "./resources/**/*.blade.php",
        "./vendor/lara-zeus/core/resources/views/**/*.blade.php",
        "./vendor/lara-zeus/bolt/resources/views/themes/**/*.blade.php",
        "./vendor/lara-zeus/bolt/resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
    ],
    darkMode: "class",
    important: true,
    theme: {
        screens: {
            xs: "540px",
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1280px",
            "2xl": "1536px",
            lg_992: "992px",
        },
        fontFamily: {
            lexend: ['"Lexend", sans-serif'],
            inter: ['"Inter", sans-serif'],
            mono: ['"monospace", sans-serif'],
        },
        container: {
            center: true,
            padding: {
                DEFAULT: "12px",
                sm: "1rem",
                lg: "45px",
                xl: "5rem",
                "2xl": "13rem",
            },
        },
        extend: {
            colors: {
                custom: {
                    50: "rgba(var(--c-50), <alpha-value>)",
                    100: "rgba(var(--c-100), <alpha-value>)",
                    200: "rgba(var(--c-200), <alpha-value>)",
                    300: "rgba(var(--c-300), <alpha-value>)",
                    400: "rgba(var(--c-400), <alpha-value>)",
                    500: "rgba(var(--c-500), <alpha-value>)",
                    600: "rgba(var(--c-600), <alpha-value>)",
                    700: "rgba(var(--c-700), <alpha-value>)",
                    800: "rgba(var(--c-800), <alpha-value>)",
                    900: "rgba(var(--c-900), <alpha-value>)",
                    950: "rgba(var(--c-950), <alpha-value>)",
                },
                danger: {
                    50: "rgba(var(--danger-50), <alpha-value>)",
                    100: "rgba(var(--danger-100), <alpha-value>)",
                    200: "rgba(var(--danger-200), <alpha-value>)",
                    300: "rgba(var(--danger-300), <alpha-value>)",
                    400: "rgba(var(--danger-400), <alpha-value>)",
                    500: "rgba(var(--danger-500), <alpha-value>)",
                    600: "rgba(var(--danger-600), <alpha-value>)",
                    700: "rgba(var(--danger-700), <alpha-value>)",
                    800: "rgba(var(--danger-800), <alpha-value>)",
                    900: "rgba(var(--danger-900), <alpha-value>)",
                    950: "rgba(var(--danger-950), <alpha-value>)",
                },
                gray: {
                    50: "rgba(var(--gray-50), <alpha-value>)",
                    100: "rgba(var(--gray-100), <alpha-value>)",
                    200: "rgba(var(--gray-200), <alpha-value>)",
                    300: "rgba(var(--gray-300), <alpha-value>)",
                    400: "rgba(var(--gray-400), <alpha-value>)",
                    500: "rgba(var(--gray-500), <alpha-value>)",
                    600: "rgba(var(--gray-600), <alpha-value>)",
                    700: "rgba(var(--gray-700), <alpha-value>)",
                    800: "rgba(var(--gray-800), <alpha-value>)",
                    900: "rgba(var(--gray-900), <alpha-value>)",
                    950: "rgba(var(--gray-950), <alpha-value>)",
                },
                info: {
                    50: "rgba(var(--info-50), <alpha-value>)",
                    100: "rgba(var(--info-100), <alpha-value>)",
                    200: "rgba(var(--info-200), <alpha-value>)",
                    300: "rgba(var(--info-300), <alpha-value>)",
                    400: "rgba(var(--info-400), <alpha-value>)",
                    500: "rgba(var(--info-500), <alpha-value>)",
                    600: "rgba(var(--info-600), <alpha-value>)",
                    700: "rgba(var(--info-700), <alpha-value>)",
                    800: "rgba(var(--info-800), <alpha-value>)",
                    900: "rgba(var(--info-900), <alpha-value>)",
                    950: "rgba(var(--info-950), <alpha-value>)",
                },
                primary: {
                    50: "rgba(var(--primary-50), <alpha-value>)",
                    100: "rgba(var(--primary-100), <alpha-value>)",
                    200: "rgba(var(--primary-200), <alpha-value>)",
                    300: "rgba(var(--primary-300), <alpha-value>)",
                    400: "rgba(var(--primary-400), <alpha-value>)",
                    500: "rgba(var(--primary-500), <alpha-value>)",
                    600: "rgba(var(--primary-600), <alpha-value>)",
                    700: "rgba(var(--primary-700), <alpha-value>)",
                    800: "rgba(var(--primary-800), <alpha-value>)",
                    900: "rgba(var(--primary-900), <alpha-value>)",
                    950: "rgba(var(--primary-950), <alpha-value>)",
                },
                success: {
                    50: "rgba(var(--success-50), <alpha-value>)",
                    100: "rgba(var(--success-100), <alpha-value>)",
                    200: "rgba(var(--success-200), <alpha-value>)",
                    300: "rgba(var(--success-300), <alpha-value>)",
                    400: "rgba(var(--success-400), <alpha-value>)",
                    500: "rgba(var(--success-500), <alpha-value>)",
                    600: "rgba(var(--success-600), <alpha-value>)",
                    700: "rgba(var(--success-700), <alpha-value>)",
                    800: "rgba(var(--success-800), <alpha-value>)",
                    900: "rgba(var(--success-900), <alpha-value>)",
                    950: "rgba(var(--success-950), <alpha-value>)",
                },
                warning: {
                    50: "rgba(var(--warning-50), <alpha-value>)",
                    100: "rgba(var(--warning-100), <alpha-value>)",
                    200: "rgba(var(--warning-200), <alpha-value>)",
                    300: "rgba(var(--warning-300), <alpha-value>)",
                    400: "rgba(var(--warning-400), <alpha-value>)",
                    500: "rgba(var(--warning-500), <alpha-value>)",
                    600: "rgba(var(--warning-600), <alpha-value>)",
                    700: "rgba(var(--warning-700), <alpha-value>)",
                    800: "rgba(var(--warning-800), <alpha-value>)",
                    900: "rgba(var(--warning-900), <alpha-value>)",
                    950: "rgba(var(--warning-950), <alpha-value>)",
                },
            },
            boxShadow: {
                sm: "0 2px 4px 0 rgb(60 72 88 / 0.15)",
                DEFAULT: "0 0 3px rgb(60 72 88 / 0.15)",
                md: "0 5px 13px rgb(60 72 88 / 0.20)",
                lg: "0 10px 25px -3px rgb(60 72 88 / 0.15)",
                xl: "0 20px 25px -5px rgb(60 72 88 / 0.1), 0 8px 10px -6px rgb(60 72 88 / 0.1)",
                "2xl": "0 25px 50px -12px rgb(60 72 88 / 0.25)",
                inner: "inset 0 2px 4px 0 rgb(60 72 88 / 0.05)",
                testi: "2px 2px 2px -1px rgb(60 72 88 / 0.15)",
            },

            spacing: {
                0.75: "0.1875rem",
                3.25: "0.8125rem",
            },

            maxWidth: ({ theme, breakpoints }) => ({
                1200: "71.25rem",
                992: "60rem",
                768: "45rem",
            }),

            zIndex: {
                1: "1",
                2: "2",
                3: "3",
                999: "999",
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms")({
            strategy: "class", // only generate classes
        }),
        require("@tailwindcss/typography"),
        require("flowbite/plugin"),
    ],
};
