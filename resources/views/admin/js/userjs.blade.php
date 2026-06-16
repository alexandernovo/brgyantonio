<script>
    // Global variables for certification filtering
    let dateFromUser = '';
    let dateToUser = '';
    let selectedLetterNrgy = '';
    let tableUser = null;
    let selectedUserRow = null;
    let selectedUserId = null;
    let userData = [];

    userTableOptions = {
        processing: true,
        serverSide: false,
        ajax: {
            url: "{{ route('get_users') }}",
            type: 'POST',
            dataType: 'json',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.dateFrom = dateFromUser;
                d.dateTo = dateToUser;
                d.type = "User";
                d.letter = selectedLetterNrgy;
            },
            dataSrc: function(json) {
                userData = json.data;
                return json.data;
            }
        },

        columns: [{
                title: 'NO.',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row, meta) =>
                    meta.row + meta.settings._iDisplayStart + 1
            },
            {
                title: 'NAME',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'name'
            },

            {
                title: 'USERNAME',
                className: 'text-nowrap p-2 text-center align-middle',
                data: 'username'
            },

            {
                title: 'USER-ROLE',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {
                    return row.type;
                }
            },

            {
                title: 'DATE CREATED',
                className: 'text-nowrap p-2 text-center align-middle',
                render: (data, type, row) => {
                    return row.created_at ? formatDateTime(row.created_at) : '';
                }
            },
            {
                title: 'ACTION',
                className: 'text-nowrap p-2 text-center align-middle sticky-action',
                render: function(data, type, row) {
                    return `
                    <div class="d-flex gap-1 justify-content-center">

                        <button class="btn btn-warning btn-sm editButton px-2"
                            style="background-color: #B35100 !important"
                            data-id="${row.id}">

                            <i style="font-size: 15px"
                                class="bi bi-pencil-fill"></i>

                        </button>

                        <button class="btn btn-danger btn-sm deleteButton px-2"
                            style="background-color: #A10101 !important"
                            data-id="${row.id}">

                            <i style="font-size: 15px"
                                class="bi bi-trash3-fill"></i>

                        </button>

                    </div>
                `;
                }
            },
        ],

        initComplete: function(settings, json) {}
    };

    function rendertableUser() {
        if (tableUser) {
            tableUser.destroy();
        }

        tableUser = new DataTable('#tableUser', userTableOptions)
    }

    $(document).ready(function() {
        rendertableUser();
    })

    $(document).on("click", "#addUser", function() {
        $(".updateWarning").addClass("d-none");
        $("#userForm")[0].reset();
        $(".login-btn").html(`
            <i class="bi bi-person-plus-fill me-1"></i>
            Add User
        `);
        $("#userForm")
            .find('input[type="hidden"]')
            .not('[name="_token"]')
            .val('');

        $("#userModal").modal("show");
    })

    $(document).ready(function() {
        $('#image_path').on('change', function() {
            // Get the file name from the path
            var fileName = $(this).val().split('\\').pop();

            // Update the display input; default to 'No file chosen' if empty
            if (fileName) {
                $('#image_filename_display').val(fileName);
            } else {
                $('#image_filename_display').val('No file chosen');
            }
        });
    });

    $(document).on('click', 'table.dataTable tbody tr', function() {

        const rowData = tableUser.row(this).data();

        // unselect
        if ($(this).hasClass('selected-row')) {

            $(this).removeClass('selected-row');

            selectedUserRow = null;
            selectedUserId = null;

            return;
        }

        $('table.dataTable tbody tr').removeClass('selected-row');

        $(this).addClass('selected-row');

        selectedUserRow = rowData;
        selectedUserId = rowData.id;
    });

    $(document).on('click', '#editUser', function() {

        if (!selectedUserRow) {

            Swal.fire({
                icon: 'warning',
                title: 'No Selected Row',
                text: 'Please select a record first.',
                confirmButtonColor: '#1A412F'
            });

            return;
        }
    });


    $(document).on('submit', '#userForm', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('storeUser') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == "success") {
                    Swal.fire({
                        title: "Success",
                        text: "User Successfully!",
                        icon: "success",
                        showCancelButton: false,
                    })

                    $('#userModal').modal('hide');
                    $('#userForm')[0].reset();
                    reloadUserTable();

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message
                    });

                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                console.log(errors);
                alert("Something went wrong. Please check the console.");
            }
        });
    });

    function reloadUserTable() {
        if (tableUser) {
            tableUser.ajax.reload(null, false);
        } else {
            rendertableUser();
        }
    }

    $(document).on("click", ".editButton", function(e) {
        e.stopPropagation();

        $(".login-btn").html(`
            <i class="bi bi-person-plus-fill me-1"></i>
            Edit User
        `);

        $(".updateWarning").removeClass("d-none");
        let id = $(this).attr("data-id");
        let find_data = userData.find(x => x.id == id);
        if (find_data) {
            $("#userForm")[0].reset();

            $("#userForm")
                .find('input[type="hidden"]')
                .not('[name="_token"]')
                .not('[name="certification_type"]')
                .val('');

            populateUserForm('userForm', find_data);

            $("#userModal").modal("show");
        }
    })

    userTableOptions.drawCallback = function() {

        if (!selectedUserId) return;

        const api = this.api();

        api.rows().every(function() {

            let data = this.data();

            if (data.id == selectedUserId) {

                $(this.node()).addClass('selected-row');

                selectedUserRow = data;

            } else {

                $(this.node()).removeClass('selected-row');

            }

        });

    };

    $(document).on("click", ".deleteButton", function(e) {
        e.stopPropagation();

        let id = $(this).attr("data-id");

        Swal.fire({
            icon: "warning",
            title: "Delete User?",
            text: "This action cannot be undone.",
            showCancelButton: true,
            confirmButtonColor: "#A10101",
            cancelButtonColor: "#1A212B",
            confirmButtonText: "Yes, delete it"
        }).then((result) => {

            if (!result.isConfirmed) return;

            $.ajax({
                url: "{{ route('deleteUser') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(response) {

                    Swal.fire({
                        icon: "success",
                        title: "Deleted Successfully",
                        text: response.message
                    });

                    // clear selection if deleted row is selected
                    if (selectedUserId == id) {
                        selectedUserId = null;
                        selectedUserRow = null;
                    }

                    reloadUserTable();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);

                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Failed to delete record"
                    });
                }
            });

        });
    });

    function populateUserForm(formId, data) {

        const form = $(`#${formId}`);

        $.each(data, function(key, value) {

            let field = form.find(`[name="${key}"]`);

            if (!field.length) return true;

            const fieldType = field.attr('type');
            const tag = field.prop("tagName")?.toLowerCase();

            // ❌ skip file inputs
            if (fieldType === 'file') {
                return true;
            }

            // ✅ RADIO
            if (fieldType === 'radio') {
                field.filter(`[value="${value}"]`).prop('checked', true);
            }

            // ✅ CHECKBOX
            else if (fieldType === 'checkbox') {
                field.prop('checked', value == 1);
            }

            // ✅ SELECT (FIX ADDED HERE)
            else if (tag === 'select') {

                field.find('option').each(function() {

                    if ($(this).val() == value) {
                        $(this).attr('selected', 'selected');
                    } else {
                        $(this).removeAttr('selected');
                    }

                });

                field.val(value); // ensure UI value
                field.trigger('change');
            }

            // ✅ DATE / DATETIME
            else if ((fieldType === 'date' || fieldType === 'datetime-local') && value) {

                const dateObj = new Date(value);

                if (!isNaN(dateObj.getTime())) {

                    const pad = (num) => String(num).padStart(2, '0');

                    const year = dateObj.getFullYear();
                    const month = pad(dateObj.getMonth() + 1);
                    const day = pad(dateObj.getDate());

                    if (fieldType === 'date') {
                        field.val(`${year}-${month}-${day}`).trigger('change');
                    } else {
                        const hours = pad(dateObj.getHours());
                        const minutes = pad(dateObj.getMinutes());

                        field.val(`${year}-${month}-${day}T${hours}:${minutes}`).trigger('change');
                    }
                } else {
                    field.val(value).trigger('change');
                }
            }

            // ✅ DEFAULT INPUTS
            else {
                field.val(value).trigger('change');
            }
        });
    }
</script>
