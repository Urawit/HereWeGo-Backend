/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      keyframes: {
        move: {
          from: {
            strokeDashoffset: '0'
          },to:{
            strokeDashoffset: '1000'
          },
        },
      },
    },
  },
  plugins: [],
}