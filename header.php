<?php
use Joomla\CMS\Factory;
$document = Factory::getApplication()->getDocument();
ob_start();
?>
    <header class="u-clearfix u-header u-header" id="sec-598a">
  <div class="u-clearfix u-sheet u-sheet-1">
    <?php $logoInfo = getLogoInfo(array(
            'src' => "/images/logo.png",
            'href' => "#",
        ), true); ?><a href="<?php echo $logoInfo['href']; ?>" class="u-image u-logo u-image-1" data-image-width="1130" data-image-height="1286">
      <img src="<?php echo $logoInfo['src']; ?>" class="u-logo-image u-logo-image-1">
    </a>
    <h3 class="u-text u-text-1">Contacts App </h3>
  </div>
</header>
<?php
ThemeHelper::getInstance()->headerHtml = ob_get_clean();
ob_start();
?>
    
<?php
ThemeHelper::getInstance()->headerExtraHtml = ob_get_clean();
