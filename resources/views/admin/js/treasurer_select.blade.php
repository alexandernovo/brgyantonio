<script>
    $(document).on("click", ".btn-submit-collection", function() {

        console.log("clicked");

        let collection_type = $('#collection_type').val();
        let route = "";
        if (!collection_type) {
            Swal.fire({
                title: "Warning",
                text: "Please Select Nature of Collection!",
                icon: "warning",
                showCancelButton: false,
            })

            return;
        }

        if (collection_type == 'Barangay Clearance') {
            route = "{{ route('barangay_clearance') }}";
        }

        if (collection_type == 'Barangay Certification') {
            route = "{{ route('barangay_certification') }}";
        }

        if (collection_type == 'Summon') {
            route = "{{ route('summon') }}";
        }

        if (collection_type == 'Barangay ID') {
            route = "{{ route('barangay_id') }}";
        }

        if (collection_type == 'Barangay Business Clearance') {
            route = "{{ route('business_clearance') }}";
        }

        window.location = route;
    })
</script>
