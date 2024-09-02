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
            <th class="align-middle text-center">Nama Karyawan</th>
            <th class="align-middle  text-center">Dept / Bagian</th>
            <th class="align-middle  text-center">username</th>
            <th class="align-middle  text-center">Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $d)
            <tr>
                <td align="center" class="align-middle text-center">{{ $key + 1 }}</td>
                <td class="align-middle">{{ $d->karyawan->namaKaryawan }}</td>
                <td class="align-middle text-center">{{ $d->karyawan->departemen->kode }} /
                    {{ $d->karyawan->bagian->kode }}
                </td>
                <td class="align-middle text-center">{{ $d->username }}</td>
                <td class="align-middle text-center">
                    @switch($d->role)
                        @case(1)
                            Super Admin
                        @break

                        @case(2)
                            staf HC /Payroll
                        @break

                        @case(3)
                            staf HC /Personalia
                        @break

                        @case(4)
                            Admin Departemen
                        @break

                        @default
                            Admin Bagian
                    @endswitch
                </td>
        @endforeach
    </tbody>
</table>
<script>
    $('#tbl').DataTable({
        responsive: true
    });
</script>
