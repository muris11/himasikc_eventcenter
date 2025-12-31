/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.jsx",
        "./resources/**/*.vue",
        "./app/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                // Semantic Colors mapped to CSS Variables
                background: {
                    DEFAULT: 'rgb(var(--background) / <alpha-value>)',
                    secondary: 'rgb(var(--background-secondary) / <alpha-value>)',
                },
                surface: {
                    DEFAULT: 'rgb(var(--surface) / <alpha-value>)',
                    secondary: 'rgb(var(--surface-secondary) / <alpha-value>)',
                    tertiary: 'rgb(var(--surface-tertiary) / <alpha-value>)',
                },
                primary: {
                    DEFAULT: 'rgb(var(--primary) / <alpha-value>)',
                    foreground: 'rgb(var(--primary-foreground) / <alpha-value>)',
                    50: '#FFFCF5',
                    100: '#FFF8E7',
                    200: '#FFEFC2',
                    300: '#FFE299',
                    400: '#F5C75F',
                    500: '#E6AD2B',
                    600: '#CC9820',
                    700: '#A67C1A',
                    800: '#7A5B14',
                    900: '#523D0E',
                    950: '#2D1F05',
                },
                secondary: {
                    DEFAULT: 'rgb(var(--secondary) / <alpha-value>)',
                    foreground: 'rgb(var(--secondary-foreground) / <alpha-value>)',
                },
                text: {
                    main: 'rgb(var(--text-main) / <alpha-value>)',
                    muted: 'rgb(var(--text-muted) / <alpha-value>)',
                    inverted: 'rgb(var(--text-inverted) / <alpha-value>)',
                },
                border: {
                    DEFAULT: 'rgb(var(--border) / <alpha-value>)',
                    subtle: 'rgb(var(--border-subtle) / <alpha-value>)',
                },
                // Status Colors
                status: {
                    success: 'rgb(var(--status-success) / <alpha-value>)',
                    error: 'rgb(var(--status-error) / <alpha-value>)',
                    warning: 'rgb(var(--status-warning) / <alpha-value>)',
                    info: 'rgb(var(--status-info) / <alpha-value>)',
                },
                // Slate Scale for Dark Mode
                slate: {
                    50: '#f8fafc',
                    100: '#f1f5f9',
                    200: '#e2e8f0',
                    300: '#cbd5e1',
                    400: '#94a3b8',
                    500: '#64748b',
                    600: '#475569',
                    700: '#334155',
                    800: '#1e293b',
                    900: '#0f172a',
                    950: '#020617',
                },
                // Zinc Scale for Neutral Elements
                zinc: {
                    50: '#fafafa',
                    100: '#f4f4f5',
                    200: '#e4e4e7',
                    300: '#d4d4d8',
                    400: '#a1a1aa',
                    500: '#71717a',
                    600: '#52525b',
                    700: '#3f3f46',
                    800: '#27272a',
                    900: '#18181b',
                    950: '#09090b',
                },
            },
            fontFamily: {
                sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
                heading: ['Plus Jakarta Sans', 'Inter', 'system-ui', 'sans-serif'],
                display: ['Outfit', 'Plus Jakarta Sans', 'system-ui', 'sans-serif'],
                mono: ['JetBrains Mono', 'Fira Code', 'monospace'],
            },
            boxShadow: {
                'sm': '0 1px 2px 0 rgb(0 0 0 / 0.05)',
                DEFAULT: '0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1)',
                'md': '0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)',
                'lg': '0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1)',
                'xl': '0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1)',
                '2xl': '0 25px 50px -12px rgb(0 0 0 / 0.25)',
                'mustard': '0 10px 40px -10px rgba(230, 173, 43, 0.3)',
                'mustard-lg': '0 20px 60px -15px rgba(230, 173, 43, 0.4)',
                'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.07)',
                'glass-dark': '0 8px 32px 0 rgba(0, 0, 0, 0.3)',
            },
            backgroundImage: {
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                'mustard-gradient': 'linear-gradient(135deg, #E6AD2B 0%, #F5C75F 50%, #E6AD2B 100%)',
                'dark-gradient': 'linear-gradient(180deg, rgba(28, 25, 23, 0) 0%, rgba(28, 25, 23, 0.8) 100%)',
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'fade-in-up': 'fadeInUp 0.6s ease-out',
                'float': 'float 3s ease-in-out infinite',
                'shimmer': 'shimmer 2s infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                fadeInUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                shimmer: {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};
