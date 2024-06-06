@extends('_main/main')
@section('container')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Keterangan Ijin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data Master</li>
                        <li class="breadcrumb-item active"><a href="#">{{$title}}</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h5 class="m-0"></h5>
                        </div> --}}
                        <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-3">Kode Ijin</div>
                                    <div class="col-md-3">
                                        <input type="text" name="kode" id="kode" placeholder="kode" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">Keterangan</div>
                                    <div class="col-md-9">
                                        <textarea name="ket" id="ket" cols="400" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">Status</div>
                                    <div class="col-md-9">
                                       <select name="status" class="form-control" id="status">
                                        <option value="0">Tidak Aktif</option>
                                        <option value="1" selected>Aktif</option>
                                       </select>
                                    </div>
                                </div>
                                <div class="mt-3" align="right">
                                    <input type="hidden" id="token" value={{csrf_token()}}>
                                    <button type="button" class="btn btn-primary" id="btnSaveData">Simpan Data</button>
                                </div>
                            </div>
                            <div class="col-md-6" id="listView">
                             
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
    load();
    urlPage();
});

const load = () => {
    $.ajax({
        type:'get',
        url:'keterangan-ijin/tabelData',
        success:function(sdata){
            $('#listView').html(sdata);
        },
        error:function(error){
            alert('data not found');
        }
    })
}

 document.getElementById('btnSaveData').onclick = () => { 
    let token   = $('#token').val();
    let data = {
        'kode' : $('#kode').val(),
        'keterangan' : $('#ket').val(),
        'status': $('#status').val(),
        "_token": token,
    };
    
    $.ajax({
        type:'get',
        url:'keterangan-ijin/insert',
        data:data,
        success:function(sdata){
            let obj = JSON.parse(sdata);
            alert(obj.status);
            load();
        },
        error:function(error){
          let notes = error.responseJSON.errors; 
          alert(notes.kode);
          console.log(notes.responseJSON)
        }
    })

 }

 const urlPage = () => {
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            let page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });
}

    $(document).on('click', '.pagination a',function(event)
    {
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        event.preventDefault();
  
        // let myurl = $(this).attr('href');
        let page=$(this).attr('href').split('page=')[1];
  
        getData(page);
    });

    
    const getData=(page)=>{
        $.ajax({
            url:"keterangan-ijin/tabelData?page="+page,
            type: "get",
            datatype: "html",
        })  
        .done(function(data){
            $("#listView").empty().html(data);
            location.hash = page;
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
              alert('No response from server');
        });
    }
</script>
@endsection