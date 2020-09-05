<script>
    var code_title = 'API system is ready to test!!!';
    var fnGetApidocList = function () {
        var formdata = {};
        var res = fnAjaxSend(formdata, _config_base_url + '/api/fetch/get-api-docs-type', 'GET', {token: _token}, false);
        var arr_data = '';
        if (res.responseJSON.status === 200) {
            var data = res.responseJSON.data;
            for (var i = 0; i < data.length; i++) {
                arr_data = arr_data + '<div class="col-md-8 col-sm-8"><div class="portlet box green"><div class="portlet-title"><div class="caption"><i class="fa fa-cogs"></i>';
                arr_data = arr_data + data[i].title;
                arr_data = arr_data + '</div><div class="tools"><a href="javascript:;" class="collapse" data-original-title="" title=""></a><a href="javascript:;" class="remove" data-original-title="" title=""></a></div></div>';
                arr_data = arr_data + '<div class="portlet-body">';
                var formdata2 = {
                    type_id: Base64.encode(data[i].id)
                };
                var res2 = fnAjaxSend(formdata2, _config_base_url + '/api/fetch/get-api-docs', 'POST', {token: _token}, false);
                var arr_data2 = '';
                if (res2 && res2.responseJSON.status === 200) {
                    var data2 = res2.responseJSON.data;
                    for (var j = 0; j < data2.length; j++) {
                        arr_data2 = arr_data2 + '<div class="clearfix"><h4 class="block">' + data2[j].title + '</h4><div class="panel panel-warning"><div class="panel-heading">';
                        arr_data2 = arr_data2 + '<h3 class="panel-title">URL = <code id="url_' + data2[j].id + '_' + data[i].id + '">' + _config_base_url + data2[j].url + '</code></h3>';
                        arr_data2 = arr_data2 + '</div><div class="margin-top-10 margin-bottom-10 clearfix"><table id="tbl_' + data2[j].id + '_' + data[i].id + '" class="table table-bordered table-striped"><tbody>';
                        arr_data2 = arr_data2 + '<tr><td> Parameter </td><td id="parameter_' + data2[j].id + '_' + data[i].id + '">' + data2[j].parameter + '</td><td class="emp"></td></tr>';
                        arr_data2 = arr_data2 + '<tr><td> Header </td><td id="header_' + data2[j].id + '_' + data[i].id + '">' + data2[j].header + '</td><td class="emp"></td></tr>';
                        arr_data2 = arr_data2 + '<tr><td> Body </td><td id="body_' + data2[j].id + '_' + data[i].id + '">' + data2[j].body + '</td><td class="emp"></td></tr>';
                        arr_data2 = arr_data2 + '<tr><td> Response </td><td id="response_' + data2[j].id + '_' + data[i].id + '">' + data2[j].response + '</td><td class="emp" id="btn_run_' + data2[j].id + '_' + data[i].id + '"><button id="tryit_' + data2[j].id + '_' + data[i].id + '" data-id="' + data2[j].id + '" data-type="' + data[i].id + '" data-status="open" type="button" class="btn btn-default tryit"><span id="tryit_title_' + data2[j].id + '_' + data[i].id + '">Try It</span></button><button id="submit_' + data2[j].id + '_' + data[i].id + '" data-id="' + data2[j].id + '" data-type="' + data[i].id + '" type="button" class="btn btn-default submit_tryit" disabled="true">Submit</button></td></tr>';
                        arr_data2 = arr_data2 + '</tbody></table></div></div></div>';
                    }
                }
                arr_data = arr_data + arr_data2;
                arr_data = arr_data + '</div></div></div>';
                arr_data = arr_data + '<div class="col-md-3 col-sm-3 result_monitor"><code class="append_result">' + code_title + '</code></div>';
            }
            $('#result_api_docs').html(arr_data);
        }
    };

    var Ajax = function () {
        return {
            //main function to initiate the module
            init: function () {
                fnToaStr('view js successfully load', 'success', {timeOut: 2000});
                fnGetApidocList();

                $('.tryit').on('click', function () {
                    var status = $(this).attr('data-status');
                    console.log(status);
                    if (status === 'open') {
                        var attemp_api_sample = 'Requesting parameter testing API system...';
                        console.log(attemp_api_sample);
                        $('code.append_result').html(attemp_api_sample);
                        var id = $(this).data('id');
                        var type = $(this).data('type');
                        $(this).html('Close It');
                        $(this).attr('data-status', 'close');
                        $('.btn').prop("disabled", true);
                        $('#submit_' + id + '_' + type).prop("disabled", false);
                        $('#tryit_' + id + '_' + type).prop("disabled", false);
                        //set raw html into input
                        //parameter
                        var div_parameter = $('#parameter_' + id + '_' + type);
                        div_parameter.html('<input type="text" name="parameter" value="' + div_parameter[0]['childNodes'][0]['data'] + '" readonly=""/>');

                        //header
                        var div_header = $('#header_' + id + '_' + type);
                        var header_str = '<table style="width:100%"><body>';
                        if (div_header[0]['childNodes'][0]['nodeValue'] !== 'null') {
                            var manipulate_str = div_header[0]['childNodes'][0]['nodeValue'];
                            manipulate_str = manipulate_str.replace('{', '');
                            manipulate_str = manipulate_str.replace('}', '');
                            manipulate_str = manipulate_str.split(":");
                            header_str = header_str + '<tr class="tr_bd"><td class="td_bd"> ' + manipulate_str[0] + '</td><td> : </td><td><input type="text" name="header" placeholder="' + manipulate_str[0] + '"/></td></tr>';
                        } else {
                            header_str = header_str + '<tr class="tr_bd"><td class="td_bd"> null </td></tr>';
                        }
                        header_str = header_str + '</body></table>';
                        div_header.html(header_str);

                        //body
                        var div_body = $('#body_' + id + '_' + type);
                        var body = [];
                        if (div_body[0]['childNodes'][0]['childNodes']) {
                            var div_body_vl = div_body[0]['childNodes'][0]['childNodes'];
                            for (var i = 0; i < div_body_vl.length; i++) {
                                if (div_body_vl[i]['nodeName'] === 'LI') {
                                    //console.log(div[i]['nodeName']);
                                    var manipulate_str = div_body_vl[i]['innerHTML'].split(":");
                                    body.push(manipulate_str[0].trim());
                                }
                            }
                        }
                        var body_str = '<table style="width:100%"><body>';
                        if (body) {
                            for (var j = 0; j < body.length; j++) {
                                body_str = body_str + '<tr class="tr_bd"><td class="td_bd"> ' + body[j] + '</td><td>:</td><td><input type="text" name="parameter[]" placeholder="' + body[j] + '" /></td></tr>';
                            }
                        }
                        body_str = body_str + '</body></table>';
                        div_body.html(body_str);
                    } else {
                        console.log('reset api docs list');
                        var attemp_api_sample = 'Cancelling testing API system...';
                        console.log(attemp_api_sample);
                        $('code.append_result').html(attemp_api_sample);
                        $('.btn').prop("disabled", false);
                        $('.submit_tryit').prop("disabled", true);
                        loadingImg('loading', 'play');
                        setTimeout(function () {
                            loadingImg('loading', 'destroy');
                            location.reload();
                        }, 2000);
                    }
                });
            }
        };

    }();

    jQuery(document).ready(function () {
        Ajax.init();
    });

</script>