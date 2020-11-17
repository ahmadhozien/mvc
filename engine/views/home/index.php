<?php
  // setting the page's title
  $this->set_site_title('Home Page');
?>


<?php
  // start the head are
  $this->start('head');
?>
<!-- meta tags & additional style  -->
<meta content="test description"/>


<?php
  // end the head area
  $this->end();
?>
<?php
  // start the body area
  $this->start('body');
?>
<!-- body content -->
<h1 class="text-center">Hello, world!</h1>
<button class="btn btn-primary">hey</button>
<!-- end body content  -->
<?php
$this->end();
