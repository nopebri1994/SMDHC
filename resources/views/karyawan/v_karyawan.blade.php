@extends('_main/main')
@section('container')
    <style type="text/css">
        .hidden {
            visibility: hidden;
            opacity: 0;
            display: none,
        }

        @keyframes alertHide {
            0% {
                transition: visibility 0s 2s, opacity 2s linear;
            }

            100% {
                display: none,
            }
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Data Karyawan</li>
                        <li class="breadcrumb-item active"><a href="#">{{ $title }}</a></li>
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
                            {{-- <h5 class="m-0">{{ $title }}</h5> --}}
                            @can('hc')
                                <div class="d-flex flex-row flex-wrap">
                                    <div class="p-2"><label for="">Perusahaan</label></div>
                                    <div class="" style="width: 400px">
                                        <select name="perusahaan" id="perusahaan" class="form-control">
                                            @foreach ($perusahaan as $p)
                                                <option value="{{ $p->id }}">{{ $p->namaPerusahaan }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="pt-2 ml-auto">
                                        <a href="{{ URL::to('/') }}/dk/karyawan/addData"
                                            class="btn-sm btn-block btn-primary"><i class="fa fa-plus"></i>
                                            Add Data</a>
                                    </div>
                                </div>
                            @endcan
                        </div>
                        <div class="card-body">
                            {{-- <form action="karyawan/export" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="file" name="file">
                                <button>export</button>
                            </form> --}}
                            @if (session('status'))
                                <div class="alert alert-dismissible fade show" style="background-color: #bee6ff">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" id='alert'
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="table-responsive-md">
                                <div id="list"></div>
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
        $(document).ready(function() {
            loadData();
            alert();
        })

        document.getElementById('perusahaan').onchange = () => {
            loadData();
        }

        let loadData = () => {
            data = {
                'perusahaan': $('#perusahaan').val()
            }
            $.ajax({
                beforeSend: openLoader('Memuat Data'),
                type: 'get',
                url: 'karyawan/tableData',
                data: data,
                success: function(sdata) {
                    $('#list').html(sdata);
                    closeLoader();
                },
                error: function(error) {
                    flasher.error('Server Error')
                    closeLoader();
                }
            })
        }

        let alert = () => {
            let x = document.getElementById("alert");
            setTimeout(() => {
                x.click();
            }, 2000);
        }
    </script>
@endsection
