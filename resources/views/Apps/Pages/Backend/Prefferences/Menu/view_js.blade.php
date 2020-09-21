<script>
    var fnInitTree = function (show, data) {
        var formdata = {};
        if (show === false) {
            formdata = {
                token: _token,
                module_id: $('#navmenu li.active a').attr('data-module_id'),
                logged: 1,
                module_name: $('#navmenu li.active a').attr('data-module_name')
            };
        } else {
            formdata = data;
        }
        var uri = _config_api_base_url + '/fetch/menu';
        var type = 'GET';
        var response = fnAjaxSend(formdata, uri, type, {}, false);
        if (response.responseJSON.status === 200 && response.responseJSON.data) {
            var resData = response.responseJSON.data;
            var el = '#tree_' + formdata.module_id;
            $(el).treeview({
                data: resData,
                showTags: true,
                showCheckbox: true,
                highlightSelected: false,
                onNodeChecked: function (event, data) {
                    console.log('checked');
                    console.log(data);
                    var lv = $('input[name="identifier"]').val(2);
                    $('#submit_add_edit').html('Add');
                    $('#modal_add_edit').attr('data-id', data.id);
                    $('#modal_add_edit').attr('data-module_id', data.module_id);
                    $('#modal_add_edit').attr('data-nodeId', data.nodeId);
                    $('#modal_add_edit').attr('data-level', data.level);

                    $('#modal_add_edit').attr('data-is_active', data.is_active);
                    $('#modal_add_edit').attr('data-is_logged_in', data.is_logged_in);

                    $('input[name="frm_add_edit_parent_id"]').val(data.parent_id);
                    $('input[name="frm_add_edit_module_id"]').val(data.module_id);
                    $('input[name="frm_add_edit_level"]').val(data.level);

                    var str = fnGenerateForm(data, 'view');
                    var li = $('a.aTab').attr('href');
                    $(li).html(str);
                    $(el).treeview('unselectNode', [data.nodeId, {silent: true}]);
                    if (data.parent_id === 0) {
                        $('a.cl-2').hide();
                        $('a.cl-3').hide();
                        $('a.cl-4').hide();
                    }
                    $('#modal_add_edit').modal('show');
                },
                onNodeUnchecked: function (event, data) {
                    console.log('unchecked');
                    $('.actions').fadeOut('slow');
                    $(el).treeview('unselectNode', [data.nodeId, {silent: true}]);
                }
            });
        }
    };

    var fnGenerateForm = function (data, el) {
        if (data.id) {
            $('input[name="frm_add_edit_id"]').val(data.id);
        }
        var frm_add_edit_status = '0';
        var frm_add_edit_logged = '0';
        var frm_add_edit_cms = '0';
        var frm_add_edit_open = '0';
        var frm_add_edit_badge = '0';
        if (data) {
            frm_add_edit_status = (data.is_active === 1) ? 'checked' : '';
            frm_add_edit_logged = (data.is_logged_in === 1) ? 'checked' : '';
            frm_add_edit_cms = (data.is_cms === 1) ? 'checked' : '';
            frm_add_edit_open = (data.is_open === 1) ? 'checked' : '';
            frm_add_edit_badge = (data.is_badge === 1) ? 'checked' : '';
        }
        var str = '<div class="row">';
        str = str + '    <div class="col-md-5">';
        str = str + '        <div class="form-group">';
        str = str + '            <label class="control-label">Module Name</label>';
        str = str + '            <div class="input-icon right">';
        str = str + '                <i class="fa fa-info-circle tooltips" data-container="body"></i>';
        str = str + '                <input class="form-control" type="text" name="frm_' + el + '_module_name" value="' + data.module_name + '" readonly />';
        str = str + '            </div>';
        str = str + '        </div>';
        str = str + '        <div class="form-group">';
        str = str + '            <label class="control-label">Parent Name</label>';
        str = str + '            <div class="input-icon right">';
        str = str + '                <i class="fa fa-info-circle tooltips" data-container="body"></i>';
        str = str + '                <input class="form-control" type="text" name="frm_' + el + '_parent_name" value="' + data.parent_name + '" readonly /> ';
        str = str + '            </div>';
        str = str + '        </div>';
        str = str + '        <div class="form-group">';
        str = str + '            <label class="control-label">Node Name</label>';
        str = str + '            <div class="input-icon right">';
        str = str + '                <i class="fa fa-info-circle tooltips" data-container="body"></i>';
        str = str + '                <input class="form-control" type="text" name="frm_' + el + '_name" value="' + data.text + '"  /> ';
        str = str + '            </div>';
        str = str + '         </div>';
        str = str + '        <div class="form-group">';
        str = str + '            <label class="control-label">Node Path</label>';
        str = str + '            <div class="input-icon right">';
        str = str + '                <i class="fa fa-info-circle tooltips"data-container="body"></i>';
        str = str + '                <input class="form-control" type="text" name="frm_' + el + '_path" value="' + data.href + '"  /> ';
        str = str + '            </div>';
        str = str + '        </div>';
        str = str + '        <div class="form-group">';
        str = str + '            <label class="control-label">Node Rank</label>';
        str = str + '            <div class="input-icon right">';
        str = str + '                <i class="fa fa-info-circle tooltips"data-container="body"></i>';
        str = str + '                <input class="form-control" type="text" name="frm_' + el + '_rank" value="' + data.rank + '"  /> ';
        str = str + '            </div>';
        str = str + '        </div>';
        str = str + '    </div>';
        str = str + '    <div class="col-md-7">	';
        str = str + '        <div class="form-group">';
        str = str + '            <label>Icon</label>';
        str = str + '            <select class="form-control" name="frm_' + el + '_icon" id="icon_' + el + '" >';
        str = str + '                <option>' + data.icon + '</option>';
        str = str + '            </select>';
        str = str + '        </div>';
        str = str + '        <div class="form-group">';
        str = str + '            <label>Description</label>';
        str = str + '            <textarea class="form-control" rows="3" name="frm_' + el + '_description" >' + data.desc + '</textarea>';
        str = str + '        </div>';
        str = str + '        <div class="col-md-6">';
        str = str + '            <div class="form-group" style="height:30px">';
        str = str + '                <label>Active</label><br/>';
        str = str + '                <input type="checkbox" class="make-switch" data-size="small" name="frm_' + el + '_status"' + frm_add_edit_status + '  />';
        str = str + '            </div>';
        str = str + '            <br/>';
        str = str + '            <div class="form-group" style="height:30px">';
        str = str + '                <label>Is Logged In</label><br/>';
        str = str + '                <input type="checkbox" class="make-switch" data-size="small" name="frm_' + el + '_logged"' + frm_add_edit_logged + ' />';
        str = str + '            </div>';
        str = str + '            <br/>';
        str = str + '            <div class="form-group" style="height:30px">';
        str = str + '                <label>Is CMS</label><br/>';
        str = str + '                <input type="checkbox" class="make-switch" data-size="small" name="frm_' + el + '_cms"' + frm_add_edit_cms + ' />';
        str = str + '            </div>';
        str = str + '        </div>';
        str = str + '        <div class="col-md-6">';
        str = str + '            <div class="form-group" style="height:30px">';
        str = str + '                <label>Is Open</label><br/>';
        str = str + '                <input type="checkbox" class="make-switch" data-size="small" name="frm_' + el + '_open"' + frm_add_edit_open + ' />';
        str = str + '            </div>';
        str = str + '            <br/>';
        str = str + '            <div class="form-group" style="height:30px">';
        str = str + '                <label>Is Badge</label><br/>';
        str = str + '                <input type="checkbox" class="make-switch" data-size="small" name="frm_' + el + '_badge"' + frm_add_edit_badge + ' />';
        str = str + '            </div>';
        str = str + '        </div>';
        str = str + '    </div>';
        str = str + '</div>';
        return str;
    };

    var fnGetIcons = function () {
        var uri = _config_api_base_url + '/fetch/icon';
        var type = 'GET';
        var formdata = {token: _token};
        var response = fnAjaxSend(formdata, uri, type, {}, false);
        var data = response.responseJSON.data;
        var str = '<select>';
        for (var i = 0; i < data.length; i++) {
            str = str + '<option value="' + data[i].id + '">' + data[i].name + '</option>';
        }
        str = str + '</select>';

        return str;
    };

    var fnActionView = function (type, href) {
        var id = $('#modal_add_edit').attr('data-id');
        var module_name = $('#navmenu li.active a').attr('data-module_name');
        var uri = _config_api_base_url + '/fetch/menu/first';
        var type = 'GET';
        var formdata = {
            token: _token,
            id: Base64.encode(id),
        };
        var response = fnAjaxSend(formdata, uri, type, {}, false);
        if (response.responseJSON.status === 200 && response.responseJSON.data) {
            var resData = response.responseJSON.data;
            console.log(resData);
            var status_ = false;
            if (resData.is_active === 1) {
                status_ = true;
            }
            var logged = false;
            if (resData.is_logged_in === 1) {
                logged = true;
            }
            var cms = false;
            if (resData.is_active === 1) {
                cms = true;
            }
            var open = false;
            if (resData.is_logged_in === 1) {
                open = true;
            }
            var badge = false;
            if (resData.is_logged_in === 1) {
                badge = true;
            }
            var str = fnGenerateForm(resData, 'view');
            $(href).html(str);
            $('input[name="frm_view_parent_id"]').val(resData.parent_id);
            $('input[name="frm_view_parent_name"]').val(resData.parent_name);
            $('input[name="frm_view_module_id"]').val(resData.module_id);
            $('input[name="frm_view_module_name"]').val(module_name);
            $('input[name="frm_view_level"]').val(resData.level);
            $('input[name="frm_view_name"]').val(resData.name);
            $('input[name="frm_view_path"]').val(resData.path);
            $('input[name="frm_view_rank"]').val(resData.rank);
            $('textarea[name="frm_view_description"]').val(resData.description);
            $('#icon').val(resData.icon);
            $("[name='frm_view_status']").bootstrapSwitch('state', status_);
            $("[name='frm_view_logged']").bootstrapSwitch('state', logged);
            $("[name='frm_view_cms']").bootstrapSwitch('state', cms);
            $("[name='frm_view_open']").bootstrapSwitch('state', open);
            $("[name='frm_view_badge']").bootstrapSwitch('state', badge);

        }
    };

    var fnActionAdd = function (type, href) {
        var id = $('#modal_add_edit').attr('data-id');
        var module_id = $('#navmenu li.active a').attr('data-module_id');
        var module_name = $('#navmenu li.active a').attr('data-module_name');
        if (id === '0') {
            var data = {
                module_id: module_id,
                module_name: module_name,
                parent_name: 'root',
                text: '',
                href: '#',
                rank: 1,
                icon: 'fa-contao',
                desc: '-',
                is_active: '0',
                is_logged_in: '0',
                is_cms: '0',
                is_open: '0',
                is_badge: '0'
            };
            var icon = fnGetIcons();
            //assign value into input value
            var str = fnGenerateForm(data, 'add');
            $(href).html(str);

            $('input[name="frm_add_name"]').attr('readonly', false);
            $('input[name="frm_add_path"]').attr('readonly', false);
            $('input[name="frm_add_rank"]').attr('readonly', false);
            $('select#icon_add').attr('readonly', false);
            $('textarea[name="frm_add_description"]').attr('readonly', false);
            $('input[name="frm_add_status"]').removeAttr('readonly');
            $('input[name="frm_add_logged"]').removeAttr('readonly');
            $('input[name="frm_add_cms"]').removeAttr('readonly');
            $('input[name="frm_add_open"]').removeAttr('readonly');
            $('input[name="frm_add_badge"]').removeAttr('readonly');

            $('input[name="frm_add_edit_parent_id"]').val(0);
            $('input[name="frm_add_edit_level"]').val(0);
            $('input[name="frm_add_edit_module_id"]').val(module_id);
            $('input[name="frm_add_parent_name"]').val('root');
            $('input[name="frm_add_module_name"]').val(module_name);
            $('#icon_add').html(icon);
            return false;
        } else {
            var uri = _config_api_base_url + '/fetch/menu/first';
            var type = 'GET';
            var formdata = {
                token: _token,
                id: Base64.encode(id),
            };
            var response = fnAjaxSend(formdata, uri, type, {}, false);

            if (response.responseJSON.status === 200 && response.responseJSON.data) {
                var data = response.responseJSON.data;
                var icon = fnGetIcons();
                //assign value into input value
                var str = fnGenerateForm(data, 'add');

                $(href).html(str);
                var rank = $('input[name="frm_add_rank"]').val();
                $('input[name="frm_add_name"]').attr('readonly', false);
                $('input[name="frm_add_path"]').attr('readonly', false);
                $('input[name="frm_add_rank"]').attr('readonly', false);
                $('select#icon').attr('readonly', false);
                $('textarea[name="frm_add_description"]').attr('readonly', false);
                $('input[name="frm_add_status"]').removeAttr('readonly');
                $('input[name="frm_add_logged"]').removeAttr('readonly');
                $('input[name="frm_add_cms"]').removeAttr('readonly');
                $('input[name="frm_add_open"]').removeAttr('readonly');
                $('input[name="frm_add_badge"]').removeAttr('readonly');

                $('input[name="frm_add_edit_parent_id"]').val(data.id);
                $('input[name="frm_add_edit_level"]').val(data.level);
                $('input[name="frm_add_edit_module_id"]').val(data.module_id);
                $('input[name="frm_add_parent_name"]').val(data.name);
                $('input[name="frm_add_module_name"]').val(module_name);
                $('#icon_add').html(icon);
                $('input[name="frm_add_name"]').val('');
                $('input[name="frm_add_path"]').val('');
                $('input[name="frm_add_rank"]').val('');
                $('textarea[name="frm_add_description"]').val('');
                $("[name='frm_add_status']").bootstrapSwitch('state', false);
                $("[name='frm_add_logged']").bootstrapSwitch('state', false);
                $("[name='frm_add_cms']").bootstrapSwitch('state', false);
                $("[name='frm_add_open']").bootstrapSwitch('state', false);
                $("[name='frm_add_badge']").bootstrapSwitch('state', false);
                return false;
            }
        }
    };

    var fnActioneEdit = function (type, href) {
        var id = $('#modal_add_edit').attr('data-id');
        var module_name = $('#navmenu li.active a').attr('data-module_name');
        var uri = _config_api_base_url + '/fetch/menu/first';
        var type = 'GET';
        var formdata = {
            token: _token,
            id: Base64.encode(id),
        };
        var response = fnAjaxSend(formdata, uri, type, {}, false);
        if (response.responseJSON.status === 200 && response.responseJSON.data) {
            var data = response.responseJSON.data;
            var status = false;
            if (data.is_active === 1) {
                status = true;
            }
            var logged = false;
            if (data.is_logged_in === 1) {
                logged = true;
            }
            var cms = false;
            if (data.is_cms === 1) {
                cms = true;
            }
            var open = false;
            if (data.is_open === 1) {
                open = true;
            }
            var badge = false;
            if (data.is_badge === 1) {
                badge = true;
            }
            var str = fnGenerateForm(data, 'edit');
            $(href).html(str);
            $('input[name="frm_add_edit_id"]').val(data.id);
            $('input[name="frm_add_edit_parent_id"]').val(data.parent_id);
            $('input[name="frm_add_edit_level"]').val(data.level);
            $('input[name="frm_add_edit_module_id"]').val(data.module_id);
            $('input[name="frm_edit_parent_name"]').val(data.parent_name);
            $('input[name="frm_edit_module_name"]').val(module_name);
            $('input[name="frm_edit_name"]').val(data.name);
            $('input[name="frm_edit_path"]').val(data.path);
            $('input[name="frm_edit_rank"]').val(data.rank);
            $('textarea[name="frm_edit_description"]').val(data.description);
            $('#icon_edit').val(data.icon);

            $('input[name="frm_edit_name"]').attr('readonly', false);
            $('input[name="frm_edit_path"]').attr('readonly', false);
            $('select#icon').attr('readonly', false);
            $('textarea[name="frm_edit_description"]').attr('readonly', false);

            $('input[name="frm_edit_status"]').removeAttr('readonly');
            $('input[name="frm_edit_logged"]').removeAttr('readonly');
            $('input[name="frm_edit_cms"]').removeAttr('readonly');
            $('input[name="frm_edit_open"]').removeAttr('readonly');
            $('input[name="frm_edit_badge"]').removeAttr('readonly');
            $('#submit').removeAttr('disabled');

            $("input[name='frm_edit_status']").bootstrapSwitch('state', status);
            $("input[name='frm_edit_logged']").bootstrapSwitch('state', logged);
            $("input[name='frm_edit_cms']").bootstrapSwitch('state', cms);
            $("input[name='frm_edit_open']").bootstrapSwitch('state', open);
            $("input[name='frm_edit_badge']").bootstrapSwitch('state', badge);
            return false;
        }
    };

    var Index = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnInitTree(false);

                $('a').on('click', function () {
                    if ($(this).attr('data-type') === 'tab') {
                        var href = $(this).attr('href');
                        var module_id = $(this).attr('data-module_id');
                        var module_name = $(this).attr('data-module_name');
                        var data = {
                            token: _token,
                            module_id: module_id,
                            logged: 1,
                            module_name: module_name
                        };
                        fnInitTree(true, data);
                    }
                });

                $('#modal_add_edit').on('hidden.bs.modal', function (e) {
                    var identifier = $('input[name="identifier"]').val();
                    var module_id = $(this).attr('data-module_id');
                    var el = '#tree_' + module_id;
                    if (identifier === 1) {
                        var nodeId = $(this).attr('data-nodeId');
                        $(el).treeview('unselectNode', [nodeId, {silent: true}]);
                    } else {
                        $(el).treeview('uncheckAll', {silent: true});
                    }
                    $('form#step1').fadeIn('slow');
                });


                $('a.aTab').on('click', function () {
                    var type = $(this).attr('data-type');
                    var href = $(this).attr('href');
                    console.log('button is click');
                    console.log(href);
                    if (type) {
                        switch (type) {
                            case 'view':
                                $('button#submit').attr('disabled', true);
                                fnActionView(type, href);
                                break;
                            case 'add':
                                $('button#submit').removeAttr('disabled');
                                fnActionAdd(type, href);
                                break;
                            case 'edit':
                                $('button#submit').removeAttr('disabled');
                                fnActioneEdit(type, href);
                                break;
                            case 'remove':
                                $('button#submit').removeAttr('disabled');
                                fnActionRemove(type, href);
                                break;
                            case 'delete':
                                $('button#submit').removeAttr('disabled');
                                fnActionDelete(type, href);
                                break;
                        }
                    }
                });

                $('form#frm_add_edit').on('submit', function (e) {
                    e.preventDefault();
                    var id = $('input[name="frm_add_edit_id"]').val();
                    var type = 'POST';
                    var uri = '';
                    var module_id = '';
                    var parent_id = '';
                    var parent_level = '';
                    var name = '';
                    var path = '';
                    var rank = '';
                    var icon = '';
                    var description = '';
                    var _status = '';
                    var _logged = '';
                    var _cms = '';
                    var _open = '';
                    var _badge = '';
                    if (id) {
                        uri = _config_api_base_url + '/prefferences/menu/update';
                        module_id = parseInt($('input[name="frm_add_edit_module_id"]').val());
                        parent_id = parseInt($('input[name="frm_add_edit_parent_id"]').val());
                        parent_level = parseInt($('input[name="frm_add_edit_level"]').val());
                        name = $('input[name="frm_view_name"]').val();
                        path = $('input[name="frm_view_path"]').val();
                        rank = $('input[name="frm_view_rank"]').val();
                        icon = $('#icon_view').val();
                        description = $('textarea[name="frm_view_description"]').val();
                        _status = $("input[name='frm_view_status']").bootstrapSwitch('state');
                        _logged = $("input[name='frm_view_logged']").bootstrapSwitch('state');
                        _cms = $("input[name='frm_view_cms']").bootstrapSwitch('state');
                        _open = $("input[name='frm_view_open']").bootstrapSwitch('state');
                        _badge = $("input[name='frm_view_badge']").bootstrapSwitch('state');
                    } else {
                        uri = _config_api_base_url + '/prefferences/menu/insert';
                        module_id = parseInt($('input[name="frm_add_edit_module_id"]').val());
                        parent_id = parseInt($('input[name="frm_add_edit_parent_id"]').val());
                        parent_level = parseInt($('input[name="frm_add_edit_level"]').val());
                        name = $('input[name="frm_view_name"]').val();
                        path = $('input[name="frm_view_path"]').val();
                        rank = $('input[name="frm_view_rank"]').val();
                        icon = $('#icon_view').val();
                        description = $('textarea[name="frm_view_description"]').val();
                        _status = $("input[name='frm_view_status']").bootstrapSwitch('state');
                        _logged = $("input[name='frm_view_logged']").bootstrapSwitch('state');
                        _cms = $("input[name='frm_view_cms']").bootstrapSwitch('state');
                        _open = $("input[name='frm_view_open']").bootstrapSwitch('state');
                        _badge = $("input[name='frm_view_badge']").bootstrapSwitch('state');
                    }
                    var status = 0;
                    if (_status === true) {
                        status = 1;
                    }
                    var logged = 0;
                    if (_logged === true) {
                        logged = 1;
                    }
                    var cms = 0;
                    if (_cms === true) {
                        cms = 1;
                    }
                    var open = 0;
                    if (_open === true) {
                        open = 1;
                    }
                    var badge = 0;
                    if (_badge === true) {
                        badge = 1;
                    }
                    var formdata = {
                        token: _token,
                        id: id,
                        module_id: module_id,
                        parent_id: parent_id,
                        parent_level: parent_level,
                        name: name,
                        path: path,
                        rank: rank,
                        icon: icon,
                        description: description,
                        status: status,
                        logged: logged,
                        cms: cms,
                        open: open,
                        badge: badge
                    };
                    if (id) {
                        token: _token,
                        formdata.id = id;
                    }
                    console.log(formdata);
                    return false;
                    var response = fnAjaxSend(formdata, uri, type, {}, false);
                    var data = response.responseJSON.data;
                    if (data.status === 200) {
                        $('div#modal_add_edit').modal('hide');
                        window.location.href = _config_api_base_url + '/prefferences/menu/view';
                    }
                });

            }
        };
    }();

    jQuery(document).ready(function () {
        Index.init();
    });
</script>