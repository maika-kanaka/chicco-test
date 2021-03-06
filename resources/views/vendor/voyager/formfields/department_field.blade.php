@php 
    use App\Models\Hris\MS_Department;
    use App\Models\Reker\RekerDepartment;

    // if( isset($dataTypeContent->{$row->field}) ){
    //     $department_selected = old($row->field, $dataTypeContent->{$row->field});
    // }else{
    //     $department_selected = old($row->field);
    // }

    $department_selected = [];

    $departments = new MS_Department;
    $departments = $departments->table()->where('KodeSeksi', '!=', '_mgr_')->orderBy('namaSeksi')->get();
@endphp

@if( !empty($options->multiple) && $options->multiple == "Y" )

    @php
        if(!empty($options->data_source) && $options->data_source == "reker")
        {
            $objReker = new RekerDepartment();
            $details  = $objReker->where('id', $dataTypeContent->id)->get();
            foreach ($details as $key => $value) {
                $department_selected[] = $value->department_id;
            }
        }
    @endphp

    <select data-live-search="true" class="form-control select2" multiple name="{{ $row->field }}[]" data-name="{{ $row->display_name }}" @if($row->required == 1) required @endif>
        <option value=""> -- Pilih -- </option>
        @foreach( $departments as $dep )
        <option value="{{ $dep->KodeSeksi }}" {{ in_array($dep->KodeSeksi, $department_selected) ? 'selected' : '' }}> 
            {{ $dep->namaSeksi }} 
        </option>
        @endforeach
    </select>

@else

    <select data-live-search="true" class="form-control selectpicker" name="{{ $row->field }}" data-name="{{ $row->display_name }}" @if($row->required == 1) required @endif>
        <option value=""> -- Pilih -- </option>
        @foreach( $departments as $dep )
        <option value="{{ $dep->KodeSeksi }}" {{ $department_selected == $dep->KodeSeksi ? 'selected' : '' }}> 
            {{ $dep->namaSeksi }} 
        </option>
        @endforeach
    </select>

@endif