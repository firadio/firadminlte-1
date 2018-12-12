<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>飞儿云管理系统</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $URL_AdminLTE;?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $URL_AdminLTE;?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $URL_AdminLTE;?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- vuejs -->
  <!--<script src="https://cdn.jsdelivr.net/npm/vue"></script>-->
  <!--<script src="https://cdn.jsdelivr.net/npm/vue-resource"></script>-->
  <!-- https://www.bootcdn.cn/axios/ -->
  <!--
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/7.0.0-beta.49/polyfill.min.js"></script>
  -->
  <script src="<?php echo $url_static;?>/lib/vue.min.js"></script>
  <script src="<?php echo $url_static;?>/lib/axios.min.js"></script>
  <script src="<?php echo $url_static;?>/lib/polyfill.min.js"></script>
  <script>
    const URL_INSTALL = '<?php echo $URL_INSTALL;?>';
    const URL_NAV = '<?php echo $URL_NAV;?>';
    const APIURL = 'http://8613.http.feieryun.cn:8613';
    const APIURL_UC = URL_INSTALL + '/api/api_uc.php';
    const APIURL_APP = URL_INSTALL + '/api/api_uc.php';
  </script>
  <script src="<?php echo $url_static;?>/vue/common.js?7"></script>
