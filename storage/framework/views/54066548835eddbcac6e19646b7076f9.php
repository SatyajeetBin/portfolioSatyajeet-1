<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- Login -->
    <div class="card p-2 mt-4">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-2">
            
            
            
        </div>
        
        <!-- /Logo -->

        <div class="card-body">
            

            <form id="formAuthentication" class="mb-3" method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="red-text ml-10 d-block text-start" role="alert">
                        <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <div class="form-floating form-floating-outline mb-3 text-start">
                     <input autocomplete="off" type="text" class="form-control" id="email" name="email" placeholder="Enter your email"
                        autofocus value="<?php echo e(old('email', request()->cookie('email'))); ?>" />
                    <label for="email">Email</label>
                    
                </div>
                <div class="mb-3 text-start ">
                    <div class="form-password-toggle">
                        <div class="input-group input-group-merge">
                            <div class="form-floating form-floating-outline">
                                 <input autocomplete="off" type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" value="<?php echo e(request()->cookie('password')); ?>" />
                                <label for="password">Password</label>
                            </div>
                            <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                        </div>
                        <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password'),'class' => 'mt-2','style' => 'color: red;']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'class' => 'mt-2','style' => 'color: red;']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                    <div class="form-check">
                         <input autocomplete="off" class="form-check-input" type="checkbox" id="remember-me" name="remember"
                            <?php echo e(old('remember', request()->cookie('remember')) ? 'checked' : ''); ?> />
                        <label class="form-check-label" for="remember-me"> Remember Me </label>
                    </div>
                    <a href="<?php echo e(route('password.request')); ?>" class="float-end mb-1">
                        <span>Forgot Password?</span>
                    </a>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
            </form>

            
        </div>
    </div>
    <!-- /Login -->
      
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\binstellar\OneDrive\Desktop\protfolio\resources\views/auth/login.blade.php ENDPATH**/ ?>