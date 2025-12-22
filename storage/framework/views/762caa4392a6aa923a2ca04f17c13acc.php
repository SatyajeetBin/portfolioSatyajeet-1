<?php $__env->startSection('title', 'Role Listing'); ?>
<?php $__env->startSection('styles'); ?>
    <style>
        #overlay {
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0px;
            left: 0px;
            z-index: 99999;
            background-color: #000;
            filter: alpha(opacity=75);
            -moz-opacity: 0.75;
            opacity: 0.3;
            border-radius: 10px;
            display: none;
        }

        .dataTables_processing {
            z-index: 99999;
        }

        .addButton {
            color: #fff !important;
            border-color: #fff;
        }

        .addButton:hover {
            color: #f13737 !important;
            background-color: #fff !important;
        }

        .light-style .swal2-container {
            z-index: 99999;
        }

        [type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
            appearance: none;
            height: 10px;
            width: 10px;
            background-image: url('<?php echo e(asset('assets/img/branding/search-close.png')); ?>');
            background-size: 10px 10px;
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: 80px;
        }

        div.dataTables_wrapper div.col-sm-12 {
            padding: 0 !important;
        }

        @media screen and (max-width: 425px) {
            .modal-dialog {
                display: flex;
                align-items: center;
                min-height: calc(100% - var(--bs-modal-margin)* 2);
            }
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between py-2">
            
        <?php
            $chk = \App\Models\Permission::checkCRUDPermissionToUser('Role', 'create');
            echo '<div class="card-header d-flex align-items-center justify-content-between ' .
                ($chk == true ? ' py-2' : ' py-3') .
                '">';
            echo '<h5 class="card-title m-0 me-2 text-secondary">Roles</h5>';
            if ($chk) {
            }
            echo '</div>';
            echo '<a href="' .
                route('role.create') .
                '" class="btn btn-primary waves-effect waves-light addButton">Add Role</a>';
        ?>
        </div>
        <?php if(session('message')): ?>
            <div class="alert alert-<?php echo e(session('status')); ?> alert-dismissible fade show mb-0 mt-3" role="alert">
                <strong><?php echo e(session('message')); ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table table-striped" id="role_table">
                    <div id="overlay"></div>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Action</th>
                            <th>Sr. No.</th>
                            <th>Name</th>
                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script type="text/javascript">
        $(document).ready(function() {

            fill_datatable();

            $("#overlay").show();

            function fill_datatable(name = '', id = '', created_at = '') {
                var dataTable = $('#role_table').DataTable({
                    searching: true,
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    lengthMenu: [10, 25, 50, 100, 1000, 10000],
                    ajax: {
                        url: "<?php echo e(route('role.index')); ?>",
                    },
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'DT_RowIndex',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        /* {
                            data: 'created_at',
                            name: 'created_at'
                        }, */
                    ],
                    columnDefs: [{
                        // For Responsive
                        className: 'control',
                        orderable: false,
                        searchable: false,
                        responsivePriority: 1,
                        targets: 0,
                        render: function() {
                            return '';
                        }
                    }, { // Ensure "Action" appears first in mobile
                            targets: 1,
                            responsivePriority: 3
                        },
                        { // Ensure "Name" appears second in mobile
                            targets: 3,
                            responsivePriority: 2
                        },
                        { // Reduce priority for other columns (they appear after Action & Name in mobile)
                            targets: [0, 2, 3],
                            responsivePriority: 99
                        }],
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data();
                                    return 'Details of ' + data['name'];
                                }
                            }),
                            type: 'column',
                            renderer: function(api, rowIdx, columns) {
                                var data = $.map(columns, function(col, i) {
                                    return col.title !==
                                        '' // ? Do not show row in modal popup if title is blank (for check box)
                                        ?
                                        '<tr data-dt-row="' +
                                        col.rowIndex +
                                        '" data-dt-column="' +
                                        col.columnIndex +
                                        '">' +
                                        '<td>' +
                                        col.title +
                                        ':' +
                                        '</td> ' +
                                        '<td>' +
                                        col.data +
                                        '</td>' +
                                        '</tr>' :
                                        '';
                                }).join('');

                                return data ? $('<table class="table"/><tbody />').append(data) : false;
                            }
                        }
                    },
                    fnInitComplete: function() {
                        $("#overlay").hide();
                    },
                });

                let debounceTimer;
                $(".dataTables_filter input").off('input keyup').on("keyup", function(e) {
                    var searchTerm = this.value;
                    clearTimeout(debounceTimer);

                    if (searchTerm === "") {
                        dataTable.search("").draw();
                    } else {
                        debounceTimer = setTimeout(function() {
                            dataTable.search(searchTerm).draw();
                        }, 500);
                    }
                });
            }

            setTimeout(function() {
                $('.alert').fadeOut('fast');
            }, 3000);

        });

        function deleteRole(id, name) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete " + name + ".",
                icon: 'warning',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, Please!',
                customClass: {
                    confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
                    cancelButton: 'btn btn-outline-secondary waves-effect'
                },
                buttonsStyling: false
            }).then(function(result) {

                if (result.value) {
                    $.ajax({
                        url: 'role/delete/' + id,
                        type: "get"
                    }).done(function(data) {
                        if (!data.status) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cancelled!',
                                text: data.message,
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect'
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: data.message,
                                customClass: {
                                    confirmButton: 'btn btn-primary waves-effect'
                                }
                            });
                            $('#role_table').DataTable().ajax.reload();
                        }
                    }).fail(function(jqXHR, ajaxOptions, thrownError) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Cancelled!',
                            text: 'Something wrong.',
                            customClass: {
                                confirmButton: 'btn btn-primary waves-effect'
                            }
                        });
                    })
                } else {
                    Swal.fire({
                        title: 'Cancelled!',
                        text: 'Record is safe',
                        icon: 'error',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\foodcalorie\resources\views/role/index.blade.php ENDPATH**/ ?>