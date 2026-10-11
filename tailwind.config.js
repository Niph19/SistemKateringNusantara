import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif],
            },

            colors: {
                // Palet Batik Legam — Hitam Arang (background utama, teks, navbar)
                legam: {
                    950: '#0f0d09',  // Arang pekat
                    900: '#1a1610',  // Hitam arang
                    800: '#2a2218',  // Arang hangat
                    700: '#3d3224',  // Cokelat arang
                    600: '#52422e',  // Cokelat gelap
                    500: '#6b5740',  // Cokelat sedang
                    400: '#876e53',  // Cokelat muda
                    300: '#a98d70',  // Krem cokelat
                    200: '#c9ae92',  // Krem terang
                    100: '#e8d9c4',  // Krem pucat
                    50:  '#f7f1e8',  // Krem sangat pucat
                },

                // Emas / Kunyit — aksen utama premium
                emas: {
                    950: '#3d2800',
                    900: '#6b4500',
                    800: '#8a5a00',
                    700: '#a87000',
                    600: '#c98a00',
                    500: '#e6a000',  // Kunyit murni
                    400: '#f0b429',  // Emas terang
                    300: '#f5c842',  // Emas muda
                    200: '#f9db7a',  // Emas pucat
                    100: '#fcedb8',  // Krem emas
                    50:  '#fef8e7',  // Putih emas
                },

                // Terakota — aksen hangat sekunder
                tera: {
                    950: '#2a0d00',
                    900: '#4d1a00',
                    800: '#7a2d00',
                    700: '#a03c00',
                    600: '#c04a00',
                    500: '#d4551a',  // Terakota utama
                    400: '#e0703a',  // Terakota muda
                    300: '#e9956a',  // Salmon terakota
                    200: '#f0b99a',  // Peach
                    100: '#f8dfd2',  // Rose pucat
                    50:  '#fdf3ee',  // Putih rose
                },
            },

            backgroundImage: {
                // Pola kawung batik halus via SVG inline
                'batik-kawung': "url(\"data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23f0b429' fill-opacity='0.06'%3E%3Cellipse cx='20' cy='5' rx='4' ry='3'/%3E%3Cellipse cx='20' cy='35' rx='4' ry='3'/%3E%3Cellipse cx='5' cy='20' rx='3' ry='4'/%3E%3Cellipse cx='35' cy='20' rx='3' ry='4'/%3E%3Ccircle cx='20' cy='20' r='2'/%3E%3C/g%3E%3C/svg%3E\")",

                // Pola parang batik diagonal halus
                'batik-parang': "url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23f0b429' stroke-opacity='0.07' stroke-width='1'%3E%3Cpath d='M0 30 Q15 15 30 30 Q45 45 60 30'/%3E%3Cpath d='M0 10 Q15-5 30 10 Q45 25 60 10'/%3E%3Cpath d='M0 50 Q15 35 30 50 Q45 65 60 50'/%3E%3C/g%3E%3C/svg%3E\")",

                // Pola titik-titik halus untuk background konten
                'batik-dots': "url(\"data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='10' cy='10' r='1' fill='%23a87000' fill-opacity='0.08'/%3E%3C/svg%3E\")",
            },

            boxShadow: {
                'emas': '0 4px 14px 0 rgba(230, 160, 0, 0.25)',
                'emas-lg': '0 8px 30px 0 rgba(230, 160, 0, 0.30)',
                'legam': '0 4px 14px 0 rgba(26, 22, 16, 0.40)',
            },

            borderColor: {
                'emas': '#f0b429',
            },
        },
    },

    plugins: [forms],
};
