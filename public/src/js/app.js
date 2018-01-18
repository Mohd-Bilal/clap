var postid=-1;
var postBody=null;
var msg=null;
var userfield= new Array();
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
<<<<<<< HEAD



$('#like').on('click',function(event){
=======
$('.fields').on('click',function(event){
    var fieldid=$(this).attr("id");
    var x=document.getElementById(fieldid);
    if(x.getAttribute("name")=='unset'){
        x.setAttribute("name",'set');
        userfield.push(fieldid);
        x.style.color='black';
    }
    else{
    x.setAttribute("name",'unset');
    const index = userfield.indexOf(fieldid);
    userfield.splice(index,1);
    x.style.color='white';
}
    console.log(userfield);
});
$('#submit-fields').on('click',function(){
    $.ajax({
        method:'GET',
        url:x,
        data:{
            fields:userfield
        }
    })
    .done(function(msg){
        window.location.href='/dashboard' ;
    });  
});
$('.like').on('click',function(event){
>>>>>>> 2ef8c6a96976a618c32aeacb46963ea6b706ffa6
    event.preventDefault();


    var isLike=document.getElementById('like');
    if(isLike.getAttribute("class")=="liked"){
    isLike.setAttribute("class","unliked");
    console.log(isLike.getAttribute("class"));
    $.ajax({
        method:'POST',
        url:likeurl,
        data:{Like:'unlike',_token:token}

    })
    .done(function(msg) {
            console.log("ajax liked");
            document.getElementById('like').innerText="Like";

    });

    }
    else{
    isLike.setAttribute("class","liked");
    console.log(isLike.getAttribute("class"));

    $.ajax({
        method:'POST',
        url:likeurl,
        data:{Like:'like',_token:token}

    })
    .done(function(msg) {
          console.log("ajax unliked");
          document.getElementById('like').innerText="Liked";


    });
    }


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
