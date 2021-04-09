$(document).ready(function () {
  $('#btnSearch').click(function () {
        let uneto = $('input[name="search"]').val();
        $.ajax({
            type: 'POST',
            url: baseUrl + '/igraci/search',
            data: {search: uneto, _token: csrf},
            success: function (data, xhr) {
                console.log(data);
                console.log(xhr);
                showPosts(data);
            },
            error: function (xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    });
    function showPosts(data) {
        var html = " ";
        $.each(data,function (key,value) {
            html += ' <div class="card mb-4" >' +
                ' <img class="card-img-top" src="' + value.slika + '" alt="+ value.alt + ">' +
                '<p  style="text-align:center"><b>Ime :</b> '+ value.ime +'</p>' +
                '<p  style="text-align:center"><b>Prezime :</b>'+ value.prezime +'</p>' +
                '<p  style="text-align:center"><b>Pozicija :</b>' + value.pozicija +'</p>' +
                '<p  style="text-align:center"><b>Broj :</b> '+ value.broj +'</p>' +
                '<p  style="text-align:center"><b>Drzava : </b>' + value.drzava +'</p></div>';
        });

        $('#postovi').html(html);

    }


    });

    // $('body').on('click', '.showPost',function (e) {

    //     console.log("a");
    //     let id= $(this).data('id');

    //     $.ajax({
    //         type : "GET",
    //         url: baseUrl + '/igraci/' + id,
    //         success:function (data, xhr) {
    //             console.log(data);
    //             console.log(xhr);
    //             $('#postovi').html(data);
    //         },
    //         error: function (xhr, status, error) {
    //             console.log(xhr);
    //             console.log(status);
    //             console.log(error);

    //         }
    //     });

    // });





