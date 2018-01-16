@extends('master')


@section('title')
Dashboard
@endsection
@include('postvalidate')
@section('content')
<link rel='stylesheet' href={{URL::to('src/css/dashboard.css')}}>
<link rel='stylesheet' href={{URL::to('src/css/adduserfield.css')}}>
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
      <a class="navbar-brand" href="{{route('dashboard')}}" style='font-family: helveticaneuecondensedbold'>My Chats</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{route('dashboard')}}" style='font-family: helveticaneuecondensedbold'>Dashboard</a></li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
 
</nav>
</header>
<div class='row newpost'>
        {{--  <div class='col-md-3 container-fluid eq_height '>
          
        </div>  --}}
          <body>
    
             <div name='posts' class='row post'>
                <div>
                  <div class="dashboard clearfix">
                    <div class="col-md-6 clearfix">
                      <div class="big notes-thumb" >
                        <span class="icon-font" aria-hidden="true"></span>
                        <p>Art & Culture</p>
                      </div>
                      <div class="small lock-thumb">
                         <p>Biology & Management</p>
                      </div>
                      <div class="small last cpanel-thumb" >
                        <span class="icon-font" aria-hidden="true"></span>
                        <p>Business & Management</p>
                      </div>
                      <div class="big notes-thumb" >
                        <span class="icon-font" aria-hidden="true"></span>
                        <p>Chemistry </p>
                      </div>
                      <div class="big calculator-thumb" ><span class="icon-font" aria-hidden="true" "&#xe017;"></span><p> Create </p></div>
                    </div>
                    <div class="col-md-6 clearfix">
                      <div class="big organizer-thumb" ><span class="icon-font" aria-hidden="true"></span><p>Communication</p></div>
                      <div class="big news-thumb" ><span class="icon-font" aria-hidden="true"></span><p>Computer Science</p></div>
                      <div class="small calendar-thumb" ><span class="icon-font" aria-hidden="true"></span><p>Data Analysis & Statistics</p></div>
                      <div class="small last paint-thumb" ><span class="icon-font" aria-hidden="true"></span><p>Design </p></div>
                      <div class="big weather-thumb" ><span class="icon-font" aria-hidden="true"></span><p>Economics & Finance</p></div>
                    </div>
                    <div class="col-md-6 clearfix">      
                      <div class="big photos-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Education & Teacher Training </p></div>
                      <div class="small alarm-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Electronics </p></div>
                      <div class="small last favorites-thumb" ><span class="icon-font" aria-hidden="true"></span><p>Energy & Earth Sciences</p></div>
                      <div class="big games-thumb" ><span class="icon-font" aria-hidden="true"></span><p>Engineering</p></div>
                      <div class="small git-thumb" ><span class="icon-font" aria-hidden="true"></span><p>Environmental Studies </p></div>
                      <div class="small last code-thumb" ><span class="icon-font" aria-hidden="true"></span><p>Ethics </p></div>
                    </div>
                    <div class="col-md-6 clearfix">      
                      <div class="big photos-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Food & Nutrition </p></div>
                      <div class="small alarm-thumb" ><span class="icon-font" aria-hidden="true"></span><p>Health & Safety </p></div>
                      <div class="small last favorites-thumb" ><span class="icon-font" aria-hidden="true"></span><p>History </p></div>
                      <div class="big games-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Humanities </p></div>
                      <div class="small git-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Language </p></div>
                      <div class="small last code-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Law </p></div>
                    </div>
                    <div class="col-md-6 clearfix">      
                      <div class="big photos-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Literature </p></div>
                      <div class="small alarm-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Math </p></div>
                      <div class="small last favorites-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Medicine </p></div>
                      <div class="big games-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Music </p></div>
                     
                    </div>
                    <div class="col-md-6 clearfix">
                        <div class="small git-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Philanthropy </p></div>
                        <div class="small last code-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Philosophy & Ethics </p></div>
                        <div class="small git-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Physics </p></div>
                        <div class="small last code-thumb" ><span class="icon-font" aria-hidden="true"></span><p> Social Science </p></div>
                  <div class="col-md-6 clearfix">
                    
             
              
              <!--====================================end demo wrapper================================================-->
                <script src="js/jquery-1.8.2.min.js"></script>
                <script src="js/modernizr-1.5.min.js"></script>
                <script src="js/scripts.js"></script>
               
                
                </div>
               
          
            </div>
    
           
         
        </div>
      
    </div>
    @endsection
    
    
  
    
        
    


