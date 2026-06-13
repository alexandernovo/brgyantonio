<script>
    $(document).on('click', '#btnPrintReport', function() {

        Swal.fire({
            title: 'Preparing Print...',
            text: 'Please wait',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        let content = $('#printArea').html();

        let printWindow = window.open('', '_blank', 'width=1000,height=900');

        printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Barangay Kagawad-Report</title>

            <link rel="stylesheet" href="{{ asset('template_assets/css/styles.min.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}">

            <style>
                @page {
                    size: A4 landscape;
                    margin: 10mm;
                }

                body {
                    background: white !important;
                    font-family: "Times New Roman", Times, serif !important;
                    color: #000 !important;
                }

                .page-container-print,
                .top-header,
                .btn,
                button {
                    display: none !important;
                }

                #printArea {
                    display: block !important;
                }

                .cert-paper {
                    max-width: 100% !important;
                    width: 100% !important;
                    border: none !important;
                    box-shadow: none !important;
                    margin: 0 !important;
                    padding: 0 !important;
                }

                table {
                    width: 100%;
                }

                img {
                    max-width: 100%;
                }
            </style>
        </head>

        <body>
            <div id="printArea">
                ${content}
            </div>

            <script>
                window.onload = function() {
                    setTimeout(function() {
                        window.print();

                        window.onafterprint = function() {
                            window.close();
                        };
                    }, 500);
                };
            <\/script>
        </body>
        </html>
    `);

        printWindow.document.close();

        Swal.close();
    });

    $(document).ready(function() {

        // PDF
        $(document).on('click', '#btnPdf', async function(e) {
            e.preventDefault();

            const {
                jsPDF
            } = window.jspdf;
            const element = document.getElementById('printArea');

            const canvas = await html2canvas(element, {
                scale: 2,
                useCORS: true,
                logging: false
            });

            const imgData = canvas.toDataURL('image/png');

            const pdf = new jsPDF({
                orientation: 'portrait', // change to 'landscape' if needed
                unit: 'mm',
                format: 'a4'
            });

            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

            pdf.addImage(
                imgData,
                'PNG',
                0,
                0,
                pdfWidth,
                pdfHeight
            );

            pdf.save('Kagawad-Report.pdf');
        });

        // WORD
        $(document).on('click', '#btnWord', function(e) {

            e.preventDefault();

            // Clone and remove images
            const clone = $('#printArea').clone();
            clone.find('img').remove();

            let content = `
        <html xmlns:o="urn:schemas-microsoft-com:office:office"
              xmlns:w="urn:schemas-microsoft-com:office:word"
              xmlns="http://www.w3.org/TR/REC-html40">
        <head>
            <meta charset="utf-8">
            <title>Kagawad-Report</title>

            <style>
                @page Section1 {
                    size: 841.9pt 595.3pt; /* A4 landscape */
                    mso-page-orientation: landscape;
                    margin: 10mm;
                }

                div.Section1 {
                    page: Section1;
                }
            </style>
        </head>

        <body>
            <div class="Section1">
                ${clone.html()}
            </div>
        </body>
        </html>
    `;

            const blob = new Blob(['\ufeff', content], {
                type: 'application/msword'
            });

            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = 'Kagawad-Report.doc';

            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            URL.revokeObjectURL(url);
        });


        $(document).on('click', '#btnExcel', function(e) {
            e.preventDefault();

            const wb = XLSX.utils.book_new();

            // clone print area
            const clone = $('#printArea').clone();

            // OPTIONAL: clean unwanted elements
            clone.find('script, style, img, button, input').remove();

            // wrap inside a temporary container
            const temp = $('<div>').append(clone);

            // convert HTML → worksheet
            const ws = XLSX.utils.table_to_sheet(temp[0]);

            XLSX.utils.book_append_sheet(wb, ws, 'Kagawad-Report');

            XLSX.writeFile(wb, 'Kagawad-Report.xlsx');
        });
    });
</script>
