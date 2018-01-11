@extends('master')

@section('title')
Renegade

@endsection
@section('content')

  <body>
          <div id="app" >
            <div class="panel-heading">
                      Chatroom
                      <span class="badge pull-right">@{{ usersInRoom.length }}</span>
            </div>
              <chat-log :messages="messages"></chat-log>
              <chat-composer v-on:messagesent="addMessage"></chat-composer>
          </div>
          <script src="js/app.js" charset="utf-8"></script>
  </body>
@endsection
