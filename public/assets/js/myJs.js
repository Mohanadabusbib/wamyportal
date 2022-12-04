/* $('#role_id').on('change',function(event){
    var role_id = $(this).val();
    $.ajax({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{ route("permission_byRole")}}',
        type:'post',
        data:{
            'id':role_id
        },
        success:function(data)
        {
            $('input[type=checkbox]').each(function(){
                var ThisVal = parseInt(this.value);
                if(data.includes(ThisVal))
                this.checked = true;
                else
                this.checked = false;
            })
        }
    })
}); */

$('#role_id').on('change', function(event){
var role_id = $(this).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'permission/byRole',
        type: 'post',
        data: {
        'id': role_id
        },
        success: function(data)
        {
        $('input[type=checkbox]').each(function () {
            var ThisVal =parseInt(this.value) ;
            if(data.includes(ThisVal))
                this.checked = true;
            else
                this.checked = false;
        });
        }
    })
});
