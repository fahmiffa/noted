<!DOCTYPE html>
<html>
<head>
    <title>{{env('APP_NAME')}}</title>    
</head>
<style>

  body{
    font-size: 12px;    
  }

    table {
    border-collapse: collapse;
    border-spacing: 0;
  }
  
  td {
    border: 1px solid black;    
  }

</style>
<body>
  <header>    
    <table style="width: 100%; border:none">
      <tr>
        <td style="border:none"><img width="50%" src="{{gambar('kab.png')}}" style="display: block;float: right;" /></td>
        <td width="70%" style="border:none; text-align:center">
          <p><span style="font-weight: bold; font-size:0.8rem">{{$form->title}}</span>
          <br>No. {{$formulir->nomor}}
          </p>
        </td>
        <td style="border:none"><img width="50%" src="{{gambar('logo.png')}}" style="display:block;float: left;" /></td>
      </tr>
    </table>             
  </header>
  <main style="margin-top: 1rem">
    <div style="margin: auto; display:block; width:600px; max-width:100%">
      @php  $header = json_decode($form->header->item);
      $in = 0;
      $nameOther = $item->nameOther;          
      $saranOther = $item->saranOther;
      $other = $item->other;  
      @endphp      
        <table style="width:100%" align="center">          
          <tr>
              @foreach ($header as $item)            
                  @if($item)
                    <td width="40%" style="border:none">{{$item}} </td>
                    <td width="60%" style="border:none">: {{headers($formulir->id,'header',$in++)}}</td>                                            
                  @endif    
                  @if($loop->iteration % 2 === 0)               
                </tr><tr>
                  @endif                
                @endforeach                    
        </table>          
    </div>        
  
    <p style="font-weight: bold; margin-top:1rem;">{{$form->content->name}}</p>
    <table autosize="1" style="width: 100%">        
            @php $no=0; @endphp
            @foreach($form->content->title as $row)        
                @if($loop->first)                
                    <tr style="font-weight: bold; text-align:center">
                        <td width="5%">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                        <td width="50%">{{$row->name}}</td>
                        <td width="10%" style="font-weight: bold; text-align:center">Status</td>                        
                        <td width="35%">Catatan / Saran</td>
                    </tr>
                    @foreach($row->item as $items)
                      @if(values($formulir->id,'items',$items->id) != '2')
                      <tr>
                          <td style="text-align: right">{{$loop->iteration}}&nbsp;</td>
                          <td>{{$items->name}}</td>           
                          <td style="text-align:center">{{items($formulir->id,'items',$items->id)}}</td>
                          <td>{{items($formulir->id,'saranItem',$items->id)}}</td>
                      </tr>
                          @foreach($items->sub as $key)
                          @if(values($formulir->id,'sub',$key->id) != '2')
                          <tr>
                              <td></td>
                              <td>{{abjad($loop->iteration)}} {{$key->name}}</td>     
                              <td style="text-align:center">{{items($formulir->id,'sub',$key->id)}}</td>
                              <td>{{items($formulir->id,'saranSub',$key->id)}}</td>
                          </tr>
                          @endif
                          @endforeach 
                      @endif
                    @endforeach 
                @else           
                <tr style="font-weight: bold;">
                    <td style="text-align: center">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                    <td colspan="3">{{$row->name}}</td>           
                </tr>
                @foreach($row->item as $items)
                  @if(values($formulir->id,'items',$items->id) != '2')
                      <tr>
                          <td style="text-align: right">{{$loop->iteration}}&nbsp;</td>
                          <td>{{$items->name}}</td>           
                          <td style="text-align:center">{{items($formulir->id,'items',$items->id)}}</td>
                          <td>{{items($formulir->id,'saranItem',$items->id)}}</td>                     
                      </tr>
                        @foreach($items->sub as $key)
                        @if(values($formulir->id,'sub',$key->id) != '2')
                        <tr>
                            <td></td>
                            <td>{{abjad($loop->index)}}. {{$key->name}}</td>                                 
                            <td style="text-align:center">{{items($formulir->id,'sub',$key->id)}}</td>
                            <td>{{items($formulir->id,'saranSub',$key->id)}}</td>
                        </tr>
                        @endif
                        @endforeach 
                    @endif
                @endforeach 
                @endif

                @if($loop->last && count($nameOther) > 0)
                <tr style="font-weight: bold;">
                  <td style="text-align: center">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                  <td colspan="3">Lain-lain</td>           
                </tr>
                @for ($i = 0; $i < count($nameOther); $i++)  
                  @if($nameOther[$i])
                    <tr>                  
                      <td style="text-align: right">{{$i+1}}.</td>
                      <td>{{$nameOther[$i]}}</td>     
                      <td style="text-align: center">
                        @if($other[$i]== '1')
                        Ada
                        @elseif($other[$i] == '0')
                        Tidak Ada
                        @elseif($other[$i] == '2')
                        Tidak perlu
                        @endif                    
                      </td>                                                                                                                  
                      <td>{{$saranOther[$i]}}</td>                 
                  </tr>
                @endif
                @endfor
                @endif
            @endforeach          
    </table>
  </main>
  {{-- bottom --}}
  <div>      
      <p>Saran dan Masukkan Lain : <br>{!! $saran !!}</p>               
      <table style="width:100%">          
        <tr>         
            <td width="70%" style="border:none">
              <p style="font-style: italic">Catatan :</p> 
              <p style="font-style: italic">*) Berlaku untuk :
              <br><span style="margin-left:1rem">a. bangunan perumahan (yang disahkan oleh dinas terkait)</span>
              <br><span style="margin-left:1rem">b. bangunan kolektif / kawasan (industri, wisata, dsb.)</span>
              </p>
              <p style="font-style: italic">**) Berlaku untuk :
                <br><span style="margin-left:1rem">a. bangunan diatas 2 lantai dan/atau memiliki basement</span>
                <br><span style="margin-left:1rem">b. konstruksi baja dengan bentang lebih dari 15 meter</span>
              </p>
            </td>
            <td width="30%" style="border:none">
              <div style="text-align:center">Slawi, 02 Juni 2023,</div>                            
              <center><img src="data:image/png;base64, {{ $qrCode }}"></center>
              <div style="text-align:center">DPUPR Kabupaten Tegal</div>
            </td>                                                                     
        </tr>
      </table>    
  </div>

</body>
</html>