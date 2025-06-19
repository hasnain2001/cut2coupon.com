<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- App CSS -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">

    <!-- Icons CSS -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">

    <!-- jQuery UI CSS for sortable -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.min.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @yield('styles')
</head>

<body>
    <div id="wrapper">
        @include('employee.layouts.left-menu')

        <div class="content-page">
            @include('employee.layouts.navigation')

            <main class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- jQuery and jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>


<!-- Required datatable js -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.4/r-2.3.0/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.4/r-2.3.0/datatables.min.js"></script>

<!-- Sortable JS -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#couponsTable').DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-light btn-sm',
                    text: '<i class="fas fa-file-excel me-1"></i> Excel',
                    title: 'Coupons List',
                    exportOptions: {
                        columns: [1, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-light btn-sm',
                    text: '<i class="fas fa-file-pdf me-1"></i> PDF',
                    title: 'Coupons List',
                    exportOptions: {
                        columns: [1, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'print',
                    className: 'btn btn-light btn-sm',
                    text: '<i class="fas fa-print me-1"></i> Print',
                    title: 'Coupons List',
                    exportOptions: {
                        columns: [1, 3, 4, 5, 6, 7, 8, 9]
                    }
                }
            ],
            columnDefs: [
                { orderable: false, targets: [0, 2, 10] },
                { searchable: false, targets: [0, 1, 2, 5, 6, 10] }
            ],
            order: [[1, 'asc']],
            pageLength: 25,
            language: {
                paginate: {
                    previous: "<i class='fas fa-chevron-left'></i>",
                    next: "<i class='fas fa-chevron-right'></i>"
                }
            },
            initComplete: function() {
                $('.dataTables_filter input').addClass('form-control-sm');
                $('.dataTables_length select').addClass('form-select-sm');
            }
        });

        // Select all checkboxes
        $('#selectAll').click(function() {
            $('.select-checkbox').prop('checked', this.checked);
            table.rows().nodes().to$().find('.select-checkbox').prop('checked', this.checked);
        });

        // Delete selected button click
        $('#deleteSelected').click(function(e) {
            e.preventDefault();
            var selected = table.rows().nodes().to$().find('.select-checkbox:checked').length;

            if (selected > 0) {
                if (confirm('Are you sure you want to delete the selected ' + selected + ' coupon(s)?')) {
                    $('#deleteSelectedForm').submit();
                }
            } else {
                alert('Please select at least one coupon to delete.');
            }
        });

        // Initialize tooltips
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Make table rows sortable
        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

    function sendOrderToServer() {
        var order = [];
        var token = '{{ csrf_token() }}';

        $('#tablecontents tr').each(function (index, element) {
            order.push({
                id: $(this).data("id"),
                position: index + 1
            });
        });

        $.ajax({
            url: "{{ route('employee.coupon.update-order') }}",
            method: "POST",
            data: {
                order: order,
                _token: token
            },
            success: function (response) {
                if (response.status === "success") {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (xhr) {
                toastr.error("Error while updating order.");
                console.error(xhr.responseText);
            }
        });
    }
    });
</script>

<script>
    $(document).ready(function() {
        $('#searchInput').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '{{ route("employee.search") }}',
                    dataType: 'json',
                    data: { query: request.term
                    },
                    success: function(data) {
                        response(data.stores); // Ensure `data.stores` is an array of strings or objects
                    }
                });
            },
            minLength: 1 // Minimum characters to trigger autocomplete
        });
    });
      </script>

    @yield('scripts')
</body>
</html>
