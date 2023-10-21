import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
const colors = require('tailwindcss/colors')


export default {
    content: ['./resources/**/*.blade.php', './vendor/filament/**/*.blade.php'],
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
                    '50': '#A4EAA5',
                    '100': '#8FE591',
                    '200': '#66DB68',
                    '300': '#3DD13F',
                    '400': '#2AB22B',
                    '500': '#019903',
                    '600': '#0A850C',
                    '700': '#065507',
                    '800': '#032603',
                    '900': '#000000',
                },
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },
        },
    },
    plugins: [forms, typography],
}
