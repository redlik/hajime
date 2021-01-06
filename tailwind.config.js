module.exports = {
  purge: {
      content: [
          './resources/views/**/*.blade.php',
      ]
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
        colors: {
            lightjudo: {
                '50':  '#fafbf7',
                '100': '#f6fae3',
                '200': '#e9f5aa',
                '300': '#d3ea64',
                '400': '#97d524',
                '500': '#56bc0b',
                '600': '#399d06',
                '700': '#317c09',
                '800': '#285c0d',
                '900': '#1f470e',
            },
            judo: {
                '50':  '#f5faf7',
                '100': '#ebf8ed',
                '200': '#d1f2cf',
                '300': '#a7e7a7',
                '400': '#58d26b',
                '500': '#26b93a',
                '600': '#48962b',
                '700': '#1f7b25',
                '800': '#1e5e25',
                '900': '#1a4a22',
            },
        }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/forms'),
      require('@tailwindcss/typography'),
  ],
}
