<div class="col-md-12 shadow-sm">
    <div class="row bg-info">
        <div class="col-md-4 pt-2">Sisa Cuti</div>
        <div class="col-md-3"><strong style="font-size: 24px">{{ $vCuti->sisaCuti }} Hari </strong>
            @if ($vCuti->keterangan == 'Cuti Tahunan')
                / 12
            @else
                / 25
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">Potongan Cuti Tahun 2024</div>
        <div class="col-md-8">
            <strong>{{ $potongan }} Hari</strong>
        </div>
    </div>
    <div class="row bg-info">
        <div class="col-md-4">Potongan Hutang Cuti Tahun 2024</div>
        <div class="col-md-8">
            @if (!empty($hutang->ambilHutangCuti))
                <strong> {{ $hutang->ambilHutangCuti }} Hari</strong>
            @else
                <strong> 0 Hari</strong>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">Tambahan Cuti Lain Lain</div>
        <div class="col-md-8">
            @if (empty($tambahan))
                <strong>0 Hari</strong>
            @else
                <strong>{{ $tambahan }} Hari</strong>
            @endif
        </div>
    </div>
    <div class="row bg-info">
        <div class="col-md-4">Potongan Cuti Lain Lain</div>
        <div class="col-md-8">
            @if (empty($potongCuti))
                <strong>0 Hari</strong>
            @else
                <strong>{{ $potongCuti }} Hari</strong>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">Keterangan</div>
        <div class="col-md-8">
            <strong>{{ $vCuti->keterangan }}</strong>
        </div>
    </div>
    <div class="row bg-info">
        <div class="col-md-4">Masa Kerja</div>
        <div class="col-md-8">
            <strong>{{ $masaKerja }} Tahun</strong>,
            <strong>{{ $bulan }} bulan </strong>
            <i>(dihitung per tanggal 1 turun cuti)</i>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">Tangal Masuk</div>
        <div class="col-md-8">
            <strong>{{ $tanggalMasuk }}</strong>
        </div>
    </div>
</div>
<hr>
<div class="col-md-12 mt-2">
    <table class="table table-striped" width="100%" id="tbl">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Tanggal Ambil Cuti</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $key => $d)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ varHelper::formatDate($d->tanggalIjin) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $('#tbl').DataTable();
</script>
