const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {

    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'transparent': 'transparent',
                'black': '#2B4964',
                'grey-darkest': '#626471',
                'grey-darker': '#878c98',
                'grey-dark': '#adb4c2',
                'grey': '#d5d9e3',
                'grey-light': '#dee1e8',
                'grey-lighter': '#eaebef',
                'grey-lightest': '#fcfcfc',
                'white': '#ffffff',
                'primary': '#2b79c1',
                'primary-dark': '#266299'
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],


};
