@if(session()->has('message.success'))
    <script>
        toastr.success("{!! addslashes(session('message.success')) !!}");
    </script>
@endif
@if(session()->has('message.info'))
    <script>
        toastr.info("{!! addslashes(session('message.info')) !!}");
    </script>
@endif
@if(session()->has('message.error'))
    <script>
        toastr.error("{!! addslashes(session('message.error')) !!}");
    </script>
@endif
@if(session()->has('message.warning'))
    <script>
        toastr.warning("{!! addslashes(session('message.warning')) !!}");
    </script>
@endif