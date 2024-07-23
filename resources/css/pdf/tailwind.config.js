import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
export default {
    content: [
        "./resources/views/components/layouts/pdf.blade.php",
        "./resources/views/components/pdf/*.blade.php",
        "./resources/views/components/reporte-asistencia.blade.php",
    ],
    plugins: [ require('daisyui'),forms,typography],
};
