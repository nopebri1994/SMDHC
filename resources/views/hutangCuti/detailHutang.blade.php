<div class="col-md-12 shadow-sm">
    <div class="row bg-info">
        <div class="col-md-5 pt-2">Jumlah Hutang Cuti</div>
        <div class="col-md-3"><strong style="font-size: 24px">{{ $vCuti->jumlahHutangCuti }}</strong>
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
