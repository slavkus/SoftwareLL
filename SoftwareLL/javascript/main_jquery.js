
function imeData() {
    $.ajax({
        url: 'https://barka.foi.hr/WebDiP/2018/materijali/zadace/dz3/userNameSurname.php',
        type: 'GET',
        data: {'name': $("#ime").val()},
        dataType: 'xml',
        success: function (data) {
            var podaci = '<select id="ime" name="ime" size="20">';
            $(data).find("name").each(function () {
                //ubacuju se podaci koji su xml-u (tagName) i .text je value
                podaci += '<option value="' + $(this).attr('name') + '">'
                        + $(this).attr('name') + '</option>';
                //sada treba priljepiti na tvoj select
                //$('#ime').append(podaci);
                podaci += '</select>';
                $('#prikaziIme')[0].innerHTML = podaci;
            });
        }
    });
}

$(document).ready(function () {
    //imeData();
    
    $('#tablicaPopis').DataTable({
        "aaSorting" : [[0, "asc"], [1, "asc"], [2, "asc"]],
        "bPaginate" : true,
        "bFilter" : true,
        "bSort" : true,
        "bInfo" : true,
        "bAutoWidth" : true
    });
});
        

/*
 * STRANIČENJE
 * SORTIRANJE
 * FILTRIRANJE
 * 
 */