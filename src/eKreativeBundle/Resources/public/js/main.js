// make tooltips for buttons
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
// open new user form
$(document).delegate('.new-user', 'click', function() {
    $('#myModal').modal('toggle');
    $.ajax({
        type: "GET",
        url: "new-user",
        dataType: 'json',
        statusCode: {
            200: function(data) {
                $('#myModal .modal-body p').html(data.form);
            }
        }
    });
    $('#myModal h4.modal-title').html('Create new user:');
    $('#myModal .modal-footer').html('\
        <button type="submit" class="btn btn-default" data-create="user">Create</button>\
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>\
    ');
});
// create new user
$(document).delegate('button[data-create="user"]', 'click', function() {
    $.ajax({
        type: "POST",
        url: "new-user",
        data: $('form[name="ekreativebundle_user"]').serialize(),
        dataType: 'json',
        statusCode: {
            404: function(data) {
                var html = JSON.parse(data.responseText);
                $('#myModal .modal-body p').html(html.form);
                $('#ekreativebundle_user ul').each(function(){
                    $(this).addClass('error');
                    $(this).parent().append($(this));
                });
            },
            201: function() {
                location.reload();
            }
        }
    });
});
// delete user
$(document).delegate('div[data-user-id] .delete', 'click', function() {
    $.ajax({
        type: "DELETE",
        url: "delete-user/"  + $(this).parent().data('user-id'),
        statusCode: {
            201: function() {
                location.reload();
            }
        }
    });
});