@extends('master')


@section('title')
Dashboard
@endsection
@include('postvalidate')
@section('content')
<link rel='stylesheet' href={{URL::to('src/css/dashboard.css')}}>
<div id='error' class='error'>
</div>
<div id='success' class='success'>
</div>
<header>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{route('dashboard')}}">My Chats</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{route('dashboard')}}">Dashboard</a></li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
 
</nav>
</header>
<div class='row newpost'>
        <div class='col-md-3 container-fluid eq_height '>
          <div class="left">
            <h5>Your Chats</h5>
           
          </div>
        </div>
        <div class='col-md-9 container-fluid eq_height'>
            <section class='newpost'>
               <label for="Group">   
                    <article>
                            <div class='info'>Group1 
                            <br></div><div class="details">
                            </div>
                           <p class="postcont">This is group 1</p>
                             <div class='interaction'>
                           <p>
                        
                           </p>
                       </div>
                     </article>
                </label>     
             </section>
             <section class='newpost'>
                    <label for="Group">   
                         <article>
                                 <div class='info'>Group1 
                                 <br></div><div class="details">
                                 </div>
                                <p class="postcont">This is group 1</p>
                                  <div class='interaction'>
                                <p>
                             
                                </p>
                            </div>
                          </article>
                     </label>     
                  </section>
                  <section class='newpost'>
                        <label for="Group">   
                             <article>
                                     <div class='info'>Group1 
                                     <br></div><div class="details">
                                     </div>
                                    <p class="postcont">This is group 1</p>
                                      <div class='interaction'>
                                    <p>
                                 
                                    </p>
                                </div>
                              </article>
                         </label>     
                      </section>

                      <section class='newpost'>
                            <label for="Group">   
                                 <article>
                                         <div class='info'>Group1 
                                         <br></div><div class="details">
                                         </div>
                                        <p class="postcont">This is group 1</p>
                                          <div class='interaction'>
                                        <p>
                                     
                                        </p>
                                    </div>
                                  </article>
                             </label>     
                          </section>
                          
                          <section class='newpost'>
                                <label for="Group">   
                                     <article>
                                             <div class='info'>Group1 
                                             <br></div><div class="details">
                                             </div>
                                            <p class="postcont">This is group 1</p>
                                              <div class='interaction'>
                                            <p>
                                         
                                            </p>
                                        </div>
                                      </article>
                                 </label>     
                              </section>    
         <!--</div></div>
    
    
             <div name='posts' class='row post'>
                <div class='col-md-3'></div>
                <div class='col-md-9'>-->
                   
    

                </div>
            </div>
    
           
         
        </div>
      
    </div>
    @endsection
    
    
  
    
        
    


