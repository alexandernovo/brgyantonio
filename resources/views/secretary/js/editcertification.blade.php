<script>
    $(document).ready(function() {

        var lastFocusedEditor = '#description'; // default

        function initEditor(id, height, width = null) {
            var editor = $(id);

            editor.summernote({
                height: height,
                width: width,
                dialogsInBody: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'superscript']],
                    ['view', ['fullscreen']]
                ],
                callbacks: {
                    onInit: function() {
                        // Save cursor position and track focus
                        editor.on('summernote.keyup summernote.mouseup focus', function() {
                            editor.summernote('saveRange');
                            lastFocusedEditor = id; // mark this editor as last focused
                        });
                    }
                }
            });
        }

        initEditor('#description', 790);
        // initEditor('#signatory', 100, 350);
        // initEditor('#approved', 100, 350);
        // initEditor('#ornodescription', 90, 350);

        // Insert badge at the last focused editor
        $('.badge-choice').on('click', function() {
            var badgeText = $(this).data('badge');
            console.log(badgeText);
            let tags = badgeText.toLowerCase().includes("owner") ? "strong" : 'span';
            var type = badgeText.toLowerCase().includes("owner") ? "text-uppercase" : '';
            var html =
                `<${tags} class="highlight-bg-cert ${type}" contenteditable="false">${badgeText}</${tags}>`;

            // Restore cursor of last focused editor
            $(lastFocusedEditor).summernote('restoreRange');

            // Insert badge at cursor
            $(lastFocusedEditor).summernote('pasteHTML', html);

            // Focus editor after inserting
            $(lastFocusedEditor).summernote('focus');
        });

    });

    $(document).on("submit", "#form_certification", function(e) {
        e.preventDefault();

        let formData = {};
        $(this).serializeArray().forEach(function(field) {
            formData[field.name] = field.value;
        });

        postRequest("", formData, (response) => {
            if (response.status == "success") {
                Swal.fire({
                    title: "Success",
                    text: "Certification Updated Successfully",
                    icon: "success",
                    showCancelButton: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            }
        });
    });
</script>
