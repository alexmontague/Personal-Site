<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
  <div class="search-bg">
  <input type="text" value="Search again" name="s" id="search-input" onfocus="if (this.value == 'Search again') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Search again';}" />
  </div><!--end search-bg-->
  <input type="submit" id="go2" alt="Search" title="Search" value="Search" />
</form>