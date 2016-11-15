<?php use system\App; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?= App::getInstance()->title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL.'assets/css/style.css';?>" type="text/css" />
    <link href="<?php echo BASE_URL.'assets/css/style.min.css';?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo BASE_URL.'assets/font-awesome/css/font-awesome.css';?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo BASE_URL.'assets/css/style_default.css' ;?>" rel="stylesheet" id="style_color" type="text/css" />
	<link href="<?php echo BASE_URL.'assets/uniform/css/uniform.default.css' ;?>" rel="stylesheet" type="text/css" />
    <?php foreach($css as $fileCss) { ?>
      <link rel="stylesheet" href="<?= $fileCss; ?>" type="text/css" />
    <?php } ?>

</head>

<body>

 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">

          <a class="navbar-brand" href="<?= BASE_URL; ?>">Projets</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <?php if($isLogged): ?>
              <li class=""><a href="#">Résumé</a></li>
              <li class=""><a href="#">Backlog</a></li>
              <li class=""><a href="#">Sprints</a></li>
              <li class=""><a href="#">Traçabilité</a></li>
              <li class=""><a href="#">Paramètres</a></li>
            <?php else: ?>
              <li><a>Connecte toi pour accéder à l'interface</a></li>
            <?php endif; ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <?php if (!$isLogged): ?>
            <li class="active"><a href="<?= BASE_URL; ?>">Connexion / Inscription</a></li>
          <?php else :?>
            <li class="active"><a href="<?= BASE_URL.'Home/disconnect'; ?>">Déconnexion</a></li>
          <?php endif;?>
          </ul>
        </div>
      </div>
    </div>

<div class="container" style="padding-top: 80px; padding-bottom:50px;">
    <?php if($isLogged): ?>
    <div class="row">
      <div class="col-md-12 alert alert-info">
        Bonjour <?= ucfirst($userInfo->prenom); ?> <?= strtoupper($userInfo->nom); ?>. 
      </div>
    </div>
    <?php endif; ?>
    <div class="starter-template">
        <?= $content; ?>
    </div>

</div><!-- /.container -->

    <div id="footer">
      <div class="container">
        <p class="muted credit">Réalisé par Nabila Mokadmi, Antoine Gamelin et Anthony Boschet.</p>
      </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <?php foreach($js as $fileJs) { ?>
      <script src="<?= $fileJs; ?>"></script>
    <?php } ?>
  </body>
</html>


