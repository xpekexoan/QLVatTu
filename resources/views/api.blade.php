
<script src="{{ asset('dist/plugins/jquery/jquery.min.js') }}"></script>
<p id="ketqua"></p>

<script>
$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
$.ajax({
    type: 'POST',
    url: '{{route("test")}}',
    data: {
        data:[{idTB: "6",soLuong: "1"}],
        _token: '{{csrf_token()}}'
    },
    dataType: 'json',
    success: function(data) {
        console.log(data);
    }});
</script>