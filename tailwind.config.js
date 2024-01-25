/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'media',
    content: [
        './resources/**/*.{blade.php,js,vue}',
        './node_modules/flowbite/**/*.{js,jsx,ts,tsx}',
        './node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}',
    ],
    theme: {
        extend: {},
        colors: {
            'greenp1': '#31C48D',
            'bluep': '#76A9FA',
            'greenp2': '#b0f2c2'
        }
    },
    plugins: [
        require('flowbite/plugin')
    ],
}

