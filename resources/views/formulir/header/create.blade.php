@extends('layout.base')
@section('main')

<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    @isset($header)
                        <form action="{{route('header.update', $header->id)}}" method="post">                       
                        @method('PATCH')   
                    @else
                    <form action="{{route('header.store')}}" method="post">                   
                    @endisset
                        @csrf                         
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">nama</label>
                            <div class="col-sm-6">                                            
                                <div class="input-group mb-3">
                                    <input type="text" name="nama" value="{{ isset($header) ? $header->name : old('nama')}}"  class="form-control">
                                    <button class="btn btn-success btn-sm" type="button" id="add-item">Tambah item</button>
                                </div>
                                @error('nama')<div class='small text-danger text-left'>{{$message}}</div>@enderror       
                                <div id="input-item" class="mt-3">
                                    @error('item')<div class='small text-danger text-left'>{{$message}}</div>@enderror     
                                    @if(old('item'))
                                        @php $item = old('item') @endphp
                                        @for ($i = 0; $i < count($item); $i++)
                                            <div class="input-group mb-3">
                                                <input type="text" name="item[]" value="{{$item[$i]}}" placeholder="item" class="form-control">
                                                <button class="btn btn-danger remove-input" type="button"><i class="ri-close-circle-line"></i></button>
                                            </div>
                                        @endfor
                                    @else
                                        @isset($header)     
                                        @php $item = json_decode($header->item) @endphp  
                                        @for ($i = 0; $i < count($item); $i++)
                                        <div class="input-group mb-3">
                                            <input type="text" name="item[]" value="{{$item[$i]}}" placeholder="item" class="form-control">
                                            <button class="btn btn-danger remove-input" type="button"><i class="ri-close-circle-line"></i></button>
                                        </div>
                                        @endfor
                                        @endisset
                                    @endif
                                </div>      
                            </div>
                        </div>                                                                                                             
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger" href="{{route('header.index')}}">Back</a>                        
                        </div>
                    </form>
                </div>
            </div>                  
        </div>                 
    </div>    
</section>

@push('js')
<script>

$("#add-item").on('click',function(){        
    var newInput = $('<div class="input-group mb-3">\
      <input type="text" name="item[]" placeholder="item" class="form-control">\
      <button class="btn btn-danger remove-input" type="button"><i class="ri-close-circle-line"></i></button>\
    </div>');
    $('#input-item').append(newInput);
});


$(document).on('click', '.remove-input', function() {
    $(this).parent('.input-group').remove();
});

</script>
@endpush
@endsection