var postid=-1;
var postBody=null;
var msg=null;
var userfield= new Array();
var subfield=new Array;



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
    var suburl='http://localhost:3000/public/information/field/'+postid+'/sub_fields';
    $.ajax({
        method:'GET',
        url:sub,
        data:{field_id:postid,suburl:suburl}
    })
    .done(function(msg){
        var y=new String;
        $.each(msg['subfield'],function(key,value){
            var x='<li><label class="checkbox submenu"><input type="checkbox" value='+value.id+'>'+value.sub_field_name+'</label></li>';
            y=y+x;
        });
        document.getElementById(-msg['fieldid']).innerHTML=y;
    })
});

// $('#like').on('click',function(event){

$('.fields').on('click',function(event){
    var fieldid=$(this).attr("id");
    var x=document.getElementById(fieldid);
    if(x.getAttribute("name")=='unset'){
        x.setAttribute("name",'set');
        userfield.push(fieldid);
        x.style.color='black';
        x.style.fontSize='25px';
    }
    else{
    x.setAttribute("name",'unset');
    const index = userfield.indexOf(fieldid);
    userfield.splice(index,1);
    x.style.color='white';
    x.style.fontSize='18px';
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
    if(this.id=="liked"){
    this.id="unliked";
    $.ajax({
        method:'POST',
        url:likeurl,
        data:{Like:'unlike',post_id:post_id,_token:token}

    })
    .done(function(msg) {
            console.log("ajax unliked");
            // var body = JSON.parse(msg);
            document.getElementsByName(msg["post_id"]).innerText="Like";
            var a=document.getElementById('count').innerText;
            b=Number(a);
            b++;
            console.log(a);

    });

    }
    else{
    this.id="liked";
    $.ajax({
        method:'POST',
        url:likeurl,
        data:{Like:'like',post_id:post_id,_token:token}

    })
    .done(function(msg) {
          console.log("ajax liked");
          // var body = JSON.parse(msg);
          document.getElementsByName(msg["post_id"]).innerText="Liked";
          console.log(document.getElementsByName(msg["post_id"]).innerText);
          document.getElementsByName(msg["post_id"]).innerText="Liked";
          var a=document.getElementById('count').innerHTML;
          b=Number(a);
          b++;
          console.log(a);

    });
    }


});

$(document).ready(function() {
    $("#tagsave").click(function(){
        $.each($("input[type='checkbox']:checked"), function(){
           subfield.push($(this).val());

       });
        console.log(subfield);
   });

});


$('#tagsave').on('click',function(event){
    var body=document.getElementById('newpost').value;

    $.ajax({
        method:'POST',
        url:createpost,
        data:{body:body,subfields:subfield,_token:token}

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
