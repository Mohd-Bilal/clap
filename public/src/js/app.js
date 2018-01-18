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
$("document").ready(function() {

    $('.dropdown-menu').on('click', function(e) {
        if($(this).hasClass('dropdown-menu-form')) {
            e.stopPropagation();
        }
    });
  });
$(document).ready(function(){
    $('.dropdown-submenu a.test').on("click", function(e){
      $(this).next('ul').toggle();
    
      e.stopPropagation();
      e.preventDefault();
    });
  });
$('.test').on('click',function(event){
    var postid=this.id;
    var url='http://localhost:3000/public/information/field/'+postid+'/sub_fields';
    var fetch=$.get(url);
    console.log(fetch);
});

// $('#like').on('click',function(event){

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
    // console.log(userfield);
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

    // event.preventDefault();
    var post_id=event.target.parentNode.parentNode.dataset['postid'];

    console.log(post_id);
    if(this.id=="liked"){
    this.id="unliked";
    console.log(this.id);
    $.ajax({
        method:'POST',
        url:likeurl,
        data:{Like:'unlike',post_id:post_id,_token:token}

    })
    .done(function(msg) {
            console.log("ajax unliked");
            // var body = JSON.parse(msg);
            document.getElementsByName(msg["post_id"]).innerText="Like";

    });

    }
    else{
    this.id="liked";;
    console.log(this.id);

    $.ajax({
        method:'POST',
        url:likeurl,
        data:{Like:'like',post_id:post_id,_token:token}

    })
    .done(function(msg) {
          console.log("ajax liked");
          // var body = JSON.parse(msg);
          document.getElementsByName(msg["post_id"]).innerText="Liked";


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
