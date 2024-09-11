@extends('_main/main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Personalia</li>
                        <li class="breadcrumb-item">Kebutuhan Pelatihan</li>
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
                        <form method="post" action="store" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-12">
                                    @error('file')
                                        <div class="alert alert-danger" role="alert">
                                            Format file Harus PDF
                                        </div>
                                    @enderror
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="idKaryawan">Nama Karyawan</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="idKaryawan" id="idKaryawan" class="select form-control">
                                                        @foreach ($karyawan as $k)
                                                            <option value="{{ $k->id }}">{{ $k->namaKaryawan }}
                                                                ({{ $k->nikKerja }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row pt-3">
                                                <div class="col-md-3">
                                                    <label for="idKaryawan">Type Kebutuhan Pelatihan</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" value="1"
                                                                type="radio" id="radio1" name="type" checked>
                                                            <label for="radio1" class="custom-control-label">Peningkatan
                                                                Wawasan dan Pengetahuan dalam Menunjang Prestasi
                                                                Kerja</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" value="2"
                                                                type="radio" id="radio2" name="type">
                                                            <label for="radio2"
                                                                class="custom-control-label">Mutasi</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" value="3"
                                                                type="radio" id="radio3" name="type">
                                                            <label for="radio3"
                                                                class="custom-control-label">Promosi</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input" value="0"
                                                                type="radio" id="radio4" name="type">
                                                            <label for="radio4" class="custom-control-label">Lain
                                                                Lain</label>
                                                        </div>
                                                    </div>
                                                    <textarea name="typeLain" id="typeLain" cols="5" rows="3" class="form-control" disabled></textarea>
                                                </div>
                                            </div>
                                            <div class="row pt-3">
                                                <div class="col-md-3">
                                                    <label for="idKaryawan">Jenis Pelatihan</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input custom-control-input-danger"
                                                                value="1" type="radio" id="jenis1" name="jenis"
                                                                checked>
                                                            <label for="jenis1" class="custom-control-label">OJT</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input custom-control-input-danger"
                                                                value="2" type="radio" id="jenis2" name="jenis">
                                                            <label for="jenis2"
                                                                class="custom-control-label">Training</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class=" custom-control-input custom-control-input-danger"
                                                                value="3" type="radio" id="jenis3"
                                                                name="jenis">
                                                            <label for="jenis3"
                                                                class="custom-control-label">Seminar</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input custom-control-input-danger"
                                                                value="4" type="radio" id="jenis4"
                                                                name="jenis">
                                                            <label for="jenis4"
                                                                class="custom-control-label">Briefing</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input class="custom-control-input custom-control-input-danger"
                                                                value="5" type="radio" id="jenis5"
                                                                name="jenis">
                                                            <label for="jenis5"
                                                                class="custom-control-label">Workshop</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input
                                                                class=" custom-control-input custom-control-input-danger"
                                                                value="0" type="radio" id="jenis6"
                                                                name="jenis">
                                                            <label for="jenis6" class="custom-control-label">Lain
                                                                Lain</label>
                                                        </div>
                                                    </div>
                                                    <textarea name="jenisLain" id="jenisLain" cols="5" rows="3" class="form-control" disabled></textarea>
                                                </div>
                                            </div>
                                            <div class="row pt-3">
                                                <div class="col-md-3">
                                                    <label for="tglPelatihan">Tanggal Pelatihan</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <input type="date" class="form-control" id="tglPelatihan"
                                                                name="awal" required>
                                                        </div>
                                                        <div class="col-md-1 pt-2 text-center">
                                                            <b>s/d</b>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input type="date" class="form-control" name="akhir"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-3">
                                                <div class="col-md-3">
                                                    <label for="tglPelatihan">File Kebutuhan Pelatihan</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="custom-file">
                                                        <input type="file" name="file" class="custom-file-input"
                                                            id="fileUpload" accept="application/pdf" required>
                                                        <label class="custom-file-label" for="fileUpload">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pt-3">
                                                <div class="col-md-12" align="right">
                                                    <button type="submit" class="btn btn-primary btn-sm"><i
                                                            class="fas fa-save"></i>&nbsp; Simpan
                                                        Data</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.getElementById('radio4').onclick = () => {
            document.getElementById('typeLain').disabled = false;
        }

        document.getElementById('radio3').onclick = () => {
            document.getElementById('typeLain').disabled = true;
        }
        document.getElementById('radio2').onclick = () => {
            document.getElementById('typeLain').disabled = true;
        }
        document.getElementById('radio1').onclick = () => {
            document.getElementById('typeLain').disabled = true;
        }

        document.getElementById('jenis6').onclick = () => {
            document.getElementById('jenisLain').disabled = false;
        }
        document.getElementById('jenis5').onclick = () => {
            document.getElementById('jenisLain').disabled = true;
        }
        document.getElementById('jenis4').onclick = () => {
            document.getElementById('jenisLain').disabled = true;
        }
        document.getElementById('jenis3').onclick = () => {
            document.getElementById('jenisLain').disabled = true;
        }
        document.getElementById('jenis2').onclick = () => {
            document.getElementById('jenisLain').disabled = true;
        }
        document.getElementById('jenis1').onclick = () => {
            document.getElementById('jenisLain').disabled = true;
        }

        $('#fileUpload').on('change', function() {
            //get the file name
            let fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
@endsection
