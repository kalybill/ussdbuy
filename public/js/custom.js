$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    

    
    $(document).on('click','#btnEdit', function(){
        var id = $(this).data('id');

        $.ajax({
            type: "post",
            url: "get_user",
            data: {'id': id},
            success: function (data) {
                $('#id').val(data.id);
                $('#fname').val(data.fname);
                $('#lname').val(data.lname);
                $('#phone').val(data.phone);
            }
        });
    })


    $(document).on('click', '#btnDel', function(){
        if (confirm('Do you want to delete this customer?')) {
            var id = $(this).data('id');
            $.ajax({
                type: "post",
                url: "del_user",
                data: {'id': id},
                success: function (data) {
                    $('#id').val(data.id);
                }
            });
            alert('Thanks for confirming');
            window.location.href = '';
        }
    })

    $(document).on('click', '#btnBlacklist', function(){
        if (confirm('Do you want perform this action?')) {
            var id = $(this).data('id');
            $.ajax({
                type: "post",
                url: "black_white",
                data: {'id': id},
                success: function (data) {
                    $('#id').val(data.id);
                }
            });
            alert('Thanks for confirming');
            window.location.href = '';
        }
    })
});