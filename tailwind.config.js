/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                body: ["Manrope, sans-serif"],
            },
            fontSize: {
                body: ["1rem", { fontWeight: "400" }],
                body_bold: ["1rem", { fontWeight: "700" }],
                detail: ["0.875rem", { fontWeight: "400" }],
                smallest: ["0.75rem", { fontWeight: "400" }],
                subtitle: ["1.125rem", { fontWeight: "500" }],
                title_02: ["1.5rem", { fontWeight: "700" }],
                title_01: ["1.75rem", { fontWeight: "700" }],
                main_03: ["2rem", { fontWeight: "700" }],
                main_02: ["2.375rem", { fontWeight: "700" }],
                main_01: ["2.625rem", { fontWeight: "700" }],
                display_03: ["3.75rem", { fontWeight: "700" }],
                display_02: ["4.5rem", { fontWeight: "700" }],
                display_01: ["5rem", { fontWeight: "700" }],
            },
            colors: {
                transparent: "transparent",
                current: "currentColor",
                white: "#FAF9F6",
                black: "#0d1321",
                "light-blue": "#98B4D9",
                "primary-blue": "#5B86AC",
                "dark-blue": "#1d2d44",
                "hover-blue": "#3A5974",
                "gray-4": "#495057",
                "gray-3": "#ACB5BD",
                "gray-2": "#DDE2E5",
                "gray-1": "#F5F5F5",
            },
            boxShadow: {
                drop1: "0px 25px 10px 0px rgba(0 0 0 / 0.01)",
            },
        },
    },
    plugins: [],
};
