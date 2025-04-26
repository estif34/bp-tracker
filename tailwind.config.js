/** @type {import('tailwindcss').Config} */
export default {
    content: [
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
      './storage/framework/views/*.php',
      './resources/views/**/*.blade.php',
    ],
    theme: {
      extend: {
        colors: {
          // Custom colors for blood pressure categories
          'bp-normal': '#4ade80', // green-400
          'bp-elevated': '#facc15', // yellow-400 
          'bp-stage1': '#fb923c', // orange-400
          'bp-stage2': '#ef4444', // red-500
          'bp-crisis': '#b91c1c', // red-700
        },
      },
    },
    plugins: [require('@tailwindcss/forms')],
  }