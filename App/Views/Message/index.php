<div class="text-center">
    <a class="btn btn-danger btn-lg" href="/message/deconnexion">Se déconnecter</a>
</div>
<div class="card rare-wind-gradient chat-room">
  <div class="card-body">

    <!-- Grid row -->
    <div class="row px-lg-2 px-2">

      <!-- Grid column -->
      <div class="col-md-6 col-xl-4 px-0">

        <h4 class="font-weight-bold mb-3 text-center text-lg-left">Utilisateurs connectés</h4>
        <div class="white z-depth-1 px-2 pt-3 pb-0 members-panel-1 scrollbar-light-blue">
          <ul class="list-unstyled friend-list" id="usersConnect">
            
          </ul>
        </div>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-6 col-xl-8 pl-md-3 px-lg-auto px-0">

        <div class="chat-message">

          <ul class="list-unstyled chat-1 scrollbar-light-blue messages" id="messages">

          </ul>
          <form method="post" novalidate="novalidate">
            <div class="white">
              <div class="form-group basic-textarea">
                <textarea class="form-control pl-2 my-0" id="exampleFormControlTextarea2" rows="3" placeholder="Message..." name="contenu"></textarea>
              </div>
            </div>
            <button type="submit" class="btn btn-info  float-right send">Envoyer</button>
          </form>

        </div>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
</div>

<script type="text/javascript">

    getAllMessages();

    setInterval(
        function ()
        {
            getAllMessages();
        }, 2000
    );

    function getAllMessages()
    {
        $.ajax(
        {
            type : "POST",
            dataType : "json",
            url : "/message/getAllMessages",
            success : function(messages) {
                $("#messages").empty();
                $.each(messages, function(index, message) {
                    $("#messages").append(' <li class=" justify-content-between mb-4"><div class="chat-body white p-3 ml-2  z-depth-1"><div class="header"><strong class="primary-font">'+message.username+'</strong><small class="pull-right text-muted"><i class="far fa-clock"></i> '+message.datetime+'</small></div><hr class="w-100"><p class="mb-0">'+message.contenu+'</p></div></li>');
                });
            }
        });

        $.ajax(
        {
            type : "POST",
            dataType : "json",
            url : "/message/getUsersConnect",
            success : function(usersConnect) {
                $("#usersConnect").empty();
                $.each(usersConnect, function(index, user) {
                    $("#usersConnect").append('<li class="p-2"><a href="#" class="d-flex justify-content-between"><div class="text-small"><strong>'+user+'</strong></div><div class="chat-footer"><p class="text-smaller text-muted mb-0">En ligne</p><span class="text-muted float-right"><i class="fas fa-mail-reply" aria-hidden="true"></i></span></div> </a></li>');
                });
            }
        });
    }
</script>