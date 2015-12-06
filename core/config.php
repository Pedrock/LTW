<?php
  $_CONFIG['web_root'] = str_replace("\\","",dirname($_SERVER['SCRIPT_NAME'])).'/';
  $_CONFIG['jquery'] = 'js/jquery-1.11.3.min.js';
  $_CONFIG['allowed_image_types'] = array(IMAGETYPE_GIF,IMAGETYPE_JPEG,IMAGETYPE_PNG);
  $_CONFIG['uploads_path'] = 'uploads/';
  $_CONFIG['max_image_upload'] = 10485760; // 10 MB
?>