<div class="col-md-4 col-xl-3">
    <div class="sidebar px-4 py-md-0">

      <h6 class="sidebar-title">Search</h6>

      <form class="input-group" action="" method="GET">
        <input type="text" class="form-control" name="search" placeholder="Search" value="<?php echo e(request()->query('search')); ?>">
        <div class="input-group-addon">
          <span class="input-group-text"><i class="ti-search"></i></span>
        </div>
      </form>

      <hr>

      <h6 class="sidebar-title">Categories</h6>
      <div class="row link-color-default fs-14 lh-24">
       
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-6">
              <a href="<?php echo e(route('blog.category', $category->id)); ?>"><?php echo e($category->name); ?></a>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      <hr>

      

      <hr>

      <h6 class="sidebar-title">Tags</h6>
      <div class="gap-multiline-items-1">
       
          <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a class="badge badge-secondary" href="<?php echo e(route('blog.tag', $tag->id)); ?>"><?php echo e($tag->name); ?></a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

      


    </div>
  </div><?php /**PATH C:\xampp\htdocs\myportfolio\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>