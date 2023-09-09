<!DOCTYPE html>
<html>
<head>
    <title>{{env('APP_NAME')}}</title>
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">    
</head>
<style>
    body{
        font-size: 12px;
        padding: 1rem;
    }
    .my-line {
      border: none;
      height: 1px;
      background-color: black;
      width: 100%;
      margin: 0 auto;
    }

    .table>:not(caption)>*>* {
    padding: 0.1rem 0.1rem;
}

table {
    page-break-inside: auto;
  }

  tr {
    page-break-inside: avoid;
  }

    .my-lines {
      border: none;
      height: 1px;
      background-color: black;
      width: 100%;
      margin: 0 auto;
    }

</style>
<body>
<div class="container" id="pdf">
    <p class="text-center h6 fw-bolder">{{$form->title}}</p>
    <p class="text-center">No.&nbsp;&nbsp;&nbsp;/SPm-SIMBG/&nbsp;&nbsp;&nbsp;/2023</p>
    <div class="row">
        @php  $header = json_decode($form->header->item); @endphp
        @foreach ($header as $item)
                <div class="col-3">{{$item}}</div>            
            @if($item)
                <div class="col-3">:  <hr class="my-line"></div>            
            @else
                <div class="col-3">&nbsp;&nbsp;&nbsp;</div>            
            @endif
        @endforeach
    </div>
    <p class="fw-bold mt-1">{{$form->content->name}}</p>
    <table class="table table-bordered border border-dark">
        <tbody>
            @php $no=0; @endphp
            @foreach($form->content->title as $row)
                @if($loop->first)                
                    <tr class="fw-bold">
                        <td class="text-center">{{$alphabet_letter = chr(65 + $no++)}}.</td>
                        <td>{{$row->name}}</td>
                        <td class="text-center">Ada</td>
                        <td class="text-center">Tidak Ada</td>
                        <td class="text-center">Catatan / Saran</td>
                    </tr>
                    @foreach($row->item as $items)
                    <tr>
                        <td class="text-end">{{$loop->iteration}}</td>
                        <td>{{$items->name}}</td>           
                        <td></td>
                        <td></td>
                        <td></td>          
                    </tr>
                        @foreach($items->sub as $key)
                        <tr>
                            <td></td>
                            <td>{{abjad($loop->iteration)}} {{$key->name}}</td>     
                            <td></td>
                            <td></td>
                            <td></td>            
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
                            <td></td>
                            <td></td>
                            <td></td>                        
                        </tr>
                            @foreach($items->sub as $key)
                            <tr>
                                <td></td>
                                <td>{{abjad($loop->index)}}. {{$key->name}}</td>     
                                <td></td>
                                <td></td>
                                <td></td>            
                            </tr>
                            @endforeach 
                    @endforeach 
                @endif
            @endforeach  
        </tbody>
    </table>
    <p class="mt-1">Saran dan Masukkan Lain :</p> 
    @for ($i = 0; $i < 3; $i++)  
        @if($i == 5)        
        <hr class="my-lines">
        @else        
        <hr class="my-lines"><br>
        @endif      
    @endfor
    <div class="text-end" style="margin-right: 25rem">Slawi,</div>
    <hr class="my-lines"><br>
    <div class="row">
        <div class="col-7">
            <p class="mb-0 fst-italic">Catatan :</p>                        
            <table class="table table-borderless fst-italic">          
                <tbody>
                  <tr>
                    <td colspan="2">*) Berlaku untuk :</td>       
                  </tr>
                  <tr>
                    <td></td>
                    <td>a. bangunan perumahan (yang disahkan oleh dinas terkait)</td>       
                  </tr>
                  <tr>
                    <td></td>
                    <td>b. bangunan kolektif / kawasan (industri, wisata, dsb.)</td>       
                  </tr>             
                  <tr>
                    <td colspan="2">**) Berlaku untuk :</td>   
                    <tr>
                        <td></td>
                        <td>a. bangunan diatas 2 lantai dan/atau memiliki basement</td>       
                      </tr>
                      <tr>
                        <td></td>
                        <td>b. konstruksi baja dengan bentang lebih dari 15 meter</td>       
                      </tr>         
                  </tr>          
                </tbody>
            </table>
        </div>
        <div class="col-5">            
            <p class="mb-0">Verifikator, </p>                        
            <table class="table table-bordered border border-dark">          
                <tbody style="height: 100px">
                    @for ($i = 0; $i < 5; $i++)   
                        <tr>
                            <td></td>      
                            <td></td>      
                            <td></td>      
                        </tr>          
                    @endfor
                </tbody>
            </table>
        </div>                
    </div>
</div>
<div class="container row">
    <div class="col-6 mx-auto">
        <button type="button" onclick="convertToPDF()" class="btn btn-sm btn-danger">PDF</button>
    </div>
</div>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<script>
    function convertToPDF() {
        const element = document.getElementById("pdf");
        const opt = {
            margin: [0.5, 0.3, 1, 0.3], //top, left, buttom, right,
            filename: 'data.pdf',
            image: { type: 'jpeg', quality: 0.95 },
            html2canvas: { scale: 1 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
            footer: {
            height: "40mm",
            contents: {
            default: '<div style="text-align: center;"><span class="pageNumber"></span>/<span class="totalPages"></span></div>'
                }
            }
        };

        html2pdf().set(opt).from(element).save();
    }
</script>
</body>
</html>