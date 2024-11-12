<!DOCTYPE html>
<meta charset="utf-8">
<style>
    .pageHeader {
        -webkit-print-color-adjust: exact;
        font-family: system-ui;
        font-size: 6pt;
        width: 100%;
        /* display: flex; */
        /* justify-content: space-between; */
        /* align-items: center; */
        margin: 0 5px 0 5px;
        /* position: relative; */
        /* padding: 10px; */
        /* background-color: red; */

        /* Ajusta el color de fondo si es necesario */
    }

    .logo {
        height: 30px;
        /* Ajusta el tamaño del logo según sea necesario */
    }

    .header-item {
        display: flex;
        align-items: center;
    }
</style>
<header class="pageHeader">
    <table style="width: 100%">
        <tbody>
            <tr>
                <td style="width: 30%">
                    <div class="header-item">
                        <img src="{{ $logoBase64 }}" alt="Logo" class="logo">
                    </div>
                </td>
                <td style="width: 50%;text-align: center">
                </td>
                <td class="text-left" style="width: 25%;text-align: right">
                    <table border="1" style="border-collapse: collapse">
                        <tbody>
                            <tr>
                                <td>Codigo</td>
                                <td>DIRIS-LS-F-009</td>
                            </tr>
                            <tr>
                                <td>Version</td>
                                <td>01</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center;font-size: 10pt">
                    DECLARACIÓN DEL AFECTADO O TESTIGO DEL ACCIDENTE O INCIDENTE LABORAL
                    <br>
                    ÁREA DE SEGURIDAD Y SALUD EN EL TRABAJO
                </td>
            </tr>
        </tbody>
    </table>
</header>
