@extends('layout.base')
@section('main')

<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    @isset($village)
                        <form action="{{route('village.update', $village->id)}}" method="post">                         
                        @method('PATCH')  
                    @else
                        <form action="{{route('village.store')}}" method="post">                               
                    @endif
                        @csrf           
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-6">
                            <input type="text" name="name" value="{{ isset($village) ? $village->nama : old('name') }}"  class="form-control" id="inputText">
                            @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>      
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-6">
                            <select name="district" class="form-control select-field">
                                @foreach($dis as $row)
                                <option value="{{$row->id}}"  {{ isset($village) && ($village->districts_id == $row->id) ? 'selected' : null }}   >{{$row->nama}}</option>
                                @endforeach
                            </select>
                            @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>      

                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger" href="{{route('village.index')}}">Back</a>
                        </div>
                    </form>
                </div>
            </div>                  
        </div>                 
    </div>    
</section>

@push('js')
<script>
    $( '.select-field' ).select2( {
    theme: 'bootstrap-5'
} );
</script>
@endpush

@endsection