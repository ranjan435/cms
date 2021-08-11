$(document).ready(function(){
    var table = $('#tableUserPosts').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "ManagePosts.php",
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
    $('#tableUserPosts tbody').on('click','button',function(e){
        var data = table.row($(this).parents('tr')).data();
        if (e.target.textContent=="Delete"){
            $(location).attr('href', 'userPostDelete.php?postID='+data[0]);
        }
        else{
            $(location).attr('href', 'userPostManage.php?postID='+data[0]);
        }
        // if (data[3]==="edit")
        console.log();
        // var nameID = document.getElementById("nameID");
        // var name = document.getElementById("name");
        // var email = document.getElementById("email");
        // nameID.value = data[0];
        // name.value = data[1];
        // email.value = data[2];
    });
})

