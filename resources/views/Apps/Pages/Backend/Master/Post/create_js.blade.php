<script>
    var Ajax = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('view js successfully load', 'success', {timeOut: 2000});
                //var table = $('#datatable_ajax').DataTable({
                //    "lengthMenu": [[10, 25, 50], [10, 25, 50]],
                //    "sPaginationType": "bootstrap",
                //    "paging": true,
                //    "pagingType": "full_numbers",
                //    "ordering": false,
                //    "serverSide": true,
                //    "processing": true,
                //    "language": {
                //        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                //    },
                //    "ajax": {
                //        url: _config_base_url + '/location/country/get-list',
                //        type: 'POST'
                //    },
                //    "columns": [
                //        {"data": "rowcheck"},
                //        {"data": "num"},
                //        {"data": "name"},
                //        {"data": "active"},
                //        {"data": "description"}
                //    ],
                //    "drawCallback": function (master) {
                //        $('.make-switch').bootstrapSwitch();
                //    }
                //});
                //
                //$('#datatable_ajax').on('switchChange.bootstrapSwitch', 'input[name="status"]', function (event, state) {
                //    bootbox.confirm("Are you sure?", function (result) {
                //        var id = $(this).attr('data-id');
                //        var formdata = {
                //            id: Base64.encode(id),
                //            active: state
                //        };
                //        $.ajax({
                //            url: _config_base_url + '/location/country/update-status',
                //            method: "POST", //First change type to method here
                //            data: formdata,
                //            success: function (response) {
                //                toastr.success('Successfully ' + response);
                //                return false;
                //            },
                //            error: function () {
                //                toastr.error('Failed ' + response);
                //                return false;
                //            }
                //        });
                //    });
                //});

                $('a.btn').on('click', function () {
                    var action = $(this).attr('data-id');
                    var count = $('input.select_tr:checkbox').filter(':checked').length;
                    switch (action) {
                        case 'add':
                            $('.modal-title').html('Insert New Group');
                            break;

                        case 'edit':
                            App.startPageLoading();
                            $('.modal-title').html('Update Exist Group');
                            var status_ = $(this).hasClass('disabled');
                            var id = $('input.select_tr:checkbox:checked').attr('data-id');
                            if (status_ == 0) {
                                var formdata = {
                                    id: Base64.encode(id)
                                };
                                $.ajax({
                                    url: _config_base_url + '/location/country/get-data',
                                    method: "POST", //First change type to method here
                                    data: formdata,
                                    success: function (response) {
                                        var row = JSON.parse(response);
                                        var status_ = false;
                                        if (row.is_active == 1) {
                                            status_ = true;
                                        }
                                        $('input[name="id"]').val(row.id);
                                        $('input[name="name"]').val(row.name);
                                        $("[name='status']").bootstrapSwitch('state', status_);
                                        $('textarea[name="description"]').val(row.description);
                                        $('#modal_add_edit').modal('show');
                                        App.stopPageLoading();
                                    },
                                    error: function () {
                                        App.stopPageLoading();
                                        fnToStr('Error is occured, please contact administrator.', 'error');
                                    }
                                });
                                return false;
                            }
                            break;

                        case 'remove':
                            bootbox.confirm("Are you sure to remove this id?", function (result) {
                                if (result == true) {
                                    var uri = _config_base_url + '/location/country/remove';
                                    if (count > 1) {
                                        var ids = [];
                                        $("input.select_tr:checkbox:checked").each(function () {
                                            ids.push($(this).data("id"));
                                        });
                                    } else {
                                        var ids = $('input.select_tr:checkbox:checked').attr('data-id');
                                    }
                                    fnActionId(uri, ids, 'remove');
                                    fnRefreshDataTable();
                                    fnResetBtn();
                                } else {
                                    fnToStr('You re cancelling remove this id', 'info');
                                    fnRefreshDataTable();
                                    fnResetBtn();
                                }
                            });
                            break;

                        case 'delete':
                            bootbox.confirm("Are you sure to delete this id?", function (result) {
                                if (result == true) {
                                    var uri = _config_base_url + '/location/country/delete';
                                    if (count > 1) {
                                        id = [];
                                        $("input.select_tr:checkbox:checked").each(function () {
                                            id.push($(this).data("id"));
                                        });
                                    }
                                    fnActionId(uri, id, 'remove');
                                    fnRefreshDataTable();
                                    fnResetBtn();
                                } else {
                                    fnToStr('You re cancelling delete this id', 'info');
                                    fnRefreshDataTable();
                                    fnResetBtn();
                                }
                            });
                            break;

                        case 'refresh':
                            fnRefreshDataTable();
                            break;
                    }
                });

                $("#add_edit").submit(function () {
                    var id = $('input[name="id"]').val();
                    var is_active = $("[name='status']").bootstrapSwitch('state');
                    var uri = _config_base_url + '/location/country/insert';
                    var txt = 'add new group';
                    var formdata = {
                        name: $('input[name="name"]').val(),
                        description: $('textarea[name="description"]').val(),
                        active: is_active
                    };
                    if (id)
                    {
                        uri = _config_base_url + '/location/country/update';
                        txt = 'update group';
                        formdata = {
                            id: Base64.encode(id),
                            name: $('input[name="name"]').val(),
                            description: $('textarea[name="description"]').val(),
                            active: is_active
                        };
                    }
                    $.ajax({
                        url: uri,
                        method: "POST", //First change type to method here
                        data: formdata,
                        success: function (response) {
                            toastr.success('Successfully ' + txt);
                            fnCloseModal();
                        },
                        error: function () {
                            toastr.error('Failed ' + txt);
                            fnCloseModal();
                        }
                    });
                    return false;
                });
            }
        };

    }();

    jQuery(document).ready(function () {
        Ajax.init();
    });

</script>