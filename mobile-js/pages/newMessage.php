<form id="newmessage" class="form">
    <section id="msgHeader" class="default-bg fullWidth">
       <div class="container-fluid">
            <div class="row">
                <div class="col-xs-9">
                    <a href="" class="navigationLink pull-left" style="margin-top:12px">
                        <i class="ion-close"></i>
                    </a>
                    <h4 class="section-title horizontal-margin-sm pull-left">New Message</h4>
                </div>
                <div class="col-xs-3 pull-right text-right" style="padding-right: 0">
                    <button id="sendMessage" class="btn btn-lg btn-default no-border-radius">
                        <i class="ion-paper-airplane"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 horizontal-padding-none">
                    <div id="msgEmailWrap" class="form-group vertical-margin-none">
                        <input class="form-control" id="message-email" name="email" placeholder="Type full email address here">
                        <div id="userList" class="absolute fullWidth white-bg">
                            
                        </div>
                    </div>
                    <div class="form-group vertical-margin-none">
                        <textarea id="message-user" class="form-control" name="message" rows="3" placeholder="Write a message"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>'