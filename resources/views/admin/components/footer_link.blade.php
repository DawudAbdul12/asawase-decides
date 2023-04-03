
        <!-- JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
        <script src="{{ asset('asset-resources/assets/js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('asset-resources/assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('asset-resources/assets/js/core/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('asset-resources/assets/js/core/jquery.scrollLock.min.js') }}"></script>
        <script src="{{ asset('asset-resources/assets/js/core/jquery.appear.min.js') }}"></script>
        <script src="{{ asset('asset-resources/assets/js/core/jquery.countTo.min.js') }}"></script>
        <script src="{{ asset('asset-resources/assets/js/core/jquery.placeholder.min.js') }}"></script>
        <script src="{{ asset('asset-resources/assets/js/core/js.cookie.min.js') }}"></script>
        <script src="{{ asset('asset-resources/assets/js/app.js') }}"></script>

        <!-- Page JS Plugins -->
        <script src="{{ asset('asset-resources/assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

        <!-- Page JS Code -->
        <script src="{{ asset('asset-resources/assets/js/pages/base_forms_validation.js') }}"></script>
          <!-- Page JS Code -->
          <script src="{{ asset('asset-resources/assets/js/pages/base_tables_datatables.js') }}"></script>

          <script src="{{ asset('asset-resources/assets/js/pages/base_pages_login.js') }}"></script>

        <!-- Page JS Plugins -->
        <script src="{{ asset('asset-resources/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>

        <script src="{{ asset('asset-resources/assets/js/plugins/summernote/summernote.min.js') }}"></script>
        {{-- <script src="/asset-resources/assets/js/plugins/ckeditor/ckeditor.js"></script> --}}
        <script src="{{ asset('asset-resources/assets/js/plugins/select2/select2.full.min.js') }}"></script>
        <script src="{{ asset('asset-resources/assets/js/plugins/masked-inputs/jquery.maskedinput.min.js') }}"></script>
        <script src="{{ asset('asset-resources/assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>

        <script type="text/javascript" src="{{ asset('asset-resources/bower_components/moment/min/moment.min.js') }}"></script>
  
        <script type="text/javascript" src="{{ asset('asset-resources/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

        <!-- Page JS Code -->
        <script>
            $(function () {
                // Init page helpers (Summernote + CKEditor plugins)
                App.initHelpers(['summernote','select2', 'masked-inputs', 'tags-inputs']);
            });

            $(function () {
                $('#datetimepicker1').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm',
                     //minDate: dateToday
                 });
            });

            $(function () {
                $('#datetimepicker2').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm',
                     //minDate: dateToday
                 });
            });

            $(function () {
                $('#start_time').datetimepicker({
                    format: 'HH:mm',
                     //minDate: dateToday
                 });
            });

            $(function () {
                $('#end_time').datetimepicker({
                    format: 'HH:mm',
                     //minDate: dateToday
                 });
            });
        </script>

        @notifyJs