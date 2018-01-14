@extends('master')

@section('title')
Renegade

@endsection
@section('content')
<link rel='stylesheet' href={{URL::to('src/css/chat.css')}}>
  <body>
          <div id="app" >

            <div class="menu">
            <a href="#" class="back"><i class="fa fa-angle-left"></i> <img src="https://i.imgur.com/G4EjwqQ.jpg" draggable="false"/></a>
            <div class="panel-heading">
                      Chatroom
                      <div class="members">users</div>
                      <span class="badge pull-right">@{{ usersInRoom.length }}</span>
            </div>

        </div>
              <chat-log :messages="messages"></chat-log>
              <chat-composer v-on:messagesent="addMessage"></chat-composer>
          </div>
          <script src="js/app.js" charset="utf-8"></script>
  </body>
@endsection
