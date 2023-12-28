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
    },
    plugins: [
        require('flowbite/plugin')
    ],
}

