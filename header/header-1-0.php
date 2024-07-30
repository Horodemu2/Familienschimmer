<head>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$metatext = "lorem ipsum";
$metatitle1 = "lorem ipsum";
 ?>
 <meta charset="utf-8">
 <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
 <title><?php echo $metatitle1; ?></title>
 <meta name="description" content="<?php echo $metadescription1; ?>" />
 <meta name="robots" content="index, follow">
 <link rel="canonical" href="<?php $urlh; ?>">
 <meta property="og:locale" content="de_DE">
  <meta property="og:url" content="<?php echo $urlh . $cpath; ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo $metatitle1; ?>">
  <meta property="og:description" content="<?php echo $metadescription; ?>">
  <meta property="og:image" content="<?php echo $urlad . $logo_jpg; ?>">
  <meta property="og:keywords" content="<?php echo $metatitle1; ?>">

  <!-- Twitter Meta Tags -->
  <meta name="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="<?php echo $urlh . $cpath; ?>">
  <meta property="twitter:domain" content="<?php echo $urlh; ?>">
  <meta name="twitter:title" content="<?php echo $metatitle1; ?>">
  <meta name="twitter:description" content="<?php echo $metadescription; ?> ">
  <meta name="twitter:image" content="<?php echo $urlad . $logo_jpg1; ?>">


  <!-- the preload
  <link href="< ?php echo $and2_small; ?>" rel="preload" as="image">
  <link href="< ?php echo $and3_small; ?>" rel="preload" as="image">
  <link href="< ?php echo $logo_jpg; ?>" rel="preload" as="image">
  <link href="< ?php echo $logo_png; ?>" rel="preload" as="image">
  <link href="< ?php echo $and4_bigger; ?>" rel="preload" as="image">
  <link href="< ?php echo $styles; ?>" rel="preload" as="style">
  -->
  <!--Touch-Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $urlad . $logo_jpg; ?>">
    <meta name="msapplication-square70x70logo" content="<?php echo $urlad . $logo_jpg; ?>" />
  	<meta name="msapplication-square150x150logo" content="<?php echo $urlad . $logo_jpg; ?>" />
  	<meta name="msapplication-wide310x150logo" content="<?php echo $urlad . $logo_jpg; ?>" />
  	<meta name="msapplication-square310x310logo" content="<?php echo $urlad . $logo_jpg; ?>" />

  <!-- Andere Meta-Tags und Header-Elemente hier -->
  <link rel="sitemap" type="application/xml" title="Sitemap" href="/sitemap.xml">

  <!-- the stylesheet -->
  <link href="<?php echo $stylesmin ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo $styles ?>" rel="stylesheet" type="text/css">

  <!-- script in Headers -->
  <script src="/styles/js/scroll-element-1-0.js" type="text/javascript"></script>
  <script src="https://kit.fontawesome.com/2cb54e4246.js" crossorigin="anonymous"></script>

  <!--?php
  if ((isset($_SESSION['marketingCookies']) && $_SESSION['marketingCookies'] === 1) || (isset($_SESSION['AllCookies']) && $_SESSION['AllCookies'] === 1)): ?>
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-4TQHDPC4NL"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-4TQHDPC4NL');
  </script>
-->
</head>
