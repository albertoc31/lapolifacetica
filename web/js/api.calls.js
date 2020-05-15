function insertCat1(cat) {
    var host = $('#api_url').val();
    var insertCat = $.post(host + '/' + cat, function(data){
        // console.log(data);
        $('#nuevaCat').val('');
        changeCatSelect(data);
    })
        .fail ( function(){
            // console.log('NO se ha insertado');
            failCatAdd(cat);
        });
}

function insertCat(cat){
    var host = $('#api_url').val();
    var api_key = $('#api_key').val();
    url = host + '/' + cat;

    if (api_key != undefined && api_key != '') {
        $.ajax({
            type: "POST",
            url: url,
            dataType: "JSON",
            headers: {'X-AUTH-TOKEN': api_key}
        }).done(function (data) {
            // Done
        }).fail(function (data) {
            // Failed
        });
    } else {
        // mostramos alerta
        NoApiKeyCatAdd();
    }
}

function changeCatSelect(data) {
    $('#activity_category').append(
        new Option(data.name, data.id)
    );
}

