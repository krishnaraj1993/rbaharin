$(document).ready(function () {

    $.super_cookie({
        expires: 7,
        path: "/",
        // more jquey.cookie plugin options
    })
        .create("StoreBox", {
            appName: "Product Compare"
        });

    $('#updateContent').click(function () {
        var img = $('#formGroupExampleInput')[0].files.length;
        if (img) {
            var fd = new FormData();
            var files = $('#formGroupExampleInput')[0].files[0];
            fd.append('file', files);

            $.ajax({
                url: 'productImageUpload',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != 0) {
                        $("#productImageview").attr("src", 'UserData/' + response.file);
                        $.super_cookie().add_value("StoreBox", "Product-image", 'UserData/' + response.file);
                        refresh();
                        document.getElementById('formGroupExampleInput').value = "";
                    } else {
                        alert('file not uploaded');
                    }
                },
            });
        } else {
            var labelId = $('#labelId').val();
            var contentId = $('#contentId').val();
            contentId = contentId.replace(/[\r\n]+/gm, "----");
            $.super_cookie().add_value("StoreBox", labelId, contentId);
            refresh();
        }
    });
    $("#but_upload").click(function () {

        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file', files);

        $.ajax({
            url: 'upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != 0) {
                    $("#img").attr("src", response);
                    $(".preview img").show(); // Display image element
                } else {
                    alert('file not uploaded');
                }
            },
        });
    });
});

$(document).ready(function () {
    $('.activate-btn').click(function () {
        var obj = $(this).closest('tr');
        console.log(obj);
        $.ajax({
            url: "update-plan/" + $(this).data('id'), success: function (result) {
                swal("Update plan request sent successfully");
                $('.dataTable tr').removeAttr('style');
                obj.css('background-color', '#b1d2b1');

            }
        });
    });
    $('#addToFeaturedList').click(function () {
        $.ajax({
            url: "/application/add-to-featured-list/" + $(this).data('id'), success: function (result) {
                swal("plan updated successfully");
                $('.dataTable tr').removeAttr('style');
                obj.css('background-color', '#b1d2b1');

            }
        });
    });
    $('.delete-assets').click(function () {
        var obj = $(this);
        $.ajax({
            url: "/application/delete-assets/" + $(this).data('id'), success: function (result) {
                swal("Asset deleted successfully");
                $(this).parent('td').parent('tr').remove();
            }
        });
    });

    $('.product_activitaion').change(function () {
        var status = $(this).prop("checked")?1:0;
        var urlstring = "/api/properties/" + $(this).attr('id')+'/status/'+status;
        $.ajax({
            url: urlstring, success: function (result) {
                swal("Status updated successfully");
            }
        });
    });


    $('.planUpdate-btn').click(function () {
        var obj = $(this).closest('tr');
        $.ajax({
            url: "approve-plan/" + $(this).data('plan') + "/" + $(this).data('user'), success: function (result) {
                swal("plan updated successfully");
                $('.dataTable tr').removeAttr('style');
                obj.css('background-color', '#b1d2b1');

            }
        });
    });

    $('.deleteProperty-btn').click(function () {
        var obj = $(this).closest('tr');
        $.ajax({
            url: "/application/property/" + $(this).data('id') + "/delete", success: function (result) {
                swal("Property deleted successfully");
                $(this).parent('td').parent('tr').remove();

            }
        });
    });
});

function refresh() {
    var data = $.super_cookie().read_values("StoreBox");
    arr = $.parseJSON(data);
    var html = '';
    $.each(arr, function (key, value) {
        if (key != 'appName' && key != 'Product-image') {
            html = html + '<li class="list-group-item" style="background-color: #e8e8e8;"><small>' + key + '</small><br/>' + value + ' <button type="button" class="btn btn-primary btn-sm" style="padding: 5px;padding-top: 1px;padding-bottom: 1px;position: absolute;right: 25px;top: 20px;">x</button></li>';
        }
    });
    $('#Product-content').html(html);
}

function saveDataFinal() {
    var data = $.super_cookie().read_values("StoreBox");
    let xhr = new XMLHttpRequest();
    let url = "saveProductData";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            result.innerHTML = this.responseText;

        }
    };
    xhr.send(data);
}



$(document).ready(function () {
    $(".clickimagePlus").click(function () {
        $('#imageAssets').click();
    });
    $("#submitProperty").click(function () {

        return;
        $("#propertyTypeForm").submit();
    });

});

//form validation start =================================
$('#form').parsley();
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
//form validation end =================================

function setimage(objFileInput) {
    if (objFileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            var sl = parseInt($('#imageCounts').val());
            $('#imagelists tr:last').after('<tr><td>' + (sl + 1) + '</td><td><input type="number" value="' + (sl + 1) + '" style="width: 80%;"  name="assetsnumber[]"/></td><td><img src="' + e.target.result + '" width="100px" height="100px" class="img-fluid mr-3" /><input type="hidden" value="' + e.target.result + '" name="assets[]"></td><td><button type="button" class="btn btn-primary btn-sm">x</button></td></tr>');
            //$(".imageList").append('<img src="' + e.target.result + '" width="200px" height="200px" class="img-fluid mr-3" /><input type="hidden" value="' + e.target.result + '" name="assets[]">');
            $('#imageCounts').val(sl + 1);
        }
        fileReader.readAsDataURL(objFileInput.files[0]);
    }
}

$('#keep-order').multiSelect({ keepOrder: true });