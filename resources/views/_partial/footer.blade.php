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

<script src="{{ URL::to('/') }}/assets/adminlte/js/jquery.min.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/bootstrap.bundle.min.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/adminlte.min.js?v=3.2.0"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/jquery.overlayScrollbars.min.js"></script>
<script src="{{ URL::to('/') }}/vendor/sweetalert/js/sweetalert2@11.js"></script>
{{-- datatable --}}
<script src="{{ URL::to('/') }}/assets/adminlte/js/popper.min.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/bootstrap.min.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/dataTables.js"></script>
<script src="{{ URL::to('/') }}/assets/adminlte/js/dataTables.bootstrap4.js"></script>
{{-- end --}}
<script src="{{ URL::to('/') }}/assets/js/my.js"></script>

@yield('js')
</body>

</html>
