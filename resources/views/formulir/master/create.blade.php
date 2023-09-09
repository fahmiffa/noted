@extends('layout.base')
@section('main')

<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    @isset($form)                        
                        <form action="{{route('form.update', $form->id)}}" method="post">                         
                        @method('PATCH')   
                    @else             
                        <form action="{{route('form.store')}}" method="post">                           
                    @endisset
                        @csrf                            
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-6">
                            <input type="text" name="name" value="{{ isset($form) ? $form->name : old('name')}}"  class="form-control">
                            @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-6">
                            <input type="text" name="title" value="{{ isset($form) ? $form->title : old('title')}}"  class="form-control">
                            @error('title')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>                                                   
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Header</label>
                            <div class="col-sm-6">
                                <select class="form-control select-field" name="header">                                    
                                    @foreach ($header as $row)
                                    <option value="{{$row->id}}" {{ isset($form) && $form->headers_id == $row->id ? 'selected' : null }}>{{$row->name}}</option>    
                                    @endforeach                                
                                </select>                                                  
                                @error('header')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>    
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Content</label>
                            <div class="col-sm-6">
                                <select class="form-control select-field" name="content">                                    
                                    @foreach ($content as $row)
                                    <option value="{{$row->id}}" {{ isset($form) && $form->contents_id == $row->id ? 'selected' : null }}>{{$row->name}}</option>    
                                    @endforeach                                
                                </select>                                                  
                                @error('content')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>                         
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-danger" href="{{route('form.index')}}">Back</a>                     
                        </div>
                    </form>
                </div>
            </div>                  
        </div>                 
    </div>    
</section>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>

$( '.select-field' ).select2( {
theme: 'bootstrap-5'
});

var counter = 0;
var ins = 0;

$("#add-header").on('click',function(){    
    counter++;    
    var newInput = $('<div class="input-group mb-3">\
      <input type="text" name="header[]" placeholder="item" class="form-control">\
      <button class="btn btn-danger remove-input" type="button"><i class="ri-close-circle-line"></i></button>\
    </div>');
    $('#input-header').append(newInput);
});

$("#add-body").on('click',function(){    
    counter++;    
   
    var newInput = $('<div class="input-field form-group">\
      <div class="input-group mb-3">\
        <input type="text" name="item['+counter+']" placeholder="title" class="form-control">\
        <button class="btn btn-secondary add-sub-input-btn" index="'+counter+'" type="button">Add Item</button>\
        <button class="btn btn-danger remove-input-btn" type="button"><i class="ri-close-circle-fill"></i></button>\
        </div>\
        <div class="sub-input-container input-group-append"></div>\
    </div>');

    $('#input-title').append(newInput);
});

$(document).on('click', '.add-sub-input-btn', function() {
    ins++;    
    var index = $(this).attr("index");    
    var parentInputGroup = $(this).closest('.input-group');                

    var newSubInput = $('<div class="sub-input-field input-group mb-3">\
        <input type="text" class="form-control" placeholder="item" name="sub['+index+']">\
        <button class="btn btn-danger remove-sub-input-btn" type="button"><i class="ri-close-circle-fill"></i></button>\
    </div>');    
    parentInputGroup.after(newSubInput);
});
    
$(document).on('click', '.remove-input-btn', function() {        
        var parentInputGroup = $(this).closest('.input-field');    
        parentInputGroup.remove();
});

$(document).on('click', '.remove-input', function() {
    $(this).parent('.input-group').remove();
});

$(document).on('click', '.remove-sub-input-btn', function() {
    $(this).parent('.sub-input-field').remove();
});

</script>
@endpush
@endsection