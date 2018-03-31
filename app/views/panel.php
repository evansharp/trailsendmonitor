<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?> - Trail's End Monitor</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="<?php echo assets_url();?>css/libs/purecss/pure-min.css">
	<link rel="stylesheet" href="<?php echo assets_url();?>css/libs/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo assets_url();?>css/monitor-base.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="<?php echo assets_url();?>css/pure-side-bar.css?v=<?php echo time();?>">
	<link rel="stylesheet" href="<?php echo assets_url();?>css/monitor-topbar.css?v=<?php echo time();?>">
</head>

<body>

	<div id="layout">

    <div id="menu">
        <div class="pure-menu">
            <a class="pure-menu-heading" href="<?php echo base_url();?>">Trail's End Monitor</a>

            <ul class="pure-menu-list">
        		<li class="pure-menu-item <?php if($active_nav == 'dashboard') echo 'active';?>">
        			<a href="<?php echo base_url(); ?>" class="pure-menu-link">
        				<i class="fa fa-fw fa-lg fa-tachometer"></i>Dashboard
        			</a>
        		</li>
                <li class="pure-menu-item pure-menu-has-children <?php if($active_nav == 'streams') echo 'active';?>">
                	<a href="<?php echo base_url(); ?>streams" class="pure-menu-link">
                		<i class="fa fa-fw fa-lg fa-filter"></i>Streams
                	</a>
                	<ul class="pure-menu-item-children">
                	    <li class="pure-menu-item">
                	        <a href="<?php echo base_url(); ?>streams/create" class="pure-menu-link">
                		        Create Stream
                	        </a>
                	    </li>
                	    <!--<li class="pure-menu-item">
                	        <a href="<?php echo base_url(); ?>streams/edit" class="pure-menu-link">
                		        Edit Streams
                	        </a>
                	    </li>-->
                	</ul>
                </li>
                <li class="pure-menu-item pure-menu-has-children <?php if($active_nav == 'relations') echo 'active';?>">
                	<a href="<?php echo base_url(); ?>relations" class="pure-menu-link">
                		<i class="fa fa-fw fa-lg fa-line-chart"></i>Relations
                	</a>
                	<ul class="pure-menu-item-children">
                	    <li class="pure-menu-item">
                	        <a href="<?php echo base_url(); ?>relations/create" class="pure-menu-link">
                		        Create Relation
                	        </a>
                	    </li>
                	    <li class="pure-menu-item">
                	        <a href="<?php echo base_url(); ?>relations/edit" class="pure-menu-link">
                		        Edit Relations
                	        </a>
                	    </li>
                	</ul>
                </li>
                <li class="pure-menu-item <?php if($active_nav == 'alerts') echo 'active';?>">
                	<a href="<?php echo base_url(); ?>alerts" class="pure-menu-link">
                		<i class="fa fa-fw fa-lg fa-history"></i> Alert History
                	</a>
                </li>
                <li class="pure-menu-item <?php if($active_nav == 'settings') echo 'active';?>">
        			<a href="<?php echo base_url(); ?>settings" class="pure-menu-link">
        				<i class="fa fa-fw fa-lg fa-cogs"></i>Settings
        			</a>
        		</li>
            </ul>
        </div>
    </div>
    <nav id="topbar">
        <ul>
            <li><a href="#" id="alerts"><i class='fa fa-flash'></i> Recent Alerts</a>
                <ul id="alerts-list">
    				<?php
    					if( !empty( $alerts ) ){
    					    // loop through the alerts and build a colour-coded list
    					    foreach( $alerts as $item ){
    					        $faicon = '';
    					        switch( $item[0] ){
    					           case 'info':
    					               $faicon = 'info-circle';
    					               break;
    					           case 'warning':
    					               $faicon = 'exclamation-triangle';
    					               break;
    					           case 'danger':
    					               $faicon = 'bomb';
    					               break;
    					        }


    						    echo "<li>
                                    <a class='alert-item alert-item-$item[0]' href='$item[3]'>
                                        <i class='fa fa-2x fa-fw fa-$faicon'></i>
                                        $item[1] <span>$item[2]</span>
                                    </a></li>";
    					    }
    					}else{
    						echo '<li><a class="alert-item" href="#"> No Alerts! </a></li>';
    					}
    				?>

    			</ul>
    		</li>
    	</ul>
    </nav>
    <div id="main">
		<?php echo $pane; ?>



	</div> <!-- end #main -->
	</div> <!-- end #layout -->

        <script src="<?php echo assets_url(); ?>js/libs/jquery-3.2.1.min.js"></script>
		<script src="<?php echo assets_url(); ?>js/libs/moment.min.js"></script>
		<script src="<?php echo assets_url(); ?>js/main.js?v=<?php echo time();?>"></script>
    </body>

</html>
