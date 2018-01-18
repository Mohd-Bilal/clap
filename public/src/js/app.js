var postid=-1;
var postBody=null;
var msg=null;

$('.editpost').on('click',function(event){
    event.preventDefault();
    postBody=event.target.parentNode.parentNode.parentNode.childNodes[4];
    var post=postBody.textContent;
    postid=event.target.parentNode.parentNode.parentNode.dataset['postid'];
    $('#editform').val(post);
    $('#editmodal').modal();
});
$('#postit').on('click',function(){
    $('#tagmodal').modal();

});
$('#modal-save').on('click',function(){
    $.ajax({
        method:'POST',
        url:url,
        data:{body:$('#editform').val(),postId: postid,_token:token}

    })
        .done(function(msg){

            $(postBody).text(msg['new_body']);
            $('#editmodal').modal('hide');
        });
});

$('.like').on('click',function(event){
    event.preventDefault();
    var postid=event.target.parentNode.parentNode.parentNode.dataset['postid'];
    var isLike=event.target.previousElementSibling==null;

    $.ajax({
        method:'POST',
        url:likeurl,
        data:{isLike:isLike,postId: postid,_token:token}

    })
    .done(function(msg) {
            
            event.target.innerText = isLike ? event.target.innerText == (msg['number']-1)+' Like'?msg['number']+' You liked this post' :msg['number']+' Like' : event.target.innerText == (msg['dislikes']-1)+' Dislike' ? msg['dislikes']+' You disliked this post':msg['dislikes']+' Dislike';
            if (isLike) {
                event.target.nextElementSibling.innerText = msg['dislikes']+' Dislike';
            } else {
                event.target.previousElementSibling.innerText = msg['number']+' Like';
            }
    });
});


$('#tagsave').on('click',function(event){
    var body=document.getElementById('newpost').value;
    // var t1=document.getElementById('t1').checked;
    // var t2=document.getElementById('t2').checked;
    // var t3=document.getElementById('t3').checked;
    // var t4=document.getElementById('t4').checked;
    // var t5=document.getElementById('t5').checked;
    $.ajax({
        method:'POST',
        url:createpost,
        data:{body:body,_token:token}

    })
    .done(function(msg){
       
        $('#tagmodal').modal('hide');
        var body = JSON.parse(msg);
        console.log(body["state"]);
        if(body["state"]=='success'){
        location.reload(true);
         document.getElementById('success').innerHTML=body["description"];
        }
        else
        document.getElementById('error').innerHTML=body["description"];
       
    });

});
$('#changepwd').on('click',function(){
    var x=document.getElementById('change');
    if(x.style.display==="none")
        x.style.display="block";
    else
        x.style.display="none";    

});
