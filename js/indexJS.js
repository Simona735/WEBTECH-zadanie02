
$(document).ready(function () {
    listTable();
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

let surname_sort = 1;
$('#surname').click(function () {
    ourAthletes.sort( compare_surname );
    surname_sort *= -1;
    listTable(ourAthletes);
});

let year_sort = 1;
$('#year').click(function () {
    ourAthletes.sort( compare_year );
    year_sort *= -1;
    listTable(ourAthletes);
});

let type_sort = 1;
$('#type').click(function () {
    ourAthletes.sort( compare_type );
    type_sort *= -1;
    listTable(ourAthletes);
});

// compare functions for sort
// by surname
function compare_surname( a, b ) {
    if ( a[2] < b[2] ){
        return -1 * surname_sort;
    }
    if ( a[2] > b[2] ){
        return surname_sort;
    }
    return 0;
}
// by year
function compare_year( a, b ) {
    if ( a[3] < b[3] ){
        return -1 * year_sort;
    }
    if ( a[3] > b[3] ){
        return year_sort;
    }
    return 0;
}
// by type / year
function compare_type( a, b ) {
    if ( a[5] === b[5] ) {
        compare_year( a, b )
    }
    if ( a[5] < b[5] ){
        return -1 * type_sort;
    }
    if ( a[5] > b[5] ){
        return type_sort;
    }
    return 0;
}

function listTable() {

    var table = $('#table1Body');
    table.empty();
    $.each( ourAthletes, function( key, value ) {
        table.append( '<tr>' +
            '<td scope="row">'+value[0]+'</td>' +
            '<td><a style="text-decoration:none" href="detail.php?id=' + value[0] + '">' + value[1] +'<a></td>' +
            '<td>'+value[2]+'</td>' +
            '<td>'+value[3]+'</td>' +
            '<td>'+value[4]+'</td>' +
            '<td>'+value[5]+'</td>' +
            '<td>'+value[6]+'</td>' +
            '</tr>' );
    });
}