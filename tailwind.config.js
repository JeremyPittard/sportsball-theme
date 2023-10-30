/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  content: ["./**/*.php", "./**/*.twig"],
  blocklist: ["**/vendor/**"],
  theme: {
    fontFamily: {
      sans: ["InterVariable", "Inter", ...defaultTheme.fontFamily.sans],
    },
    extend: {
      colors: {
        //colors generetaed using https://www.tints.dev/
        "brand-primary": {
          DEFAULT: "#1B135C",
          50: "#E0DDF8",
          100: "#C2BBF1",
          200: "#887CE4",
          300: "#4B38D6",
          400: "#2F209C",
          500: "#1B135C",
          600: "#150F48",
          700: "#100B37",
          800: "#0B0826",
          900: "#050311",
          950: "#030208",
        },
        "brand-secondary": {
          DEFAULT: "#FFFFFF",
          50: "#FFFFFF",
          100: "#FFFFFF",
          200: "#FFFFFF",
          300: "#FFFFFF",
          400: "#FFFFFF",
          500: "#FFFFFF",
          600: "#CCCCCC",
          700: "#999999",
          800: "#666666",
          900: "#333333",
          950: "#1A1A1A",
        },
      },
      boxShadow: {
        "solid-bottom-right": "24px 24px 0px 6px #000000",
        "solid-bottom-left": "-24px 24px 0px 6px #000000",
        "solid-top-right": "24px -24px 0px 6px #000000",
        "solid-top-left": "-24px -24px 0px 6px #000000",
      },
    },
  },
  plugins: [],
};
