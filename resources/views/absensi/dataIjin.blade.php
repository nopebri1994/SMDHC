<style type="text/css">
    .dt-search {
        padding-bottom: 10px;
    }
</style>
<div class="table-responsive">
    <table class="table table-striped nowrap" width="100%" id="tbl">
        <thead class="pt-2">
            <tr>
                {{-- <th>#</th> --}}
                <th>NIK</th>
                <th>Nama Karyawan</th>
                <th>Bagian</th>
                <th>Ijin</th>
                <th>Tanggal</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensi as $key => $a)
                <tr>
                    {{-- <td>{{ $key + 1 }}</td> --}}
                    <td>{{ $a->karyawan->nikKerja }}</td>
                    <td width="35%">{{ $a->karyawan->namaKaryawan }}</td>
                    <td>{{ $a->karyawan->departemen->kode }}/{{ $a->karyawan->bagian->kode }}</td>
                    <td>{{ $a->keteranganIjin->kode }}</td>
                    <td>{{ varHelper::formatDate($a->tanggalIjin) }}</td>
                    <td>
                        @can('hc')
                            @if ($a->status == 0)
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="status{{ $a->id }}"
                                        onchange="updateStatus({{ $a->id }})">
                                    <label class="custom-control-label" for="status{{ $a->id }}"></label>
                                </div>
                            @else
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="status{{ $a->id }}"
                                        onchange="updateStatus({{ $a->id }})" checked>
                                    <label class="custom-control-label" for="status{{ $a->id }}"></label>
                                </div>
                            @endif
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $('#tbl').DataTable();
</script>