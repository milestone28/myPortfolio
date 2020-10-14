


<?php $__env->startSection('content'); ?>

    <div class="card card-default">
    
        <div class="card-header">
            <?php echo e(isset($post) ? 'Edit Post' : 'Create Post'); ?>

        </div>

        <div class="card-body">

            <?php echo $__env->make('partials.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <form action="<?php echo e(isset($post) ? route('posts.update', $post->id) : route('posts.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(isset($post)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="ex. Salamat Shoppee" value="<?php echo e(isset($post) ? $post->title : null); ?>">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="ex. Shopee is a Singaporean e-commerce platform headquartered under Sea Group (previously known as Garena)"><?php echo e(isset($post) ? $post->description : null); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        
                        
                        <input id="content" type="hidden" name="content"  value="<?php echo e(isset($post) ? $post->content : ''); ?>">
                        <trix-editor input="content"></trix-editor>
                    </div>

                    <div class="form-group">
                        <label for="published_at">Published At</label>
                        <input type="text" class="form-control" name="published_at" id="published_at" value="<?php echo e(isset($post) ? $post->published_at : ''); ?>">
                    </div>
                    
                    <?php if(isset($post)): ?>
                        <div class="form-group">
                            <img src="<?php echo e(asset("storage/".$post->image)); ?>" alt="<?php echo e(asset($post->title)); ?>" style="width: 100%">
                        </div>
                        
                    <?php endif; ?>
                    
                    <div class="form-group">
                        <label for="image">Image | upload image high resolution for best view</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>

                    <div class="form-group">
                        <label for="category" >Category</label>
                        <select name="category" id="category" class="form-control">
                            
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"
                                    <?php if(isset($post)): ?>
                                        <?php if($category->id == $post->category_id): ?>
                                        selected
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    > 
                                    <?php echo e($category->name); ?>

                                </option>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </select>
                        
                    </div>

                <?php if($tags->count() > 0): ?>
                    <div class="form-group">
                        
                        <label for="tags">Tags</label>
                        <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tag->id); ?>"
                                        
                                        <?php if(isset($post)): ?>

                                            <?php if($post->hasTag($tag->id)): ?>

                                            selected
                                                
                                            <?php endif; ?>
                                            
                                        <?php endif; ?>

                                        >
                                        <?php echo e($tag->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                                                   
                    </div>
                <?php endif; ?>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><?php echo e(isset($post) ? 'Update Post' : 'Create Post'); ?></button>
                    </div>

            </form> 
        </div>
        
    </div>   
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at', {
            enableTime: true,
            enableSeconds: true
        });

        
    $(document).ready(function() {
        $('.tags-selector').select2();
    });
    </script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
                            
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.0/trix.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\myportfolio\resources\views/posts/create.blade.php ENDPATH**/ ?>