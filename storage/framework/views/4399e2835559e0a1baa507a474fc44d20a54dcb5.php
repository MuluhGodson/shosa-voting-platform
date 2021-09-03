<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            <?php echo e(__('Candidates for ')); ?> <span class="uppercase"> <?php echo e($contest->name); ?> </span>
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('candidate-component', ['contest' => $contest])->html();
} elseif ($_instance->childHasBeenRendered('mtbATxW')) {
    $componentId = $_instance->getRenderedChildComponentId('mtbATxW');
    $componentTag = $_instance->getRenderedChildComponentTagName('mtbATxW');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('mtbATxW');
} else {
    $response = \Livewire\Livewire::mount('candidate-component', ['contest' => $contest]);
    $html = $response->html();
    $_instance->logRenderedChild('mtbATxW', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH /var/www/shosa/resources/views/admin/candidate/index.blade.php ENDPATH**/ ?>