<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Nexmo Demo <small>SMS Proxy Example</small></h1>
<form class="form-horizontal" role="form">
    <div class="form-group">
        <label for="inputKey" class="col-sm-2 control-label">Nexmo API Key</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="inputKey" placeholder="Key" value="">
        </div>
    </div>

    <div class="form-group">
        <label for="inputSecret" class="col-sm-2 control-label">Nexmo API Secret</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="inputSecret" placeholder="Secret" value="">
        </div>
        <span class="help-block">Don't worry, we don't save this in any way.</span>
    </div>

    <div class="form-group">
        <label for="inputFromPhone" class="col-sm-2 control-label">From Phone</label>
        <div class="col-sm-3">
            <select name="fromPhone" id="fromPhoneSelect" style="display: none;">

            </select>
            <a class="btn btn-info btn-xs" id="loadAccountNumbersButton" href="javascript:void()">Load from Nexmo</a>
        </div>
    </div>

    <div class="form-group">
        <label for="inputToPhone" class="col-sm-2 control-label">To Phone</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="inputToPhone" placeholder="2125551212">
        </div>
    </div>

    <div class="form-group">
        <label for="inputMessage" class="col-sm-2 control-label">Message</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="inputMessage" placeholder="Well...hello.">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-3">
            <a class="btn btn-default" id="sendSmsButton" href="javascript:void()">Send Message</a>
        </div>
        <div class="col-sm-7">
            <p class="bg-success" id="successMessage" style="display:none;"></p>
        </div>
    </div>
</form>
<div class="col-sm-12" style="display:none;" id="historyDiv">
    <h3>History with <span id="toPhoneText"></span></h3>
</div>

<script type="text/javascript">
    $(function(){
        $('#loadAccountNumbersButton').click(function(){
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('site/loadAccountNumbers'); ?>',
                type: 'post',
                data: {
                    key: $('#inputKey').val(),
                    secret: $('#inputSecret').val()
                },
                success: function(response){
                    console.log(response);
                    for(var i=0; i<response.count; i++){
                        console.log(response.numbers[i]);
                        $('#fromPhoneSelect').append('<option value="'+response.numbers[i].msisdn+'">'+response.numbers[i].msisdn+'</option>');
                    }
                    $('#loadAccountNumbersButton').hide();
                    $('#fromPhoneSelect').fadeIn();
                }
            });
        });

        $('#sendSmsButton').click(function(){
            $('#successMessage').hide().empty();
            $('#historyDiv').hide();
            $('#historyData').empty();
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('site/sendSms'); ?>',
                type: 'post',
                data: {
                    key: $('#inputKey').val(),
                    secret: $('#inputSecret').val(),
                    from: $('#fromPhoneSelect').val(),
                    to: $('#inputToPhone').val(),
                    text: $('#inputMessage').val()
                },
                success: function(response){
                    console.log(response);
                    var msg = 'Status Code: '+response.messages[0].status;
                    if(response.messages[0].status !== "0"){
                        msg += '<br />Error: '+response.messages[0]['error-text'];
                    }
                    $('#successMessage').empty().append(msg);
                    $('#successMessage').fadeIn();

                    getHistoryToNumber();
                }
            });
        });
    });

    function getHistoryToNumber(){
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('site/getHistoryToNumber'); ?>',
            type: 'post',
            data: {
                key: $('#inputKey').val(),
                secret: $('#inputSecret').val(),
                to: $('#inputToPhone').val()
            },
            success: function(response){
                console.log(response);
                if(response['error-code']){
                    $('#historyData').append('<dt>Error</dt>');
                    $('#historyData').append('<dd>'+response['error-code']+'</dd>');
                } else {
                    $('#historyDiv').append('Total Messages: '+response.count);
                    for(var i=0; i<response.count; i++){
                        $('#historyDiv').append('<dl>');

                        $('#historyDiv').append('<dt>Date Received</dt>');
                        $('#historyDiv').append('<dd>'+response.items[i]['date-received']+'</dd>');

                        $('#historyDiv').append('<dt>Type</dt>');
                        $('#historyDiv').append('<dd>'+response.items[i]['type']+'</dd>');

                        $('#historyDiv').append('<dt>Message ID</dt>');
                        $('#historyDiv').append('<dd>'+response.items[i]['message-id']+'</dd>');

                        $('#historyDiv').append('<dt>From</dt>');
                        $('#historyDiv').append('<dd>'+response.items[i]['from']+'</dd>');

                        $('#historyDiv').append('<dt>Body</dt>');
                        $('#historyDiv').append('<dd>'+response.items[i]['body']+'</dd>');


                        $('#historyDiv').append('</dl>');
                    }

                }
                $('#toPhoneText').empty().append($('#inputToPhone').val());
                $('#historyDiv').fadeIn();
            }
        });
    }
</script>