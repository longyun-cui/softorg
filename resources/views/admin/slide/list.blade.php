@extends('admin.layout.layout')

@section('title','幻灯片列表')
@section('header','幻灯片列表')
@section('description','幻灯片列表')
@section('breadcrumb')
    <li><a href="{{url('/admin')}}"><i class="fa fa-home"></i>首页</a></li>
    <li><a href="{{url('/admin/company/product/list')}}"><i class="fa "></i>幻灯片列表</a></li>
    <li><a href="#"><i class="fa "></i>Here</a></li>
@endsection


@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PORTLET-->
        <div class="box box-info">

            <div class="box-header with-border" style="margin:16px 0;">
                <h3 class="box-title"></h3>

                <div class="pull-right">
                    <a href="{{url('/admin/slide/create')}}">
                        <button type="button" onclick="" class="btn btn-success pull-right"><i class="fa fa-plus"></i> 添加幻灯片</button>
                    </a>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="box-body">
                <!-- datatable start -->
                <table class='table table-striped table-bordered' id='datatable_ajax'>
                    <thead>
                    <tr role='row' class='heading'>
                        <th>#</th>
                        <th>标题</th>
                        <th>描述</th>
                        <th>类型</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th>修改时间</th>
                        <th>操作</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-success">搜索</button>
                                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">重置</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <!-- datatable end -->
            </div>

            <div class="box-footer">
                <div class="row" style="margin:16px 0;">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="button" onclick="" class="btn btn-primary"><i class="fa fa-check"></i> 提交</button>
                        <button type="button" onclick="history.go(-1);" class="btn btn-default">返回</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>
@endsection


