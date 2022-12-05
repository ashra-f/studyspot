// Initialize tooltip popups
$(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip(
       {container:'body', trigger: 'hover', placement:"right"}
       );   
   });

// Initialize TinyMCE Editor
tinymce.init({
    selector: 'textarea#my_tinymce',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    height: '55vh',
    resize: false,
    mergetags_list: [
    { value: 'First.Name', title: 'First Name' },
    { value: 'Email', title: 'Email' },
    ]
});

// Enable popovers 
$(document).ready(function() {
    $("#guidelines-popover").popover({
        trigger: 'focus', html : true, placement:"bottom", title: 'studyspot Guidelines',
        content: function() {
          return $("#guidelines-popover-content").html();
        }
    });
});


// Like System
$(document).ready(function(){
    $(".like, .unlike").click(function(){
        var id = this.id;   
        var split_id = id.split("_");
        var text = split_id[0];
        var postid = split_id[1]; 
        var type = 0;
        if(text == "like") {
            type = 1;
        } 
        else {
            type = 0;
        }
        $.ajax({
            url: 'scripts/likeunlike.php',
            type: 'post',
            data: {
                postid: postid, 
                type: type 
            },
            dataType: 'json',
            success: function(data){
                var likes = data['likes'];
                var unlikes = data['unlikes'];

                $(".likes_"+postid).each(function() {
                    $(this).text(likes);
                });

                $(".unlikes_"+postid).each(function() {
                    $(this).text(unlikes);
                });


                if(type == 1) {
                    $(".like_"+postid).each(function() {
                        $(this).removeClass('bi-hand-thumbs-up').addClass('bi-hand-thumbs-up-fill');
                    });

                    $(".unlike_"+postid).each(function() {
                        $(this).removeClass('bi-hand-thumbs-down-fill').addClass('bi-hand-thumbs-down');
                    });
                }
                if(type == 0) {
                    $(".unlike_"+postid).each(function() {
                        $(this).removeClass('bi-hand-thumbs-down').addClass('bi-hand-thumbs-down-fill');
                    });

                    $(".like_"+postid).each(function() {
                        $(this).removeClass('bi-hand-thumbs-up-fill').addClass('bi-hand-thumbs-up');
                    });
                }
            }
        });
    });
});

// Log in to interacti with posts
function loginAlert() {
    $('#signup-modal').modal('show');
}

// Post Modal Get Data
$(document).ready(function(){
    $('#noteModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        var method = $(e.relatedTarget).data('method');
        var bgcolor = 'white';
        if (method == 0) {
            bgcolor = "#ffc";
        }
        else if (method == 1) {
            bgcolor = '#cfc';
        }
        else {
            bgcolor = "#ccf";
        }
        $.ajax({
            type : 'post',
            url : 'scripts/fetch_record.php', 
            data: {  
                rowid: rowid,
                bgcolor: bgcolor
            }, 
            success : function(data){
            $('.fetched-data').html(data); // Show fetched data from database
            }
        });
     });
});


// Comment Modal Get Data
$(document).ready(function(){
    $('#commentModal').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'scripts/fetch_comments.php', 
            data: {  
                rowid: rowid,
            }, 
            success : function(data){
                $('.fetch-comments').html(data); // Show fetched data from database
            }
        });
     });
});

// Signup --> Login modal
function openLoginModal() {
    $('#signup-modal').modal('hide');
    $('#login-modal').modal('show');
}