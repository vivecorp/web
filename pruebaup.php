<!DOCTYPE html>
<!-- release v4.4.2, copyright 2014 - 2017 Kartik Visweswaran -->
<!--suppress JSUnresolvedLibraryURL -->
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Krajee JQuery Plugins - &copy; Kartik</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="uploader/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
  <link href="uploader/themes/explorer/theme.css" media="all" rel="stylesheet" type="text/css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="uploader/js/plugins/sortable.js" type="text/javascript"></script>
  <script src="uploader/js/fileinput.js" type="text/javascript"></script>
  <script src="uploader/js/locales/fr.js" type="text/javascript"></script>
  <script src="uploader/js/locales/es.js" type="text/javascript"></script>
  <script src="uploader/themes/explorer/theme.js" type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
</head>

<body>
  <div class="container kv-main">
    <div class="page-header">
      <h1>gonzalo veizagae anzaldoyyyyy
            <small><a href="https://github.com/kartik-v/bootstrap-fileinput-samples"><i
                    class="glyphicon glyphicon-download"></i> Download nueva prueba Files</a></small>
        </h1>
    </div>
    <!-- <form enctype="multipart/form-data" action="upload.php" name="wfrUpload" method="post"> -->

      <input id="archivo" name="archivo" class="file-loading" type="file" multiple="false">
      <br>
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-default">Reset</button>
    <!-- </form> -->

  </div>
</body>
<script>
  $("#archivo").fileinput({
    // uploadUrl: 'upload.php', // you must set a valid URL here else you will get an error
    allowedFileExtensions: ['jpg', 'png', 'gif'],
    // overwriteInitial: false,
    // maxFileSize: 1000,
    // maxFilesNum: 1,
    allowedFileTypes: ['image'],
    // slugCallback: function(filename) {
    //   return filename.replace('(', '_').replace(']', '_');
    // }
    showUpload: false
  });
</script>

</html>
