$('#saveCategory').click(function () {

    let data = {
        name: $('#name').val(),
        parent_id: $('input[name="checkboxes"]:checked').data('id')
    };

    $.ajax({
        type: "POST",
        url: '/categories',
        data: data,
        success: function (res) {
                setTimeout(function () {
                    window.location.href = '/categories';
                }, 1000);
        }
    });
});


$('#editCategory').click(function () {

    let data = {
        id: $(this).data('id'),
        name: $('#name').val(),
        parent_id: $('input[name="checkboxes"]:checked').data('id')
    };
    $.ajax({
        type: "POST",
        url: '/categories/update',
        data: data,
        success: function () {
            setTimeout(function () {
                window.location.href = '/categories';
            }, 1000);
        }
    });
});

$(document).ready(function () {
    setCategoriesValue();
});

$('input[name="checkboxes"]').change(function() {
    setCategoriesValue();
});

function setCategoriesValue() {
    let arr = [];
    $('input[name="checkboxes"]:checked').each(function () {

        arr.push($(this).data('id'));
    });
    $('#categories').val(arr);
}

$('input[name="filters"]').change(function() {
    setFiltersValue();
});

function setFiltersValue() {
    let arr = [];
    $('input[name="filters"]:checked').each(function () {

        arr.push($(this).data('id'));
    });

    $('#filters_value').val(arr);
}

$('.list-group-item').click(function (){
    $(this).next('.list-group').toggle();
});

$('.root-category').hide();

