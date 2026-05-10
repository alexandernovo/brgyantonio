<script>
    $(document).on('submit', '.logins-form', function(e) {
        e.preventDefault();
        let type = $(this).attr("data-type");
        $('.errorLogin').addClass('d-none').text('');

        $.ajax({
            type: 'POST',
            url: '{{ route('login') }}',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {
                    if (type == "secretary") {
                        window.location = "{{ route('secretary_dashboard') }}";
                    }
                    console.log("success");
                } else {
                    $('.errorLogin').removeClass('d-none').text(response.message);
                }
            },
            error: function(xhr) {
                $('.errorLogin').removeClass('d-none').text(
                    xhr.responseJSON?.message ?? 'An unexpected error occurred.'
                );
            }
        });
    });

    $(document).on("click", ".user-role-box", function() {
        $(".errorLogin").addClass('d-none');
    })
</script>
