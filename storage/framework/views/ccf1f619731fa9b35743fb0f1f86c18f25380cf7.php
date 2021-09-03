<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-4">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div id="myCalendar" width="200" height="500"  class="bg-gray-300">
                    <?php echo $calendar->calendar(); ?>

                    <?php echo $calendar->script(); ?>

                </div>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('dashboard-component', [])->html();
} elseif ($_instance->childHasBeenRendered('SrGCGwj')) {
    $componentId = $_instance->getRenderedChildComponentId('SrGCGwj');
    $componentTag = $_instance->getRenderedChildComponentTagName('SrGCGwj');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('SrGCGwj');
} else {
    $response = \Livewire\Livewire::mount('dashboard-component', []);
    $html = $response->html();
    $_instance->logRenderedChild('SrGCGwj', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
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
<?php endif; ?>
<?php /**PATH /var/www/shosa/resources/views/dashboard.blade.php ENDPATH**/ ?>