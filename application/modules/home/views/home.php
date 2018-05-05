<div class="row">  

<?php for($i = 0; $i < 6; $i++): ?>
<?php $r = rand(0, 1); ?>
<div class="col-6 col-sm-4 col-lg-2">
  <div class="card">
    <div class="card-body p-3 text-center">
      <div class="text-right <?php echo ($r > 0.5) ? 'text-green' : 'text-red';?>">
        <?php echo rand(5, 100); ?>%
        <i class="fe <?php echo ($r > 0.5) ? 'fe-chevron-up' : 'fe-chevron-down';?>"></i>
      </div>
      <div class="h1 m-0"><?php echo rand(10, 100); ?></div>
      <div class="text-muted mb-4">Texto</div>
    </div>
  </div>
</div>
<?php endfor; ?>

</div>