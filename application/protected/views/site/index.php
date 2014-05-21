<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Nexmo Demo <small>SMS Proxy Example</small></h1>
<form class="form-horizontal" role="form">
    <div class="form-group">
        <label for="inputKey" class="col-sm-2 control-label">Nexmo API Key</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="inputKey" placeholder="Key">
        </div>
    </div>

    <div class="form-group">
        <label for="inputSecret" class="col-sm-2 control-label">Nexmo API Secret</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="inputSecret" placeholder="Secret">
        </div>
    </div>

    <div class="form-group">
        <label for="inputPhone" class="col-sm-2 control-label">To Phone</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="inputPhone" placeholder="2125551212">
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
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Send Message</button>
        </div>
    </div>
</form>