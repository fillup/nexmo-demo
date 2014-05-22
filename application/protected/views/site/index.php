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
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Remember me
                </label>
            </div>
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
            $('#successMessage').hide();
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
                    $('#successMessage').empty().append(msg);
                    $('#successMessage').fadeIn();
                }
            });
        });
    });
</script>