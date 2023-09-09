@extends('layout.base')
@section('main')

<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    @isset($formulir)                        
                        <form action="{{route('formulir.update', $formulir->id)}}" method="post" enctype="multipart/form-data">                         
                        @method('PATCH')   
                        @csrf     
                        @php 
                        $items = json_decode($formulir->items);
                        $header = $items->header;    
                        $saran = $items->saran;     
                        if($formulir->tipe == 'field')
                        {
                            $nameOther = $items->nameOther;          
                            $saranOther = $items->saranOther;
                            $other = $items->other;                                                                                               
                        } 
                        @endphp
                        <p class="h5 text-center fw-bold">{{$da->title}}</p>   
                        <p class="text-center">No. {{$nomor}}</p>
                        <div class="row g-3 my-3" id="step-1">   
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="text" name="noreg" value="{{$formulir->noreg}}" class="form-control" placeholder="No. Registrasi">
                                <label>No. Registrasi</label>
                                    @error('noreg')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-floating">                                
                                <select class="form-select" name="pengajuan" id="floatingSelect" placeholder="Pengajuan">
                                    <option value="pbg" {{($header && $header[1] == 'pbg') ? 'selected' : null}}>PBG</option>
                                    <option value="slf" {{($header && $header[1] == 'slf') ? 'selected' : null}}>SLF</option>
                                    <option value="Lainnya"  {{($header && $header[1] == 'Lainnya') ? 'selected' : null}}>Lainnya</option>
                                  </select>
                                <label>Pengajuan</label>
                                    @error('Pengajuan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>   
                            <div class="col-md-6">
                                <div class="form-floating">                                                            
                                    <input type="text" value="{{$formulir->name}}" name="nama" class="form-control"  placeholder="Nama">                                    
                                    <label>Nama</label>
                                    @error('nama')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>          
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="date" name="tanggal" value="{{$formulir->tanggal}}" class="form-control"  placeholder="Tanggal">
                                <label>Tanggal</label>
                                    @error('tanggal')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>                               
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="text" value="{{($header) ? $header[2] : null}}" name="namaPemohon" class="form-control"  placeholder="Nama Pemohon">
                                <label>Nama Pemohon</label>
                                    @error('namaPemohon')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-floating">                                                            
                                    <input type="number" value="{{($header) ? $header[3] : null}}" name="hp" class="form-control"  placeholder="No. Telp./HP">                                    
                                    <label>No. Telp. / HP</label>
                                    @error('hp')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select name="district" class="form-control select-field" id="dis">
                                        @foreach($dis as $row)
                                        <option value="{{$row->id}}"  {{ isset($formulir) && ($formulir->desa) && ($formulir->desa->districts_id == $row->id) ? 'selected' : null }}   >{{$row->nama}}</option>
                                        @endforeach
                                    </select>
                                    @error('district')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">                                                            
                                    <label>Desa</label>
                                    <select name="village" class="form-control select-field" id="vil">                                           
                                        <option value="{{($formulir->desa) ? $formulir->desa->id : null}}">{{($formulir->desa) ? $formulir->desa->nama : null}}</option>                                                             
                                    </select>
                                    @error('village')<div class='small text-danger text-left'>{{$message}}</div>@enderror                                        
                                </div>
                            </div>                             
                            <div class="col-12">
                                <div class="form-floating">
                                <textarea class="form-control" name="alamatPemohon" placeholder="Alamat Pemohon" style="height: 100px;">{{($header) ? $header[4] : null}}</textarea>
                                <label for="floatingTextarea">Alamat Pemohon</label>
                                    @error('alamatPemohon')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>      
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="text" value="{{($header) ? $header[5] : null}}" name="namaBangunan" class="form-control"  placeholder="Nama Bangunan">
                                <label>Nama Bangunan</label>
                                    @error('namaBangunan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-floating">                                                            
                                    <input type="text" value="{{($header) ? $header[6] : null}}" name="fungsi" class="form-control"  placeholder="Fungsi">                                    
                                    <label>Fungsi</label>
                                    @error('fungsi')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>   
                            <div class="col-12">
                                <div class="form-floating">
                                <textarea class="form-control" name="alamatBangunan" placeholder="Alamat Bangunan" style="height: 100px;">{{($header) ? $header[7] : null}}</textarea>
                                <label for="floatingTextarea">Alamat Bangunan</label>
                                    @error('alamatBangunan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>         
                            <div class="col-md-6">
                                <div class="form-floating">                                                            
                                    <input type="text" value="{{$formulir->status}}" name="status" class="form-control"  placeholder="Status">                                    
                                    <label>Status</label>
                                    @error('status')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>         
                            <div class="col-md-6">
                                <div class="form-floating">                                
                                <select class="form-select" name="tipe" id="tipe" placeholder="Tipe" required>                                        
                                    <option value="doc" {{($formulir->tipe == 'doc') ? 'selected' : null}}>Dokumen</option>
                                    <option value="field" {{($formulir->tipe == 'field') ? 'selected' : null}}>Field</option>                                        
                                  </select>
                                <label>Tipe</label>
                                    @error('tipe')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>                           
                        </div>    
                        @if($formulir->tipe == 'doc')
                            <div class="row mb-3 d-block" id="doc">
                                <label class="col-sm-2 col-form-label">FIles</label>
                                <div class="col-sm-6">
                                <input class="form-control" type="file" name="file" accept="application/pdf">       
                                @error('file')<div class='small text-danger text-left'>{{$message}}</div>@enderror                     
                                </div>
                            </div>              
                            <div class="d-none mb-3" id="field">
                                <p class="h6 fw-bold py-3">{{$da->content->name}}</p>
                                <table class="table table-bordered border border-dark">
                                    <tbody>
                                        @php $no=0; @endphp
                                        @foreach($da->content->title as $row)
                                            @if($loop->first)                
                                                <tr class="fw-bold">
                                                    <td class="text-center">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                                                    <td>{{$row->name}}</td>
                                                    <td class="text-center">Status</td>                                                    
                                                    <td class="text-center">Catatan / Saran</td>
                                                </tr>
                                                @foreach($row->item as $items)
                                                <tr>
                                                    <td class="text-end">{{$loop->iteration}}</td>
                                                    <td>{{$items->name}}</td>           
                                                    <td>
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="1">
                                                            <label class="form-check-label">Ada</label>
                                                        </div>
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="0" checked="">
                                                            <label class="form-check-label">Tidak Ada</label>
                                                        </div>   
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="2">
                                                            <label class="form-check-label">Tidak Perlu</label>
                                                        </div>   
                                                    </td>                                         
                                                    <td><textarea class="form-control" name="saranItem[{{$items->id}}]"  style="height: 50px;"></textarea></td>          
                                                </tr>
                                                    @foreach($items->sub as $key)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{abjad($loop->iteration)}} {{$key->name}}</td>     
                                                        <td>
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="1">
                                                                <label class="form-check-label">Ada</label>
                                                            </div>
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="0" checked="">
                                                                <label class="form-check-label">Tidak Ada</label>
                                                            </div>   
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="2">
                                                                <label class="form-check-label">Tidak Perlu</label>
                                                            </div>   
                                                        </td>                                                      
                                                        <td><textarea class="form-control" name="saranSub[{{$key->id}}]" style="height: 50px;"></textarea></td>                 
                                                    </tr>
                                                    @endforeach 
                                            @endforeach 
                                            @else                               
                                                <tr>
                                                    <td class="text-center fw-bold">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                                                    <td class="fw-bold" colspan="4">{{$row->name}} {{$row->id}}</td>           
                                                </tr>
                                                @foreach($row->item as $items)
                                                    <tr>
                                                        <td class="text-end">{{$loop->iteration}}</td>
                                                        <td>{{$items->name}}</td>           
                                                        <td>
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="1">
                                                                <label class="form-check-label">Ada</label>
                                                            </div>
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="0" checked="">
                                                                <label class="form-check-label">Tidak Ada</label>
                                                            </div>   
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="2">
                                                                <label class="form-check-label">Tidak Perlu</label>
                                                            </div>   
                                                        </td>                                         
                                                        <td><textarea class="form-control" name="saranItem[{{$items->id}}]"  style="height: 50px;"></textarea></td>          
                                                    </tr>
                                                        @foreach($items->sub as $key)
                                                        <tr>
                                                            <td></td>
                                                            <td>{{abjad($loop->index)}}. {{$key->name}}</td>     
                                                            <td>
                                                                <div class="form-check d-inline-block">
                                                                    <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="1">
                                                                    <label class="form-check-label">Ada</label>
                                                                </div>
                                                                <div class="form-check d-inline-block">
                                                                    <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="0" checked="">
                                                                    <label class="form-check-label">Tidak Ada</label>
                                                                </div>   
                                                                <div class="form-check d-inline-block">
                                                                    <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="2">
                                                                    <label class="form-check-label">Tidak Perlu</label>
                                                                </div>   
                                                            </td>                                                                                                                  
                                                            <td><textarea class="form-control" name="saranSub[{{$key->id}}]" style="height: 50px;"></textarea></td>                 
                                                        </tr>
                                                        @endforeach 
                                                @endforeach 
                                            @endif

                                            @if($loop->last && $formulir->tipe == 'field')
                                            <tr>
                                                <td class="fw-bold">D.</td>
                                                <td class="fw-bold">Lain-lain</td>                                                
                                                <td class="fw-bold text-center">Status</td>                                                
                                                <td class="fw-bold text-center">Catatan / Saran</td>                                                
                                            </tr>
                                            @for ($i = 0; $i < 5; $i++)                                                
                                            <tr>
                                                <td>{{$i+1}}.</td>
                                                <td><input type="text" name="other[{{$i}}]" class="form-control"></td>     
                                                <td>
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="radio" name="other[{{$i}}]" value="1">
                                                        <label class="form-check-label">Ada</label>
                                                    </div>
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="radio" name="other[{{$i}}]" value="0" checked="">
                                                        <label class="form-check-label">Tidak Ada</label>
                                                    </div>   
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="radio" name="other[{{$i}}]" value="2">
                                                        <label class="form-check-label">Tidak Perlu</label>
                                                    </div>   
                                                </td>                                                                                                                  
                                                <td><textarea class="form-control" nname="saranOther[{{$i}}]" style="height: 50px;"></textarea></td>                 
                                            </tr>                                                                            
                                            @endfor                                                                                        
                                            @endif
                                        @endforeach  
                                    </tbody>
                                </table>
                            </div>       
                        @else     
                            <div class="row mb-3 d-none d-block" id="doc">
                                <label class="col-sm-2 col-form-label">FIles</label>
                                <div class="col-sm-6">
                                <input class="form-control" type="file" name="file" accept="application/pdf">       
                                @error('file')<div class='small text-danger text-left'>{{$message}}</div>@enderror                     
                                </div>
                            </div> 
                            <div class="mb-3" id="field">
                                <p class="h6 fw-bold py-3">{{$da->content->name}}</p>
                                <table class="table table-bordered border border-dark">
                                    <tbody>
                                        @php $no=0; @endphp
                                        @foreach($da->content->title as $row)
                                            @if($loop->first)                
                                                <tr class="fw-bold">
                                                    <td class="text-center">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                                                    <td>{{$row->name}}</td>
                                                    <td class="text-center">Status</td>                                                    
                                                    <td class="text-center">Catatan / Saran</td>
                                                </tr>
                                                @foreach($row->item as $items)
                                                <tr>
                                                    <td class="text-end">{{$loop->iteration}}</td>
                                                    <td>{{$items->name}}</td>           
                                                    <td>                                                        
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="1" {{(values($formulir->id,'items',$items->id)) == '1' ? 'checked' : null}}>
                                                            <label class="form-check-label">Ada</label>
                                                        </div>
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="0" {{(values($formulir->id,'items',$items->id)) == '0' ? 'checked' : null}}>
                                                            <label class="form-check-label">Tidak Ada</label>
                                                        </div>   
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="2" {{(values($formulir->id,'items',$items->id)) == '2' ? 'checked' : null}}>
                                                            <label class="form-check-label">Tidak Perlu</label>
                                                        </div>   
                                                    </td>                                         
                                                    <td><textarea class="form-control" name="saranItem[{{$items->id}}]"  style="height: 50px;">{{items($formulir->id,'saranItem',$items->id)}}</textarea></td>          
                                                </tr>
                                                    @foreach($items->sub as $key)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{abjad($loop->iteration)}} {{$key->name}}</td>     
                                                        <td>
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="1" {{(values($formulir->id,'sub',$key->id)) == '1' ? 'checked' : null}}>
                                                                <label class="form-check-label">Ada</label>
                                                            </div>
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="0" {{(values($formulir->id,'sub',$key->id)) == '0' ? 'checked' : null}}>
                                                                <label class="form-check-label">Tidak Ada</label>
                                                            </div>   
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="2" {{(values($formulir->id,'sub',$key->id)) == '2' ? 'checked' : null}}>
                                                                <label class="form-check-label">Tidak Perlu</label>
                                                            </div>   
                                                        </td>                                                      
                                                        <td><textarea class="form-control" name="saranSub[{{$key->id}}]" style="height: 50px;">{{items($formulir->id,'saranSub',$key->id)}}</textarea></td>                 
                                                    </tr>
                                                    @endforeach 
                                            @endforeach 
                                            @else                               
                                                <tr>
                                                    <td class="text-center fw-bold">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                                                    <td class="fw-bold" colspan="4">{{$row->name}} {{$row->id}}</td>           
                                                </tr>
                                                @foreach($row->item as $items)
                                                    <tr>
                                                        <td class="text-end">{{$loop->iteration}}</td>
                                                        <td>{{$items->name}}</td>           
                                                        <td>                                                        
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="1" {{(values($formulir->id,'items',$items->id)) == '1' ? 'checked' : null}}>
                                                                <label class="form-check-label">Ada</label>
                                                            </div>
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="0" {{(values($formulir->id,'items',$items->id)) == '0' ? 'checked' : null}}>
                                                                <label class="form-check-label">Tidak Ada</label>
                                                            </div>   
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="2" {{(values($formulir->id,'items',$items->id)) == '2' ? 'checked' : null}}>
                                                                <label class="form-check-label">Tidak Perlu</label>
                                                            </div>   
                                                        </td>                                         
                                                        <td><textarea class="form-control" name="saranItem[{{$items->id}}]"  style="height: 50px;">{{items($formulir->id,'saranItem',$items->id)}}</textarea></td>          
                                                    </tr>
                                                        @foreach($items->sub as $key)
                                                        <tr>
                                                            <td></td>
                                                            <td>{{abjad($loop->index)}}. {{$key->name}}</td>     
                                                            <td>
                                                                <div class="form-check d-inline-block">
                                                                    <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="1" {{(values($formulir->id,'sub',$key->id)) == '1' ? 'checked' : null}}>
                                                                    <label class="form-check-label">Ada</label>
                                                                </div>
                                                                <div class="form-check d-inline-block">
                                                                    <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="0" {{(values($formulir->id,'sub',$key->id)) == '0' ? 'checked' : null}}>
                                                                    <label class="form-check-label">Tidak Ada</label>
                                                                </div>   
                                                                <div class="form-check d-inline-block">
                                                                    <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="2" {{(values($formulir->id,'sub',$key->id)) == '2' ? 'checked' : null}}>
                                                                    <label class="form-check-label">Tidak Perlu</label>
                                                                </div>   
                                                            </td>                                                                                                                  
                                                            <td><textarea class="form-control" name="saranSub[{{$key->id}}]" style="height: 50px;">{{items($formulir->id,'saranSub',$key->id)}}</textarea></td>                 
                                                        </tr>
                                                        @endforeach 
                                                @endforeach 
                                            @endif

                                            @if($loop->last && $formulir->tipe)
                                            <tr>
                                                <td class="fw-bold">D.</td>
                                                <td class="fw-bold">Lain-lain</td>                                                
                                                <td class="fw-bold text-center">Status</td>                                                
                                                <td class="fw-bold text-center">Catatan / Saran</td>                                                
                                            </tr>
                                              @if($formulir->tipe)
                                              @for ($i = 0; $i < count($nameOther); $i++)                                                
                                              <tr>
                                                  <td>{{$i+1}}.</td>
                                                  <td><input type="text" name="nameOther[{{$i}}]" value="{{$nameOther[$i]}}" class="form-control"></td>     
                                                  <td>
                                                      <div class="form-check d-inline-block">
                                                          <input class="form-check-input" type="radio" name="other[{{$i}}]" value="1" {{($other[$i]=='1') ? 'checked' : null}}>
                                                          <label class="form-check-label">Ada</label>
                                                      </div>
                                                      <div class="form-check d-inline-block">
                                                          <input class="form-check-input" type="radio" name="other[{{$i}}]" value="0" {{($other[$i]=='0') ? 'checked' : null}}>
                                                          <label class="form-check-label">Tidak Ada</label>
                                                      </div>   
                                                      <div class="form-check d-inline-block">
                                                          <input class="form-check-input" type="radio" name="other[{{$i}}]" value="2" {{($other[$i]=='2') ? 'checked' : null}}>
                                                          <label class="form-check-label">Tidak Perlu</label>
                                                      </div>   
                                                  </td>                                                                                                                  
                                                  <td><textarea class="form-control" name="saranOther[{{$i}}]" style="height: 50px;">{{$saranOther[$i]}}</textarea></td>                 
                                              </tr>                                                                            
                                              @endfor   
                                              @else
                                              @for ($i = 0; $i < 5; $i++)                                                
                                                <tr>
                                                    <td>{{$i+1}}.</td>
                                                    <td><input type="text" name="nameOther[{{$i}}]" class="form-control"></td>     
                                                    <td>
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="other[{{$i}}]" value="1">
                                                            <label class="form-check-label">Ada</label>
                                                        </div>
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="other[{{$i}}]" value="0" checked="">
                                                            <label class="form-check-label">Tidak Ada</label>
                                                        </div>   
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="other[{{$i}}]" value="2">
                                                            <label class="form-check-label">Tidak Perlu</label>
                                                        </div>   
                                                    </td>                                                                                                                  
                                                    <td><textarea class="form-control" name="saranOther[{{$i}}]" style="height: 50px;"></textarea></td>                 
                                                </tr>                                                                            
                                                @endfor            
                                              @endif                                                                                                                             
                                            @endif
                                        @endforeach  
                                    </tbody>
                                </table>
                            </div>              
                        @endif
                        <div class=" mb-3" id="step-4">
                            <div class="col-12">
                                <label>Saran dan Masukkan Lain :</label>                                        
                                <div class="form-group">
                                <textarea class="form-control note" name="saran">{!! $saran !!}</textarea>
                                    @error('saran')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>  
                        </div>
                    @else             
                        <form action="{{route('formulir.store')}}" method="post" enctype="multipart/form-data">                           
                        @csrf     
                        <p class="h5 text-center fw-bold">{{$da->title}}</p>
                        <p class="text-center">No. {{$nomor}}/SPm-SIMBG/{{numberToRoman(date('m'))}}/{{date('Y')}}</p>    
                        <div class="row g-3 my-3" id="step-1">   
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="text" name="noreg" class="form-control" placeholder="No. Registrasi">
                                <label>No. Registrasi</label>
                                    @error('noreg')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-floating">                                
                                <select class="form-select" name="pengajuan" id="floatingSelect" placeholder="Pengajuan">
                                    <option value="pbg">PBG</option>
                                    <option value="slf">SLF</option>
                                    <option value="Lainnya">Lainnya</option>
                                  </select>
                                <label>Pengajuan</label>
                                    @error('Pengajuan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>   
                            <div class="col-md-6">
                                <div class="form-floating">                                                            
                                    <input type="text" name="nama" class="form-control"  placeholder="Nama">                                    
                                    <label>Nama</label>
                                    @error('nama')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>          
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="date" name="tanggal" class="form-control"  placeholder="Tanggal">
                                <label>Tanggal</label>
                                    @error('tanggal')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>                               
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="text" name="namaPemohon" class="form-control"  placeholder="Nama Pemohon">
                                <label>Nama Pemohon</label>
                                    @error('namaPemohon')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-floating">                                                            
                                    <input type="number" name="hp" class="form-control"  placeholder="No. Telp./HP">                                    
                                    <label>No. Telp. / HP</label>
                                    @error('hp')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select name="district" class="form-control select-field" id="dis">
                                        @foreach($dis as $row)
                                        <option value="{{$row->id}}"  {{ isset($doc) && ($doc->desa->kecamatan->id == $row->id) ? 'selected' : null }}   >{{$row->nama}}</option>
                                        @endforeach
                                    </select>
                                    @error('district')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">                                                            
                                    <label>Desa</label>
                                    <select name="village" class="form-control select-field" id="vil">                                                                      
                                    </select>
                                    @error('village')<div class='small text-danger text-left'>{{$message}}</div>@enderror                                        
                                </div>
                            </div>                             
                            <div class="col-12">
                                <div class="form-floating">
                                <textarea class="form-control" name="alamatPemohon" placeholder="Alamat Pemohon" style="height: 100px;"></textarea>
                                <label for="floatingTextarea">Alamat Pemohon</label>
                                    @error('alamatPemohon')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>      
                            <div class="col-md-6">
                                <div class="form-floating">
                                <input type="text" name="namaBangunan" class="form-control"  placeholder="Nama Bangunan">
                                <label>Nama Bangunan</label>
                                    @error('namaBangunan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-floating">                                                            
                                    <input type="text" name="fungsi" class="form-control"  placeholder="Fungsi">                                    
                                    <label>Fungsi</label>
                                    @error('fungsi')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>   
                            <div class="col-12">
                                <div class="form-floating">
                                <textarea class="form-control" name="alamatBangunan" placeholder="Alamat Bangunan" style="height: 100px;"></textarea>
                                <label for="floatingTextarea">Alamat Bangunan</label>
                                    @error('alamatBangunan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>         
                            <div class="col-md-6">
                                <div class="form-floating">                                                            
                                    <input type="text" name="status" class="form-control"  placeholder="Status">                                    
                                    <label>Status</label>
                                    @error('status')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>         
                            <div class="col-md-6">
                                <div class="form-floating">                                
                                <select class="form-select" name="tipe" id="tipe" placeholder="Tipe" required>                                        
                                    <option value="doc">Dokumen</option>
                                    <option value="field">Field</option>                                        
                                  </select>
                                <label>Tipe</label>
                                    @error('tipe')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>                           
                        </div>               
                        <div class="row mb-3 d-block" id="doc">
                            <label class="col-sm-2 col-form-label">FIles</label>
                            <div class="col-sm-6">
                            <input class="form-control" type="file" name="file" accept="application/pdf">       
                            @error('file')<div class='small text-danger text-left'>{{$message}}</div>@enderror                     
                            </div>
                        </div>                    
                        <div class="d-none mb-3" id="field">
                            <p class="h6 fw-bold py-3">{{$da->content->name}}</p>
                            <table class="table table-bordered border border-dark">
                                <tbody>
                                    @php $no=0; @endphp
                                    @foreach($da->content->title as $row)
                                        @if($loop->first)                
                                            <tr class="fw-bold">
                                                <td class="text-center">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                                                <td>{{$row->name}}</td>
                                                <td class="text-center">Status</td>                                                    
                                                <td class="text-center">Catatan / Saran</td>
                                            </tr>
                                            @foreach($row->item as $items)
                                            <tr>
                                                <td class="text-end">{{$loop->iteration}}</td>
                                                <td>{{$items->name}}</td>           
                                                <td>
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="1">
                                                        <label class="form-check-label">Ada</label>
                                                    </div>
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="0" checked="">
                                                        <label class="form-check-label">Tidak Ada</label>
                                                    </div>   
                                                    <div class="form-check d-inline-block">
                                                        <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="2">
                                                        <label class="form-check-label">Tidak Perlu</label>
                                                    </div>   
                                                </td>                                         
                                                <td><textarea class="form-control" name="saranItem[{{$items->id}}]"  style="height: 50px;"></textarea></td>          
                                            </tr>
                                                @foreach($items->sub as $key)
                                                <tr>
                                                    <td></td>
                                                    <td>{{abjad($loop->iteration)}} {{$key->name}}</td>     
                                                    <td>
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="1">
                                                            <label class="form-check-label">Ada</label>
                                                        </div>
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="0" checked="">
                                                            <label class="form-check-label">Tidak Ada</label>
                                                        </div>   
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="2">
                                                            <label class="form-check-label">Tidak Perlu</label>
                                                        </div>   
                                                    </td>                                                      
                                                    <td><textarea class="form-control" name="saranSub[{{$key->id}}]" style="height: 50px;"></textarea></td>                 
                                                </tr>
                                                @endforeach 
                                        @endforeach 
                                        @else                               
                                            <tr>
                                                <td class="text-center fw-bold">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                                                <td class="fw-bold" colspan="4">{{$row->name}} {{$row->id}}</td>           
                                            </tr>
                                            @foreach($row->item as $items)
                                                <tr>
                                                    <td class="text-end">{{$loop->iteration}}</td>
                                                    <td>{{$items->name}}</td>           
                                                    <td>
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="1">
                                                            <label class="form-check-label">Ada</label>
                                                        </div>
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="0" checked="">
                                                            <label class="form-check-label">Tidak Ada</label>
                                                        </div>   
                                                        <div class="form-check d-inline-block">
                                                            <input class="form-check-input" type="radio" name="item[{{$items->id}}]" value="2">
                                                            <label class="form-check-label">Tidak Perlu</label>
                                                        </div>   
                                                    </td>                                         
                                                    <td><textarea class="form-control" name="saranItem[{{$items->id}}]"  style="height: 50px;"></textarea></td>          
                                                </tr>
                                                    @foreach($items->sub as $key)
                                                    <tr>
                                                        <td></td>
                                                        <td>{{abjad($loop->index)}}. {{$key->name}}</td>     
                                                        <td>
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="1">
                                                                <label class="form-check-label">Ada</label>
                                                            </div>
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="0" checked="">
                                                                <label class="form-check-label">Tidak Ada</label>
                                                            </div>   
                                                            <div class="form-check d-inline-block">
                                                                <input class="form-check-input" type="radio" name="sub[{{$key->id}}]" value="2">
                                                                <label class="form-check-label">Tidak Perlu</label>
                                                            </div>   
                                                        </td>                                                                                                                  
                                                        <td><textarea class="form-control" name="saranSub[{{$key->id}}]" style="height: 50px;"></textarea></td>                 
                                                    </tr>
                                                    @endforeach 
                                            @endforeach 
                                        @endif

                                        @if($loop->last)
                                        <tr>
                                            <td class="fw-bold">D.</td>
                                            <td class="fw-bold">Lain-lain</td>                                                
                                            <td class="fw-bold text-center">Status</td>                                                
                                            <td class="fw-bold text-center">Catatan / Saran</td>                                                
                                        </tr>
                                        @for ($i = 0; $i < 5; $i++)                                                
                                        <tr>
                                            <td>{{$i+1}}.</td>
                                            <td><input type="text" name="nameOther[{{$i}}]" class="form-control"></td>     
                                            <td>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="other[{{$i}}]" value="1">
                                                    <label class="form-check-label">Ada</label>
                                                </div>
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="other[{{$i}}]" value="0" checked="">
                                                    <label class="form-check-label">Tidak Ada</label>
                                                </div>   
                                                <div class="form-check d-inline-block">
                                                    <input class="form-check-input" type="radio" name="other[{{$i}}]" value="2">
                                                    <label class="form-check-label">Tidak Perlu</label>
                                                </div>   
                                            </td>                                                                                                                  
                                            <td><textarea class="form-control" name="saranOther[{{$i}}]" style="height: 50px;"></textarea></td>                 
                                        </tr>                                                                            
                                        @endfor                                                                                        
                                        @endif
                                    @endforeach  
                                </tbody>
                            </table>
                        </div>                                                                            
                        <div class=" mb-3" id="step-4">
                            <div class="col-12">
                                <label>Saran dan Masukkan Lain :</label>
                                <div class="form-group">
                                <textarea class="form-control note" name="saran"></textarea>
                                    @error('saran')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>  
                        </div> 
                    @endisset                                                                     
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Save</button>                            
                            <a class="btn btn-danger" href="{{route('formulir.index')}}">Back</a>                     
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

$('#dis').on('change',function(e){
    e.preventDefault();    
    $('#vil').empty();
    $.ajax({
        type:'POST',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('village') }}",
        data:{id:$(this).val()},
        success:function(data){
            console.log(data);
            $.each(data, function(key, value) {
                $('#vil').append('<option value="' + key + '">' + value + '</option>');
            });
        }
    });
});

$('#tipe').on('change',function(e){
    e.preventDefault();
    if($(this).val() == 'doc')
    {
        $('#field').addClass('d-none');
        $('#doc').removeClass('d-none');
    }
    else
    {
        $('#field').removeClass('d-none');
        $('#doc').addClass('d-none');
    }
});

$('.note').summernote({        
    tabsize: 2,
    height: 120,
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],                    
    ]
    });

    var counter = 0;

    $("#add-header").on('click',function(){    
    counter++;    
    var newInput = $('<div class="input-group mb-3">\
      <input type="text" name="header[]" placeholder="item" class="form-control">\
      <button class="btn btn-danger remove-input" type="button"><i class="ri-close-circle-line"></i></button>\
    </div>');
    $('#input-header').append(newInput);
});

$(document).on('click', '.remove-input', function() {
    $(this).parent('.input-group').remove();
});

$( '.select-field' ).select2( {
theme: 'bootstrap-5'
});
</script>
@endpush
@endsection