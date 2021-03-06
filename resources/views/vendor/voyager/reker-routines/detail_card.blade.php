@php 
    use App\Models\Hris\MS_Department;
    use App\Models\Hris\MS_Karyawan;
    use App\Voyager\DepartmentField;
    use App\Models\Reker\RekerRoutine;
    use App\Models\Reker\RekerRoutineDepartment;
    use App\Models\Reker\RekerRoutinePic;

    $objReker = new RekerRoutine;
    $objDepartment = new MS_Department();
@endphp

@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing') .' '. trans('master.form') .' Program Kegiatan Rutin')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class=""></i> Program Kegiatan Rutin :: Tampilan per Departemen
        </h1>

        @if( \ModelInit::canIAccess('add_'.$objReker->getTable()) !== false )
            <a href="{{ url('admin/reker-routine/create') }}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> 
                <span>
                    {{ __('voyager::generic.add_new') }}
                </span>
            </a>
        @endif
    </div>
@stop

@section('content')

<style>
    .vertical-td {
        font-weight: 700;
        width: 150px;
    }
    .bg-orange {
        background: #ffe0a8;
    }
    .bg-orange-young {
        background: #fff4df;
    }

    .bg-orange-senior {
        background: #22a7f0 !important;
        color: #fff !important;
    }
