function deleteConfirm(){
	var decision = confirm("Are you sure want to delete this entry ?");
	return decision;
}

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

    reader.onload = function (e) {
        $('#image-preview').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$(".image-input").change(function(){
    readURL(this);
});

$(function () {
    //Date picker
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy/mm/dd',
        startDate: '1d'
    });

    $('.select2').select2();
});