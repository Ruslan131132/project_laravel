$("select.marks").change(function(){
    let id = $(this).attr('id');
    let value = $(this).val();
    let pupil_id = $(this).attr('data-pupil_id');
    let subject_id = $(this).attr('data-subject_id');
    $.ajax({
        url: '{{route("sendMark")}}',
        type: 'POST',
        data: {
            "id": id,
            "value": value,
            'pupil_id': pupil_id,
            'subject_id': subject_id
        },
        datatype: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }})
        .then(function(response) {
            if(response){
                console.log(response);
                location.reload()
            }
            else{
                console.log('Ошибка');
            }
        });
});

$('select.choose').change(function(){
    let id = $(this).attr('id');
    let value = $(this).val();
    $.ajax({
        url: '{{route("marks")}}',
        type: 'POST',
        data: {
            "id": id,
            "value": value
        },
        datatype: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).then(function(response) {
            if(response){
                console.log(response);
                location.reload()
            }
            else{
                console.log('Ошибка');
            }
        });
});
