import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
export default {
    content: [
        "./resources/views/components/layouts/pdf.blade.php",
        "./resources/views/components/pdf/*.blade.php",
        "./resources/views/components/reporte-asistencia.blade.php",
        "./resources/views/components/ficha-capacitacion.blade.php",
        "./resources/views/components/ficha-registro-accidente.blade.php",
        "./resources/views/components/declaracion-testigo-pdf.blade.php",
        "./resources/views/components/anexo-uno-pdf.blade.php",
    ],
    plugins: [require('daisyui'), forms, typography],
};
