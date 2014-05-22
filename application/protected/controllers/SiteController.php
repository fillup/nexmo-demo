<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	public function actionLoadAccountNumbers()
    {
        $key = Yii::app()->request->getParam('key',false);
        $secret = Yii::app()->request->getParam('secret',false);

        $nexmo = new Nexmo($key,$secret);
        $this->returnJson($nexmo->getAccountNumbers());
    }


    public function actionSendSms()
    {
        $key    = Yii::app()->request->getParam('key',false);
        $secret = Yii::app()->request->getParam('secret',false);
        $from   = Yii::app()->request->getParam('from',false);
        $to     = Yii::app()->request->getParam('to',false);
        $text   = Yii::app()->request->getParam('text',false);

        $nexmo  = new Nexmo($key,$secret);
        $response = $nexmo->sendSms($from,$to,$text);
        $this->returnJson($response);
    }

    public function actionGetHistoryToNumber()
    {
        $key     = Yii::app()->request->getParam('key',false);
        $secret  = Yii::app()->request->getParam('secret',false);
        //$since   = Yii::app()->request->getParam('since',false);
        $to      = Yii::app()->request->getParam('to',false);

        $nexmo = new Nexmo($key,$secret);
        $response = $nexmo->getHistoryToNumber($to,date('Y-m-d',time()));
        $this->returnJson($response);
    }

    public function returnJson($data,$status=200)
    {
        $this->layout = null;
        header('Content-type: application/json',true,$status);
        echo is_array($data) ? json_encode($data) : json_encode(json_decode($data));
        Yii::app()->end();
    }
}