$(document).ready(function() {
    $('select[name="department_id"]').on('change', function() {
        var deptid = $(this).val();
        if(deptid) {
            $.ajax({
                url: 'myform/ajax/'+deptid,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log("Hi from Ajax");
                    $('select[name="section_id"]').empty();
                    $.each(data, function(key, value) {
                        $('select[name="section_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                } 
            });    
        }else{
            $('select[name="section_id"]').empty();
        }
    });
    
});


