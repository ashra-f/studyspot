// Initialize tooltip popups
$(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip(
       {container:'body', trigger: 'hover', placement:"right"}
       );   
   });

// Initialize TinyMCE Editor
tinymce.init({
    selector: 'textarea#my_tinymce',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
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