<style type="text/css">
    table>thead>tr>th {
        text-align: center;
        height: 3rem;
    }

    .dt-search {
        padding-bottom: 10px;
    }

    .dt-paging {
        padding-top: 10px;
    }
</style>
<table class="table table-bordered table-sm table-striped shadow display nowrap" style="width: 100%" id="tbl">
    <thead>
        <tr>
            <th class="align-middle  text-center">#</th>
            <th class="align-middle  text-center">No. Pinjaman</th>
            <th class="align-middle  text-center">Tanggal Realisasi</th>
            <th class="align-middle text-center">Nama Karyawan</th>
            <th class="align-middle  text-center">Dept / Bagian</th>
            <th class="align-middle  text-center">Total Pinjaman</th>
            <th class="align-middle  text-center">Total Potongan</th>
            <th class="align-middle  text-center">Sudah Dipotong</th>
            <th class="align-middle  text-center">Sisa Potong</th>

            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $d)
            <tr>
                <td align="center" class="align-middle text-center">{{ $key + 1 }}</td>
                <td class="align-middle text-center">{{ $d->no_pinjaman }}</td>
                <td class="align-middle text-center">{{ varHelper::formatDate($d->tanggalRealisasi) }}</td>
                <td class="align-middle" style="width:25%">{{ $d->karyawanModel->namaKaryawan }}</td>
                <td class="align-middle text-center">
                    {{ $d->karyawanModel->departemen->kode }} /
                    {{ $d->karyawanModel->bagian->kode }} </td>
                <td class="align-middle text-left">
                    Rp. {{ number_format($d->totalPinjaman, 0, ',') }}
                </td>
                <td class="align-middle text-center">
                    {{ $d->totalPotongan }}
                </td>
                <td class="align-middle text-center">
                    {{ $d->sudahDipotong }}
                </td>
                <td class="align-middle text-center">
                    {{ $d->sisaPotongan }}
                </td>
                <td align="center" width="15%">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary btn-sm" id="btnEdit"
                            onclick="editData('{{ $d->no_pinjaman }}','{{ $d->tanggalRealisasi }}','{{ $d->idKaryawan }}','{{ $d->totalPinjaman }}','{{ $d->totalPotongan }}','{{ $d->sudahDipotong }}','{{ $d->sisaPotongan }}')"><i
                                class="far fa-edit"></i> Edit</button>
                        @can('admin')
                            <button type="button" class="btn btn-danger btn-sm" id="btnDelete"
                                onclick="deleteData('{{ $d->no_pinjaman }}','{{ $d->karyawanModel->namaKaryawan }}')"><i
                                    class="fas fa-trash-alt"></i>
                                Delete</button>
                        @endcan

                    </div>
                </td>
        @endforeach
    </tbody>
</table>
<script>
    $('#tbl').DataTable({
        responsive: true
    });
</script>
