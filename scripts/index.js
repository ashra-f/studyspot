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
                $("#likes_"+postid).text(likes);       
                $("#unlikes_"+postid).text(unlikes);   
                if(type == 1){
                    $("#like_"+postid).removeClass('bi-hand-thumbs-up').addClass('bi-hand-thumbs-up-fill');
                    $("#unlike_"+postid).removeClass('bi-hand-thumbs-down-fill').addClass('bi-hand-thumbs-down');
                }
                if(type == 0){
                    $("#unlike_"+postid).removeClass('bi-hand-thumbs-down').addClass('bi-hand-thumbs-down-fill');
                    $("#like_"+postid).removeClass('bi-hand-thumbs-up-fill').addClass('bi-hand-thumbs-up');
                }
            }
        });
    });
});

// Log in to interacti with posts
function loginAlert() {
    alert("Login to interact with posts!");
}
