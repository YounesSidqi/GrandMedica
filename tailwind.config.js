/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      colors : {
        primary : '#6B9169',
        secondry : '#EE7C30'
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

