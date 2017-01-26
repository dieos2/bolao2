<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$model =  User::findByUsername(Yii::$app->user->identity->username) 
?>


   


   
   
<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-2">
			
			<a href="#" class="profile-picture">
				<img src="/images/profile-picture.png" class="img-responsive img-circle" />
			</a>
			
		</div>
		
		<div class="col-sm-7">
			
			<ul class="profile-info-sections">
				<li>
					<div class="profile-name">
						<strong>
                                                    <a href="#"><?= \app\models\Inquilino::find($model->id)->one()->nome ?></a>
							<a href="#" class="user-status is-online tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="Online"></a>
							<!-- User statuses available classes "is-online", "is-offline", "is-idle", "is-busy" -->						</strong>
						<span><a href="#">Co-Founder at Laborator</a></span>
					</div>
				</li>
				
				<li>
					<div class="profile-stat">
						<h3>643</h3>
						<span><a href="#">followers</a></span>
					</div>
				</li>
				
				<li>
					<div class="profile-stat">
						<h3>108</h3>
						<span><a href="#">following</a></span>
					</div>
				</li>
			</ul>
			
		</div>
		
		<div class="col-sm-3">
			
			<div class="profile-buttons">
				<a href="#" class="btn btn-default">
					<i class="entypo-user-add"></i>
					Follow
				</a>
				
				<a href="#" class="btn btn-default">
					<i class="entypo-mail"></i>
				</a>
			</div>
		</div>
		
	</header>
	
	<section class="profile-info-tabs">
		
		<div class="row">
			
			<div class="col-sm-offset-2 col-sm-10">
				
				<ul class="user-details">
					<li>
						<a href="#">
							<i class="entypo-location"></i>
							Prishtina
						</a>
					</li>
					
					<li>
						<a href="#">
							<i class="entypo-suitcase"></i>
							Works as <span>Laborator</span>
						</a>
					</li>
					
					<li>
						<a href="#">
							<i class="entypo-calendar"></i>
							16 October
						</a>
					</li>
				</ul>
				
				
				<!-- tabs for the profile links -->
				
				
			</div>
			
		</div>
		
	</section>
	
	
	
</div>

 