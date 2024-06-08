@extends('_main/main')
@section('container')
@flasher_render()
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
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
                        <div class="card-header">
                            <h5 class="m-0">Keterangan Ijin</h5>
                        </div>
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
                                        <button type="button" class="btn btn-primary" id="btnSaveData">
                                        <span class="far fa-save" id="load" aria-hidden="true"></span>
                                        Simpan Data</button>
                                        <button type="button" class="btn btn-success d-none" id="btnUpdateData">
                                            <span class="far fa-save" id="loadUpdate" aria-hidden="true"></span>
                                        Update Data</button>
                                </div>
                            </div>
                          
                            <div class="col-md-6 pt-2">
                                <button type="button" class="btn btn-sm btn-info d-none mb-2" id="showButton">
                                    <span class="far fa-plus" aria-hidden="true"></span>Add Data</button>

                                <div class="text-center" id="spin">
                                    <div class="spinner-grow text-info m-5" style="width: 3rem; height: 3rem;" role="status">
                                      <span class="sr-only">Loading...</span>
                                    </div>
                                  </div>
                                <div class="table-responsive" id="listView"></div>
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
            document.getElementById('spin').style.display = 'none';
        },
        error:function(error){
            alert('data not found');
        }
    })
}

    let loadBtnSave =()=> {
    let x = document.getElementById('load');
    x.classList.remove('far','fa-save');
    x.classList.add('spinner-border','spinner-border-sm');
    document.getElementById('btnSaveData').disabled=true;
    }

    let removeBtnSave =()=> {
    let x = document.getElementById('load');
    x.classList.remove('spinner-border','spinner-border-sm');
    x.classList.add('far','fa-save');
    document.getElementById('btnSaveData').disabled=false;
    load();
    }

    let addInvalid = () => {
        document.getElementById('kode').classList.add('is-invalid');
        document.getElementById('kode').focus();
    }

    let removeInvalid = () => {
        document.getElementById('kode').classList.remove('is-invalid');
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
        beforeSend:function(){
         loadBtnSave();
        },
        type:'post',
        url:'keterangan-ijin/insert',
        data:data,
        success:function(sdata){
                $('#kode').val('');
                $('#ket').val('');
            let obj = JSON.parse(sdata);
            flasher.success('Data Berhasil disimpan');
            removeInvalid();
            removeBtnSave();
        },
        error:function(error){
        //   let notes = error.responseJSON.errors; 
        //   flasher.error(notes.kode.toString());
        addInvalid();
        flasher.error(`${error.responseJSON.errors.kode}`);
        removeBtnSave();
        }
    })
 }


 let deleteData = (id,kode) =>{
    let dataId= {
        'id' : id,
    };
            Swal.fire({
            title: "Do you want to delete kode "+kode+"?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Delete",
            denyButtonText: `Cancel`,
            denyButtonColor: `#636363`,
            confirmButtonColor: '#ff2c2c',
            }).then((result) => {

            if (result.isConfirmed) {
                    $.ajax({
                            type:'get',
                            url:'keterangan-ijin/delete',
                            data:dataId,
                            success:function(){
                                load();
                            },
                            error:function(){
                                flasher.error('Data Gagal dihapus')
                            }

                        });
                Swal.fire("Data Berhasil dihapus", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
            });
 }

 let editData = (kode,ket,status) => {
    $('#kode').val(kode);
    $('#ket').val(ket);
    document.getElementById("status").value = status;
    document.getElementById('btnUpdateData').classList.remove('d-none');
    document.getElementById('btnSaveData').classList.add('d-none');
    document.getElementById('showButton').classList.remove('d-none');
 }

 document.getElementById('showButton').onclick = () => {
    document.getElementById('btnSaveData').classList.remove('d-none');
    document.getElementById('btnUpdateData').classList.add('d-none');
    document.getElementById('showButton').classList.add('d-none');
 }

//pagination ajax
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
            flasher.error("Oops! Something went wrong!");
        });
    }
    //end pagination
</script>
@endsection