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
            'bluep': '#3F83F8',
            'greenp2': '#B0F2C2'
        }
    },
    plugins: [
        require('flowbite/plugin')
    ],
}

