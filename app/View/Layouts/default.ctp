<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <title><?php echo $titulo; ?></title>
    <?php echo $this->Html->charset("ISO-8559-1");   ?>
    <?php echo $this->Html->css('intraweb/base');?>
</head>
<body>
    <div id="container">
    <div id="content">


    <?php echo $this->fetch('content'); ?>
    </div>
    </div>

</body>
</html>