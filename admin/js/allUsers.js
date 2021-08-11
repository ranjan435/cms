$(document).ready(function(){
    var tableUser = $('#tableAllUsers').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "ajax": {
            "url": "allUsersDt.php",
            "data": function(d){
                d.search = $('#search').val();
            },
        },
        "columnDefs": [ {
            "targets": -2,
            "data": null,
            "defaultContent": "<button id=\"postEdit\">Edit</button>"
        },{
            "targets": -1,
            "data": null,
            "defaultContent": "<button id=\"postDelete\">Delete</button>"
        }]
    });
    $('#tableAllUsers tbody').on('click','button',function(e){
        var data = tableUser.row($(this).parents('tr')).data();
        if (e.target.textContent=="Delete"){
            $(location).attr('href', 'userDelete.php?userID='+data[0]);
        }
        else{
            $(location).attr('href', 'userManage.php?userID='+data[0]);
        }
    });
    $("#search").on("keyup", function(e){
        tableUser.draw();
    })
})

