$(document).ready(function(){
    var table = $('#tableAllPosts').DataTable({
        "processing": true,
        "serverSide": true,
        "searching": false,
        "ajax": {
            "url": "allPostsDt.php",
            "data": function(d){
                d.search = $('#search-val').val();
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
    $('#tableAllPosts tbody').on('click','button',function(e){
        var data = table.row($(this).parents('tr')).data();
        if (e.target.textContent=="Delete"){
            $(location).attr('href', 'postDelete.php?postID='+data[0]);
        }
        else{
            $(location).attr('href', 'postManage.php?postID='+data[0]);
        }
    });
    $("#search-val").on("keyup", function(e){
        table.draw();
    })
})