@section('js')
<script>
    var TableDatatablesAjax = function () {
        var datatableAjax = function () {

            var dt = $('#datatable_ajax');
            var ajax_datatable = dt.DataTable({
                "aLengthMenu": [[20, 50, 200, 500, -1], ["20", "50", "200", "500", "全部"]],
                "processing": true,
                "serverSide": true,
                "searching": false,
                "ajax": {
                    'url': '/admin/slide/list',
                    "type": 'POST',
                    "dataType" : 'json',
                    "data": function (d) {
                        d._token = $('meta[name="_token"]').attr('content');
//                        d.nickname 	= $('input[name="nickname"]').val();
//                        d.certificate_type_id = $('select[name="certificate_type_id"]').val();
//                        d.certificate_state = $('select[name="certificate_state"]').val();
//                        d.admin_name = $('input[name="admin_name"]').val();
//
//                        d.created_at_from = $('input[name="created_at_from"]').val();
//                        d.created_at_to = $('input[name="created_at_to"]').val();
//                        d.updated_at_from = $('input[name="updated_at_from"]').val();
//                        d.updated_at_to = $('input[name="updated_at_to"]').val();

                    },
                },
                "pagingType": "simple_numbers",
                "order": [],
                "orderCellsTop": true,
                "columns": [
                    {
                        "data": "id",
                        'orderable': true,
                        render: function(data) {
                            return (data == null) ? 0 : '';
                        }
                    },
                    {
                        "data": "encode_id",
                        'orderable': false,
                        render: function(data, type, row, meta) {
                            return '<a target="_blank" href="/slide?id='+data+'">'+row.name+'</a>';
                        }
                    },
                    {
                        'data': 'description',
                        'orderable': false,
                        render: function(description) {
                            return description == null ? '' : description;
                        }
                    },
                    {
                        'data': 'type',
                        'orderable': true,
                        render: function(type) {
                            return type == null ? '' : type;
                        }
                    },
                    {
                        'data': 'active',
                        'orderable': false,
                        render: function(val) {
                            return val == 1
                                    ? '<small class="label bg-red">启</small>'
                                    : '<small class="label bg-red">禁</small>';
                        }
                    },
                    {
                        'data': 'created_at',
                        'orderable': false,
                        render: function(data) {
                            newDate = new Date();
                            newDate.setTime(data * 1000);
                            return newDate.toLocaleString('chinese',{hour12:false});
                        }
                    },
                    {
                        'data': 'updated_at',
                        'orderable': true,
                        render: function(data) {
                            newDate = new Date();
                            newDate.setTime(data * 1000);
                            return newDate.toLocaleString('chinese',{hour12:false});
                        }
                    },
                    {
                        'data': 'encode_id',
                        'orderable': false,
                        render: function(value) {
                            var html =
                            '<div class="btn-group">'+
                            '<button type="button" class="btn btn-sm btn-primary">操作</button>'+
                            '<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">'+
                            '<span class="caret"></span>'+
                            '<span class="sr-only">Toggle Dropdown</span>'+
                            '</button>'+
                            '<ul class="dropdown-menu" role="menu">'+
                            '<li><a href="/admin/slide/edit?id='+value+'">编辑</a></li>'+
                            '<li><a href="/admin/slide/delete/'+value+'">删除</a></li>'+
                            '<li><a href="#">启用</a></li>'+
                            '<li><a href="#">禁用</a></li>'+
                            '<li class="divider"></li>'+
                            '<li><a href="#">Separated link</a></li>'+
                            '</ul>'+
                            '</div>';
                            return html;
                        }
                    },
//                    {
                        {{--'data': 'ext',--}}
                        {{--'orderable': false,--}}
                        {{--render: function(ext) {--}}
                            {{--if(ext == null) return '认证缺失';--}}
                            {{--// if(ext.certificate_file.length < 1) return '文件不存在';--}}
                            {{--console.log(ext);--}}
                            {{--files = ext.certificate_file;--}}

                            {{--var storage = [];--}}
                            {{--files.forEach(function(file){--}}
                                {{--storage.push("<span data-url='@url' class='item'></span>"--}}
                                        {{--.replace('@url', file));--}}
                            {{--});--}}
                            {{--return '<div class="img-strage" data->'--}}
                                    {{--+ storage.join('')--}}
                                    {{--+ "<button class='btn btn-primary view-image' data-info="+ JSON.stringify(ext)+">认证信息</button>"--}}
                                    {{--+ "<div>";--}}
                        {{--}--}}
//                    }
                ],
                "drawCallback": function (settings) {
                    ajax_datatable.$('.tooltips').tooltip({placement: 'top', html: true});
                    $("a.verify").click(function(event){
                        event.preventDefault();
                        var node = $(this);
                        var tr = node.closest('tr');
                        var nickname = tr.find('span.nickname').text();
                        var cert_name = tr.find('span.certificate_type_name').text();
                        var action = node.attr('data-action');
                        var certificate_id = node.attr('data-id');
                        var action_name = node.text();

                        var tpl = "{{trans('labels.crc.verify_user_certificate_tpl')}}";
                        layer.open({
                            'title': '警告',
                            content: tpl
                                    .replace('@action_name', action_name)
                                    .replace('@nickname', nickname)
                                    .replace('@certificate_type_name', cert_name),
                            btn: ['Yes', 'No'],
                            yes: function(index) {
                                layer.close(index);
                                $.post(
                                        '/admin/medsci/certificate/user/verify',
                                        {
                                            action: action,
                                            id: certificate_id,
                                            _token: '{{csrf_token()}}'
                                        },
                                        function(json){
                                            if(json['response_code'] == 'success') {
                                                layer.msg('操作成功!', {time: 3500});
                                                ajax_datatable.ajax.reload();
                                            } else {
                                                layer.alert(json['response_data'], {time: 10000});
                                            }
                                    }, 'json');
                            }
                        });
                    });
                },
                "language": { url: '/admin/i18n' },
            });


            dt.on('click', '.filter-submit', function () {
                ajax_datatable.ajax.reload();
            });

            dt.on('click', '.filter-cancel', function () {
                $('textarea.form-filter, select.form-filter, input.form-filter', dt).each(function () {
                    $(this).val("");
                });

                $('select.form-filter').selectpicker('refresh');

                ajax_datatable.ajax.reload();
            });

        };
        return {
            init: datatableAjax
        }
    }();
    $(function () {
        TableDatatablesAjax.init();
    });
</script>
@endsection
