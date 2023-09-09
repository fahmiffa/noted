@extends('layout.base')
@section('main')

<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    @isset($district)
                        <form action="{{route('district.update', $district->id)}}" method="post">                         
                        @method('PATCH')  
                    @else
                        <form action="{{route('district.store')}}" method="post">                               
                    @endif
                        @csrf           
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-6">
                            <input type="text" name="name" value="{{ isset($district) ? $district->nama : old('name') }}"  class="form-control" id="inputText">
                            @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>                     
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger" href="{{route('district.index')}}">Back</a>
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