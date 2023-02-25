$(document).ready(function () {
    // Select2 Multiple
    $('.select2-multiple').select2({
        placeholder: "Select",
        allowClear: true,
        dropdownParent: $('#test-list'),
    });

});

$(document).ready(function () {
    // Select2 Multiple
    $('.select2-multiplee').select2({
        placeholder: "Select",
        allowClear: true,
        dropdownParent: $('#test-listt'),
    });

});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var loadFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('output');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};


$(document).ready(function () {

    $.ajax({
        url: "/get-to-do-listt",
        type: 'GET',
        dataType: 'json', // added data type
        success: function (data) {
            $.each(data, function (key, value) {

                //     $("#list").append('<tr>' +
                //         '<td>'+value.title+'</td>' +
                //         '<td>'+value.text+'</td>' +
                //         '<td>'+value.date+'</td>' +
                //         '<td>'+value.status+'</td>' +
                //         '<td><button type="button" class="btn btn-primary edit" onclick="alert(value.id)" data-toggle="modal" data-id ="'+value.id+'"  data-target="#edit'+value.id+'">Edit</button></td></tr>')
                //
                // });

                //  $("#list").append(`<tr><td><button type="button" class="btn btn-primary edit" onclick="alert(dataset.id)" data-toggle="modal" data-id='+value.id+'  data-target="#edit'+value.id+'">Edit</button></td></tr>`)

            });

        }
    });


    var route;
    // Get Tags
    $.ajax({
        url: "/get-tags",
        type: 'GET',
        dataType: 'json', // added data type
        success: function (data) {
            $.each(data, function (key, value) {
                $("#select2Multiple").append('<option value="' + value.id + '">' + value.tag_name + '</option>')
            });

            $.each(data, function (key, value) {
                $("#select2Multiplee").append('<option value="' + value.tag_name + '">' + value.tag_name + '</option>')
            });

        }
    });

    $("#add").click(function () {

        route = "add-to-do-list";

        $("#output").attr('src', '')
        $('#title').val('')
        $('#date').val('')
        $('#text').val('')
        $("#sel1").prop('selectedIndex')
        $("#select2Multiple").val(null).trigger('change');
        $("#to_do_id").remove()

    })


    $('#myForm').on('submit', function (e) {

        e.preventDefault();
        $.ajax({
            url: route,
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (response) {
                $("#myModal .close").click()
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });


    // edit
    $('.edit').on('click', function () {

        $("#output").attr('src', '')
        $('#title').val('')
        $('#date').val('')
        $('#text').val('')
        $("#sel1").prop('selectedIndex')
        $("#select2Multiple").val(null).trigger('change');

        $("#myModal").modal('show')

        var id = $(this).attr('data-id');

        route = "update-to-do-list/" + id;


        $.ajax({
            url: "/edit-to-do-list/" + id,
            type: 'GET',
            dataType: 'json', // added data type
            success: function (data) {
                if (data[0].image != null) {
                    $("#output").attr('src', window.location.protocol + '//' + window.location.host + '/thumbnail/' + data[0].image)
                }


                $('#title').val(data[0].title)
                $('#date').val(data[0].date)
                $('#text').val(data[0].text)
                $('#delete').append(' <button type="button" id="to_do_id" data-id="' + data[0].id + '">Delete</button>')


                $('#sel1 option[value="' + data[0].status + '"]').prop('selected', true);
                $.each(data[0].tag, function (key, value) {
                    var newOption = new Option(value.tag_name, value.id, true, true);
                    // Append it to the select
                    $('#select2Multiple').append(newOption).trigger('change');
                });

            }
        });
    })


    $('#to_do_id').on('click', function () {

        // alert($(this).attr('data-id'))
        var toId = $(this).attr('data-id')


        $.ajax({
            url: 'delete-image',
            type: "POST",
            data: {'toId': toId},

            success: function (response) {
                alert('dfdf')
                // $("#myModal .close").click()
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });

});
