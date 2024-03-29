<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div id="body-wrapper">

      <div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->

          <h1 id="sidebar-title"><a href="#">Inicia</a></h1>

          <!-- Logo (221px wide) -->
          <br/><br/>
          <center>
          <a href="<?php echo url_for(@homepage); ?>"><?php echo image_tag('UdeC.png','size=150x71'); ?></a>
          </center>
          <br/><br/>
          <!-- Sidebar Profile links -->
          <?php if ($sf_user->isAuthenticated()): ?>
          <div id="profile-links">
				Bienvenido, <a href="#" title="Editar Perfil"><?php echo $sf_user->getGuardUser()->getName(); ?></a><br />
            <br />
            <a href="<?php echo url_for('@sf_guard_signout'); ?>" title="Logout">Logout</a>
          </div>
          <!-- END-Sidebar Profile links -->

          <ul id="main-nav">  <!-- Accordion Menu -->

            <li>
              <a href="#" class="nav-top-item <?php if($sf_context->getModuleName()=='energiaDia' || $sf_context->getModuleName()=='energiaPeriodo' || $sf_context->getModuleName()=='energiaMes') echo "current"; ?>"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
		Gr&aacute;ficos Energia
              </a>
              <ul>
                <li><a <?php if($sf_context->getActionName()=='index' && $sf_context->getModuleName()=='energiaDia') echo "class='current'"; ?> href="<?php echo url_for('energiaDia/index'); ?>">Diario</a></li>
                <li><a <?php if($sf_context->getActionName()=='index' && $sf_context->getModuleName()=='energiaPeriodo') echo "class='current'"; ?> href="<?php echo url_for('energiaPeriodo/index'); ?>">Periodo</a></li>
<!--                <li><a href="#">Mensual</a></li>-->
                
              </ul>
            </li>
            <li>
              <a href="#" class="nav-top-item <?php if($sf_context->getModuleName()=='potenciaDia' || $sf_context->getModuleName()=='potenciaPeriodo' || $sf_context->getModuleName()=='potenciaMes') echo "current"; ?>">
		Gr&aacute;ficos Potencia
              </a>
              <ul>
                <li><a <?php if($sf_context->getActionName()=='index' && $sf_context->getModuleName()=='potenciaDia') echo "class='current'"; ?> href="<?php echo url_for('potenciaDia/index'); ?>">Diario</a></li>
                <li><a <?php if($sf_context->getActionName()=='index' && $sf_context->getModuleName()=='potenciaPeriodo') echo "class='current'"; ?> href="<?php echo url_for('potenciaPeriodo/index'); ?>">Periodo</a></li>
<!--                <li><a <?php //if($sf_context->getActionName()=='index' && $sf_context->getModuleName()=='potenciaMes') echo "class='current'"; ?> href="<?php echo url_for('potenciaMes/index'); ?>">Mensual</a></li>-->
                
              </ul>
            </li>
            <li>
              <a href="<?php echo url_for('informes/index'); ?>" class="nav-top-item <?php if($sf_context->getModuleName()=='informes') echo "current"; ?>">
		Informes de Facturaci&oacute;n
              </a>
              <ul>
                <li><a <?php if($sf_context->getModuleName()=='informes') echo "class='current'"; ?> href="<?php echo url_for('informes/index'); ?>">Facturaci&oacute;n Estimada</a></li>
              </ul>
            </li>
            <li>
              <a href="#" class="nav-top-item <?php if($sf_context->getModuleName()=='sensores' || $sf_context->getModuleName()=='ptomonit' || $sf_context->getModuleName()=='recintos') echo "current"; ?>"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
		&Aacute;reas de Evaluaci&oacute;n
              </a>
              <ul>
                <li><a <?php if($sf_context->getModuleName()=='recintos') echo "class='current'"; ?> href="<?php echo url_for('recintos/index'); ?>">Recintos</a></li>
                <li><a <?php if($sf_context->getModuleName()=='ptomonit') echo "class='current'"; ?> href="<?php echo url_for('ptomonit/index'); ?>">Puntos de Monitoreo</a></li>
                <li><a <?php if($sf_context->getModuleName()=='sensores') echo "class='current'"; ?> href="<?php echo url_for('sensores/index'); ?>">Sensores</a></li>
              </ul>
            </li>
            <li>
              <a href="#" class="nav-top-item <?php if($sf_context->getModuleName()=='tarifa' || $sf_context->getModuleName()=='unidades' || $sf_context->getModuleName()=='cargos') echo "current"; ?>"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
		Sistema Tarifario
              </a>
              <ul>
                <li><a <?php if($sf_context->getModuleName()=='tarifa') echo "class='current'"; ?> href="<?php echo url_for('tarifa/index'); ?>">Tarifas</a></li>
                <li><a <?php if($sf_context->getModuleName()=='cargos') echo "class='current'"; ?> href="<?php echo url_for('cargos/index'); ?>">Cargos</a></li>
                <li><a <?php if($sf_context->getModuleName()=='unidades') echo "class='current'"; ?> href="<?php echo url_for('unidades/index'); ?>">Unidades</a></li>
              </ul>
            </li>
            <li>
              <a href="<?php echo url_for('tarifa/index'); ?>" class="nav-top-item <?php if($sf_context->getModuleName()=='a') echo "current"; ?>"> <!-- Add the class "no-submenu" to menu items with no sub menu -->
		Acerca de
              </a>
              <ul>
                <li><a href="#">Acerca de</a></li>
              </ul>
            </li>

          </ul> <!-- End #main-nav -->
          <?php endif; ?>

        </div></div> <!-- End #sidebar -->

      <div id="main-content"> <!-- Main Content Section with everything -->

        <noscript> <!-- Show a notification if the user has disabled javascript -->
          <div class="notification error png_bg">
            <div>
						Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
            </div>
          </div>
        </noscript>

        <div class="clear"></div> <!-- End .clear -->
        <?php echo $sf_content; ?>


        <div class="clear"></div>

        <div id="footer">
          <small> <!-- Remove this notice or replace it with whatever you want -->
            &#169; Copyright 2011 | Powered by <a href="http://www.webdevel.cl">WebDevel.cl</a>
          </small>
        </div><!-- End #footer -->

      </div> <!-- End #main-content -->

    </div>
  </body>
</html>
