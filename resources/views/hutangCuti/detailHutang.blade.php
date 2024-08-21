<div class="col-md-12 shadow-sm">
    <div class="row bg-info">
        <div class="col-md-5 pt-2">Sisa Hutang Cuti</div>
        <div class="col-md-3"><strong
                style="font-size: 24px">{{ $vCuti->jumlahHutangCuti - $vCuti->ambilHutangCuti }}</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">Keterangan</div>
        <div class="col-md-7">
            <strong>{{ $vCuti->keterangan }}</strong>
        </div>
    </div>
    <div class="row bg-info">
        <div class="col-md-5">Masa Kerja</div>
        <div class="col-md-7">
            <strong>{{ $masaKerjaTahun }} Tahun, {{ $masaKerjaBulan }} Bulan</strong>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">Digunakan Sampai Tanggal </div>
        <div class="col-md-7">
            <strong>
                {{ varHelper::formatDate($vCuti->expired) }}
            </strong>
        </div>
    </div>
</div>
<hr>
<div class="col-md-12 mt-2">
    <table class="table table-striped" width="100%" id="tbl">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th>Tanggal Hutang Cuti</th>
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
