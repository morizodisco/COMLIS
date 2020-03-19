<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?= $options['site_name'] ?> - <?= $media['media_name'] ?> -</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="<?= $options['site_keywords'] ?>"/>
    <meta name="description" content="<?= $options['site_description'] ?>"/>
    <link rel="icon" href="<?= $image_url($options['logo_mark']) ?>">
    <link rel="shortcut icon" href="<?= $image_url($options['logo_mark']) ?>">
    <link rel="apple-touch-icon" href="<?= $image_url($options['logo_mark']) ?>"/>
    <link rel="stylesheet" href="https://use.typekit.net/uxu6qfg.css">
    <link href="https://fonts.googleapis.com/css?family=Crimson+Text:400,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link href="/css/default.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/animate.css"/>
    <link rel="stylesheet" type="text/css" href="/css/jquery.cleditor.css"/>
    <link href="/css/<?= (!empty($sp)) ? $sp : '' ?>style.css" rel="stylesheet">

    <?php if (!empty($options['css'])) : ?>
        <style>
            <?= $options['css'] ?>
        </style>
    <?php endif; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/js/wow.min.js"></script>
    <script src="/js/common.js"></script>
    <?php if (!empty($options['global_tag'])) : ?>
        <?= $options['global_tag'] ?>
    <?php endif; ?>
    <?php if (!empty($options['conversion_tag'])) : ?>
        <?= $options['conversion_tag'] ?>
    <?php endif; ?>

    <?php if (!empty($options['javascript'])) : ?>
        <?= $options['javascript'] ?>
    <?php endif; ?>
</head>

<body>
<div id="wrapper">