</style>

    <div class="page-content browse container-fluid">
        @include('voyager::alerts')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-12 col-sm-6" style="margin-bottom: 0px;">

                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <h4> Nama Departemen </h4>
                                        @php
                                            $objDepart = new MS_Department;
                                            $depart = $objDepart->table()->where("KodeSeksi", $department_id)->first();
                                            echo $depart->namaSeksi;
                                        @endphp
                                    </div>

                                    <div class="col-sm-6 col-12">
                                        <h4> Periode </h4>
                                        {{ $ms_periode->periode_from }} s/d {{ $ms_periode->periode_until }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="bg-orange-senior">
                                    <th class="bg-orange-senior"></th>
                                    <th class="bg-orange-senior">Objective</th>
                                    <th class="bg-orange-senior">Target</th>
                                    <th class="bg-orange-senior">M1</th>
                                    <th class="bg-orange-senior">M2</th>
                                    <th class="bg-orange-senior">M3</th>
                                    <th class="bg-orange-senior">M4</th>
                                    <th class="bg-orange-senior">M5</th>
                                    <th class="bg-orange-senior">M6</th>
                                    <th class="bg-orange-senior">M7</th>
                                    <th class="bg-orange-senior">M8</th>
                                    <th class="bg-orange-senior">M9</th>
                                    <th class="bg-orange-senior">M10</th>
                                    <th class="bg-orange-senior">M11</th>
                                    <th class="bg-orange-senior">M12</th>
                                    <th class="bg-orange-senior">PIC</th>
                                    <th class="bg-orange-senior">DEPT</th>
                                    <th class="bg-orange-senior">AKSI</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($card_cat1 as $ki => $item)
                                    <tr>
                                        @if($ki == 0)
                                            <td class='vertical-td bg-orange' rowspan="{{ count($card_cat1) }}"> Internal Business Process </td>
                                        @endif
                                        <td class="vertical-td"> {{ $item->objective }} </td>
                                        <td class="vertical-td"> {{ $item->target }} </td>
                                        <td class="vertical-td"> {{ $item->m1 }} </td>
                                        <td class="vertical-td"> {{ $item->m2 }} </td>
                                        <td class="vertical-td"> {{ $item->m3 }} </td>
                                        <td class="vertical-td"> {{ $item->m4 }} </td>
                                        <td class="vertical-td"> {{ $item->m5 }} </td>
                                        <td class="vertical-td"> {{ $item->m6 }} </td>
                                        <td class="vertical-td"> {{ $item->m7 }} </td>
                                        <td class="vertical-td"> {{ $item->m8 }} </td>
                                        <td class="vertical-td"> {{ $item->m9 }} </td>
                                        <td class="vertical-td"> {{ $item->m10 }} </td>
                                        <td class="vertical-td"> {{ $item->m11 }} </td>
                                        <td class="vertical-td"> {{ $item->m12 }} </td>
                                        <td class="vertical-td">
                                            @php
                                                $objTrxPic = new RekerRoutinePic();

                                                $details = $objTrxPic->where('id', $item->id)->get();

                                                $return_str = "";
                                                foreach ($details as $key => $value) 
                                                {
                                                    $objEmp = new MS_Karyawan;
                                                    $employee = $objEmp->table()->where("NIK", $value->nik)->first();
                                                    $return_str .= $employee->namaKaryawan;

                                                    if( ($key+1) != count($details) ){
                                                        $return_str .= ", ";
                                                    }
                                                }

                                                echo $return_str;
                                            @endphp 
                                        </td>
                                        <td class="vertical-td"> 
                                            @php
                                                $objTrxDepart = new RekerRoutineDepartment();

                                                $details = $objTrxDepart->where('id', $item->id)->get();

                                                $return_str = "";
                                                foreach ($details as $key => $value) 
                                                {
                                                    $objDepart = new MS_Department;
                                                    $depart = $objDepart->table()->where("KodeSeksi", $value->department_id)->first();
                                                    $return_str .= $depart->namaSeksi;

                                                    if( ($key+1) != count($details) ){
                                                        $return_str .= ", ";
                                                    }
                                                }

                                                echo $return_str;
                                            @endphp   
                                        </td>
                                        <td>
                                            @if( $objReker->canIEdit($item) )
                                            <a href="{{ url("admin/reker-routines/". $item->id . "/edit") }}" class="btn btn-sm btn-primary">
                                                <i class="voyager-edit"></i> Ubah
                                            </a>
                                            @endif
                                            
                                            @if( $objReker->canIDelete($item) )
                                            <a href="javascript:void(0);" title="Hapus" class="btn btn-sm btn-danger pull-right delete" data-id="{{ $item->id }}" id="delete-reker-{{ $item->id }}">
                                                <i class="voyager-trash"></i> 
                                                <span class="hidden-xs hidden-sm">Hapus</span>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                @foreach ($card_cat2 as $ki => $item)
                                    <tr>
                                        @if($ki == 0)
                                            <td class='vertical-td bg-orange-young' rowspan="{{ count($card_cat2) }}"> Learning & Growth </td>
                                        @endif
                                        <td class="vertical-td"> {{ $item->objective }} </td>
                                        <td class="vertical-td"> {{ $item->target }} </td>
                                        <td class="vertical-td"> {{ $item->m1 }} </td>
                                        <td class="vertical-td"> {{ $item->m2 }} </td>
                                        <td class="vertical-td"> {{ $item->m3 }} </td>
                                        <td class="vertical-td"> {{ $item->m4 }} </td>
                                        <td class="vertical-td"> {{ $item->m5 }} </td>
                                        <td class="vertical-td"> {{ $item->m6 }} </td>
                                        <td class="vertical-td"> {{ $item->m7 }} </td>
                                        <td class="vertical-td"> {{ $item->m8 }} </td>
                                        <td class="vertical-td"> {{ $item->m9 }} </td>
                                        <td class="vertical-td"> {{ $item->m10 }} </td>
                                        <td class="vertical-td"> {{ $item->m11 }} </td>
                                        <td class="vertical-td"> {{ $item->m12 }} </td>
                                        <td class="vertical-td">
                                            @php
                                                $objTrxPic = new RekerRoutinePic();

                                                $details = $objTrxPic->where('id', $item->id)->get();

                                                $return_str = "";
                                                foreach ($details as $key => $value) 
                                                {
                                                    $objEmp = new MS_Karyawan;
                                                    $employee = $objEmp->table()->where("NIK", $value->nik)->first();
                                                    $return_str .= $employee->namaKaryawan;

                                                    if( ($key+1) != count($details) ){
                                                        $return_str .= ", ";
                                                    }
                                                }

                                                echo $return_str;
                                            @endphp 
                                        </td>
                                        <td class="vertical-td"> 
                                            @php
                                                $objTrxDepart = new RekerRoutineDepartment();

                                                $details = $objTrxDepart->where('id', $item->id)->get();

                                                $return_str = "";
                                                foreach ($details as $key => $value) 
                                                {
                                                    $objDepart = new MS_Department;
                                                    $depart = $objDepart->table()->where("KodeSeksi", $value->department_id)->first();
                                                    $return_str .= $depart->namaSeksi;

                                                    if( ($key+1) != count($details) ){
                                                        $return_str .= ", ";
                                                    }
                                                }

                                                echo $return_str;
                                            @endphp   
                                        </td>
                                        <td>
                                            @if( $objReker->canIEdit($item) )
                                            <a href="{{ url("admin/reker-routines/". $item->id . "/edit") }}" class="btn btn-sm btn-primary">
                                                <i class="voyager-edit"></i> Ubah
                                            </a>
                                            @endif
                                            
                                            @if( $objReker->canIDelete($item) )
                                            <a href="javascript:void(0);" title="Hapus" class="btn btn-sm btn-danger pull-right delete" data-id="{{ $item->id }}" id="delete-reker-{{ $item->id }}">
                                                <i class="voyager-trash"></i> 
                                                <span class="hidden-xs hidden-sm">Hapus</span>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                @foreach ($card_cat3 as $ki => $item)
                                    <tr>
                                        @if($ki == 0)
                                            <td class='vertical-td bg-orange-young' rowspan="{{ count($card_cat3) }}"> Customer & Market </td>
                                        @endif
                                        <td class="vertical-td"> {{ $item->objective }} </td>
                                        <td class="vertical-td"> {{ $item->target }} </td>
                                        <td class="vertical-td"> {{ $item->m1 }} </td>
                                        <td class="vertical-td"> {{ $item->m2 }} </td>
                                        <td class="vertical-td"> {{ $item->m3 }} </td>
                                        <td class="vertical-td"> {{ $item->m4 }} </td>
                                        <td class="vertical-td"> {{ $item->m5 }} </td>
                                        <td class="vertical-td"> {{ $item->m6 }} </td>
                                        <td class="vertical-td"> {{ $item->m7 }} </td>
                                        <td class="vertical-td"> {{ $item->m8 }} </td>
                                        <td class="vertical-td"> {{ $item->m9 }} </td>
                                        <td class="vertical-td"> {{ $item->m10 }} </td>
                                        <td class="vertical-td"> {{ $item->m11 }} </td>
                                        <td class="vertical-td"> {{ $item->m12 }} </td>
                                        <td class="vertical-td">
                                            @php
                                                $objTrxPic = new RekerRoutinePic();

                                                $details = $objTrxPic->where('id', $item->id)->get();

                                                $return_str = "";
                                                foreach ($details as $key => $value) 
                                                {
                                                    $objEmp = new MS_Karyawan;
                                                    $employee = $objEmp->table()->where("NIK", $value->nik)->first();
                                                    $return_str .= $employee->namaKaryawan;

                                                    if( ($key+1) != count($details) ){
                                                        $return_str .= ", ";
                                                    }
                                                }

                                                echo $return_str;
                                            @endphp 
                                        </td>
                                        <td class="vertical-td"> 
                                            @php
                                                $objTrxDepart = new RekerRoutineDepartment();

                                                $details = $objTrxDepart->where('id', $item->id)->get();

                                                $return_str = "";
                                                foreach ($details as $key => $value) 
                                                {
                                                    $objDepart = new MS_Department;
                                                    $depart = $objDepart->table()->where("KodeSeksi", $value->department_id)->first();
                                                    $return_str .= $depart->namaSeksi;

                                                    if( ($key+1) != count($details) ){
                                                        $return_str .= ", ";
                                                    }
                                                }

                                                echo $return_str;
                                            @endphp   
                                        </td>
                                        <td>
                                            @if( $objReker->canIEdit($item) )
                                            <a href="{{ url("admin/reker-routines/". $item->id . "/edit") }}" class="btn btn-sm btn-primary">
                                                <i class="voyager-edit"></i> Ubah
                                            </a>
                                            @endif
                                            
                                            @if( $objReker->canIDelete($item) )
                                            <a href="javascript:void(0);" title="Hapus" class="btn btn-sm btn-danger pull-right delete" data-id="{{ $item->id }}" id="delete-reker-{{ $item->id }}">
                                                <i class="voyager-trash"></i> 
                                                <span class="hidden-xs hidden-sm">Hapus</span>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        <i class="voyager-trash"></i> 
                        Apa anda yakin ingin menghapus data ini?
                    </h4>
                </div>
                <div class="modal-footer">
                    <form action="#" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Iya">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">
                        Engga Jadi
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('css')
    <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}">

    <style>
        #div-filter {
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
        }
    </style>
@stop

@section('javascript')
    <!-- DataTables -->
    <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>
    <script>
        var deleteFormAction;
        $('td').on('click', '.delete', function (e) {
            $('#delete_form')[0].action = 'reker-routines/delete/__id'.replace('__id', $(this).data('id'));
            $('#delete_modal').modal('show');
        });

        $('input[name="row_id"]').on('change', function () {
            var ids = [];
            $('input[name="row_id"]').each(function() {
                if ($(this).is(':checked')) {
                    ids.push($(this).val());
                }
            });
            $('.selected_ids').val(ids);
        });
    </script>
@stop
