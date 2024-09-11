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
                        <li class="breadcrumb-item">Payroll</li>
                        <li class="breadcrumb-item">Overtime</li>
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
                    <form action="store" method="get">
                        <div class="card">
                            <div class="card-header">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="tglLembur">Tanggal Lembur</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="date" name="tglLembur" id="tglLembur"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col-md-3">
                                                    <label for="bagian">Bagian</label>
                                                </div>
                                                <div class="col-md-5">
                                                    <select name="bagian" id="bagian" class="form-control select">
                                                        @foreach ($bagian as $b)
                                                            <option value="{{ $b->id }}">{{ $b->namaBagian }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-success">Save Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <table class="table table-striped table-bordered" id="dataProses">
                                    <thead>
                                        <tr>
                                            <th style="width:25%">
                                                Nama Karyawan
                                            </th>
                                            <th style="width:10%">
                                                jam Lembur
                                            </th>
                                            <th style="width: 60%">
                                                jenis Pekerjaan
                                            </th>
                                            <th style="width: :5%">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="nomor[]" value="1">
                                                <select name="karyawan[]" id="karyawan[]" class="form-control select">
                                                    @foreach ($karyawan as $k)
                                                        <option value="{{ $k->id }}">
                                                            {{ $k->namaKaryawan }} ({{ $k->nikKerja }})</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" min="0" max="7" value="1"
                                                    class="form-control" name="jamLembur[]">
                                            </td>
                                            <td>
                                                <Textarea class="form-control" name="jp[]" cols="2" rows="1"></Textarea>
                                            </td>
                                            <td>
                                                <button type="button" class="add btn btn-primary btn-sm">
                                                    <span class="fas fa-plus" id="set"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {});
        let nomor = 1;
        $(document).on('click', '.add', function() {
            $(this).removeClass('btn-primary').addClass('btn-danger')
            $(this).children('#set').removeClass('fas fa-plus').addClass('fas fa-trash')
            $(this).removeClass('add').addClass('remove')
            nomor++;
            let newline =
                "<tr><td>" +
                "<input type='hidden' name='nomor[]' value='" + nomor + "'>" +
                "<select name='karyawan[" + nomor + "]' id='karyawan[" + nomor + "]' class='form-control select'>" +
                @foreach ($karyawan as $k)
                    "<option value='{{ $k->id }}'>{{ $k->namaKaryawan }} ({{ $k->nikKerja }})</option>" +
                @endforeach
            "</select></td>" +
            "<td>" +
            "<input type='number' min='1' class='form-control' name='jamLembur[" + nomor + "]'></td>" +
                "<td>" +
                "<Textarea class='form-control' name='jp[" + nomor + "]' cols='2' rows='1'></Textarea></td>" +
                "<td>" +
                "<button type='button' class='add btn btn-primary btn-sm'> <span id='set' class='fas fa-plus'></span></button></td></tr>";
            $('#dataProses').append(newline);
            refresh();
        });

        $(document).on('click', '.remove', function() {
            $(this).parent().parent().remove();
        });

        let refresh = () => {
            $('.select').select2({
                theme: 'bootstrap4'
            })
        }
    </script>
@endsection
