

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><?php echo e(__('Edit User')); ?></div>

                <div class="px-4">
                    <form action="/users/<?php echo e($user->id); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="form-group">
                            <label for="name">User Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo e($user->name); ?>">
                            <?php if($errors->has('name')): ?>
                                <strong class="text-danger"><?php echo e($errors->first('name')); ?></strong>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="<?php echo e($user->email); ?>">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            <?php if($errors->has('email')): ?>
                                <strong class="text-danger"><?php echo e($errors->first('email')); ?></strong>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="level_id">Level</label>
                            <select class="form-control" name="level_id">
                                <option value="">--- Select Level ---</option>
                                <?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($level->id); ?>" <?php if($user->level_id == $level->id): ?>
                                        <?php echo 'selected'; ?>

                                    <?php endif; ?>><?php echo e($level->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role_id">Role</label>
                            <select class="form-control" name="role_id">
                                <option value="">--- Select Role ---</option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>" <?php if($user->role_id == $role->id): ?>
                                        <?php echo 'selected'; ?>

                                    <?php endif; ?>><?php echo e($role->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('role_id')): ?>
                                <strong class="text-danger"><?php echo e($errors->first('role_id')); ?></strong>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\projects\freelance\developer-test-vue-main\developer-test-vue-mai\developer-test-vue\resources\views/users/edit.blade.php ENDPATH**/ ?>