<style type="text/css">
    .dt-search {
        padding-bottom: 10px;
    }
</style>
<div class="table-responsive">
    <table class="table table-sm table-striped nowrap" width="100%" id="tbl">
        <thead class="pt-2">
            <tr>
                <th>#</th>
                <th>NIK</th>
                <th>Nama Karyawan</th>
                <th>Bagian</th>
                <th>Ijin</th>
                <th style="text-align: center">Tanggal</th>
                <th style="width:12%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensi as $key => $a)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td>{{ $a->karyawanModel->nikKerja }}</td>
                    <td width="35%">{{ $a->karyawanModel->namaKaryawan }}</td>
                    <td>{{ $a->karyawanModel->departemen->kode }}/{{ $a->karyawanModel->bagian->kode }}</td>
                    <td @if ($a->keteranganIjin->kode == 'BDU') style="background-color:rgb(103,194,208)" @endif>
                        {{ $a->keteranganIjin->kode }}</td>
                    <td data-sort="{{ $a->tanggalIjin }}" style="text-align:center">
                        {{ varHelper::formatDate($a->tanggalIjin) }}&nbsp;</td>
                    <td>
                        @can('hc')
                            <div class="row" style="display: flex; justify-content: center">
                                @if ($a->status == 0)
                                    <div
                                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" id="status{{ $a->id }}"
                                            onchange="updateStatus({{ $a->id }})">
                                        <label class="custom-control-label" for="status{{ $a->id }}"></label>
                                    </div>
                                @else
                                    <div
                                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" id="status{{ $a->id }}"
                                            onchange="updateStatus({{ $a->id }})" checked>
                                        <label class="custom-control-label" for="status{{ $a->id }}"></label>
                                    </div>
                                @endif
                                <div>
                                    &nbsp;
                                    <a href="#" data-toggle="tooltip" title="Hapus Data"
                                        onclick="deleteData({{ $a->id }},'{{ $a->keteranganIjin->kode }}','{{ $a->tanggalIjin }}',{{ $a->idKaryawan }})"><span
                                            class="fas fa-trash-alt" style="color: red"></span></a>
                                </div>
                            </div>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
Keterangan : BDU (Belum Di Urus)
<script>
    $('#tbl').DataTable({
        responsive: true,
        // columnDefs: [
        // { responsivePriority: 1, targets: -1 },
        // ]
    });
</script>
