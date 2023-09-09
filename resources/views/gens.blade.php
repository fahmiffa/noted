<!DOCTYPE html>
<html>
<head>
    <title>{{env('APP_NAME')}}</title>
    {{-- <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">     --}}
</head>
<style>

  body{
    font-size: 12px;
    /* padding: 2px; */
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
          <br>No.&nbsp;&nbsp;&nbsp;/SPm-SIMBG/&nbsp;&nbsp;&nbsp;/2023
          </p>
        </td>
        <td style="border:none"><img width="50%" src="{{gambar('logo.png')}}" style="display:block;float: left;" /></td>
      </tr>
    </table>             
  </header>
  <main style="margin-top: 1rem">
    <div style="margin: auto; display:block; width:600px; max-width:100%">
      @php  $header = json_decode($form->header->item); @endphp      
        <table style="width:100%" align="center">          
          <tr>
              @foreach ($header as $item)            
                  @if($item)
                    <td width="40%" style="border:none">{{$item}} </td>
                    <td width="60%" style="border:none">: tes</td>                                            
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
                        <td width="5%" class="text-center">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                        <td width="50%">{{$row->name}}</td>
                        <td width="10%">Status</td>                        
                        <td width="35%">Catatan / Saran</td>
                    </tr>
                    @foreach($row->item as $items)
                      <tr>
                          <td style="text-align: right">{{$loop->iteration}}&nbsp;</td>
                          <td>{{$items->name}}</td>           
                          <td></td>
                          <td></td>                        
                      </tr>
                          @foreach($items->sub as $key)
                          <tr>
                              <td></td>
                              <td>{{abjad($loop->iteration)}} {{$key->name}}</td>     
                              <td></td>
                              <td></td>                            
                          </tr>
                          @endforeach 
                    @endforeach 
                @else           
                <tr style="font-weight: bold;">
                    <td style="text-align: center">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                    <td colspan="3">{{$row->name}}</td>           
                </tr>
                @foreach($row->item as $items)
                      <tr>
                          <td style="text-align: right">{{$loop->iteration}}&nbsp;</td>
                          <td>{{$items->name}}</td>           
                          <td></td>
                          <td></td>                             
                      </tr>
                        @foreach($items->sub as $key)
                        <tr>
                            <td></td>
                            <td>{{abjad($loop->index)}}. {{$key->name}}</td>     
                            <td></td>                            
                            <td></td>            
                        </tr>
                        @endforeach 
                @endforeach 
                @endif
            @endforeach          
    </table>
  </main>
  <div>      
      <p>Saran dan Masukkan Lain :</p>         
      
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
              <p style="text-align:center">Slawi, 02 Juni 2023,</p>              
              {{-- <img width="25%" src="{{gambar('kab.png')}}" style="margin-left:35%; display:block"/>       --}}
              <center><img src="data:image/png;base64, {{ $qrCode }}"></center>
              <p style="text-align:center">DPUPR Kabupaten Tegal</p>
            </td>                                                                     
        </tr>
      </table>    
  </div>

</body>
</html>