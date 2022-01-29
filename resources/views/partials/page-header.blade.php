<div class="page-header ps-5 mb-3">
  <h1><?php echo $current_user->user_firstname;?></h1>
  <?php if(is_front_page()):?>
    <h1><?php echo $current_user->user_firstname;?></h1>
  <?php endif;?>
  <!-- <h1>{!! App::title() !!}</h1>-->
</div>
