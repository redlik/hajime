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
                '100': '#68FE6A',
                '200': '#35FE38',
                '300': '#03FD06',
                '400': '#01CC04',
                '500': '#019903',
                '600': '#016602',
                '700': '#003401',
                '800': '#000100',
                '900': '#000000'
            },
        },
        fontFamily: {
            sans: ['Source Sans Pro', 'sans-serif'],
        },
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
