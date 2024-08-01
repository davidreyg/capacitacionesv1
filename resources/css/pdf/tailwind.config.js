import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
export default {
    content: [
        "./resources/views/components/layouts/pdf.blade.php",
        "./resources/views/components/pdf/*.blade.php",
        "./resources/views/components/reporte-asistencia.blade.php",
        "./resources/views/components/ficha-capacitacion.blade.php",
    ],
    plugins: [ require('daisyui'),forms,typography],
};
