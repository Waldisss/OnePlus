$(document).ready(function () {
    $('#btn-add-one').on('click', function (e) {
        e.preventDefault();

        let name = $(this).attr('name');
        let value = $(this).attr('value');

        let dataObj = {};
        dataObj[name] = value;
        dataObj['isAjax'] = true;

        $.ajax({
            url: '/index.php',
            method: 'POST',
            data: dataObj,
            success: function (response) {
                $('#counter').html(response);
            }
        });
    });
});