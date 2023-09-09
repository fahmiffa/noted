@extends('layout.base')
@section('main')

<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    @isset($item)
                        <form action="{{route('item.update', $item->id)}}" method="post">                       
                        @method('PATCH')   
                    @else
                    <form action="{{route('item.store')}}" method="post">                   
                    @endisset
                        @csrf                         
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">nama</label>
                            <div class="col-sm-6">
                            <input type="text" name="nama" value="{{ isset($item) ? $item->items : null}}"  class="form-control">
                            @error('nama')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>           
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Form</label>
                            <div class="col-sm-6">
                                <select class="form-control select-field" name="form">                                    
                                    @foreach ($form as $row)
                                    <option value="{{$row->id}}" {{ isset($item) && $item->forms_id == $row->id ? 'selected' : null }}>{{$row->name}}</option>    
                                    @endforeach                                
                                </select>                                                  
                                @error('form')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>   
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Categori</label>
                            <div class="col-sm-6">
                                <select class="form-control select-field" name="cat" id="cat">
                                    @php $val = categori(); @endphp
                                    @for ($i = 0; $i < count($val); $i++)
                                        <option value="{{$val[$i]}}"  {{ isset($item) && $item->cat == $val[$i] ? 'selected' : null }}  >{{$val[$i]}}</option>
                                    @endfor
                                </select>      
                                @error('cat')<div class='small text-danger text-left'>{{$message}}</div>@enderror                                            
                            </div>
                        </div>                                                                            
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger" href="{{route('item.index')}}">Back</a>                        
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