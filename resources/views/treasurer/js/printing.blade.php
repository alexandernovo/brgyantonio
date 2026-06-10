<script>
    $(document).on('click', '#btnPrint', function() {

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
            <title>Collection</title>

            <link rel="stylesheet" href="{{ asset('template_assets/css/styles.min.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/css/style2.css') }}">
            <link rel="stylesheet" href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}">

            <style>
                @page {
                    size: A4;
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
</script>
