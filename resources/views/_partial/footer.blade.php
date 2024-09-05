<aside class="control-sidebar control-sidebar-dark">

    <div class="p-3">
        <h5>Status</h5>
        <p></p>
    </div>
</aside>

<footer class="main-footer">

    <div class="float-right d-none d-sm-inline">
        Departemen General
        Affair (Bagian IT).
    </div>

    <strong>Copyright &copy; 2024 <a href="https://nopebri.my.id">Nopebri Ade Candra</a>.</strong>
</footer>
</div>

{{-- <script src="{{ URL::to('/') }}/assets/adminlte/js/jquery.min.js"></script> --}}
<script src="{{ URL::to('/') }}/assets/adminlte/js/jquery-3.7.1.min.js"></script>

<script src="{{ URL::to('/') }}/assets/adminlte/js/bootstrap.bundle.min.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/adminlte.min.js?v=3.2.0"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/jquery.overlayScrollbars.min.js"></script>
<script src="{{ URL::to('/') }}/vendor/sweetalert/js/sweetalert2@11.js"></script>
{{-- datatable --}}
<script src="{{ URL::to('/') }}/assets/adminlte/js/popper.min.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/bootstrap.min.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/dataTables.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/dataTables.bootstrap4.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/dataTables.responsive.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/responsive.dataTables.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/select2.min.js"></script>

{{-- end --}}
<script src="{{ URL::to('/') }}/assets/js/my.js"></script>
<script>
    window.onload = function() {
        jam();
    }

    let jam = () => {
        let e = document.getElementById('jam'),
            d = new Date(),
            h, m, s;
        h = d.getHours();
        m = set(d.getMinutes());
        s = set(d.getSeconds());

        e.innerHTML = h + ':' + m + ':' + s;
        setTimeout(() => {
            jam();
        }, 1000);
    }

    function set(e) {
        e = e < 10 ? '0' + e : e;
        return e;
    }

    $('.select').select2({
        theme: 'bootstrap4'
    })
</script>
@yield('js')
</body>

</html>
