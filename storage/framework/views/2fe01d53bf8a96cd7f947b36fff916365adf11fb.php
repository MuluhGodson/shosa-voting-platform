<?php if (isset($component)) { $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\GuestLayout::class, []); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            <?php echo e(__('Vote for ')); ?> <?php echo e($contest->name); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl sm:w-full mx-auto sm:px-6 lg:px-8 p-4">
            <div class="overflow-hidden sm:rounded-lg">
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('contestant-vote-component', ['contest' => $contest])->html();
} elseif ($_instance->childHasBeenRendered('uAAKEfl')) {
    $componentId = $_instance->getRenderedChildComponentId('uAAKEfl');
    $componentTag = $_instance->getRenderedChildComponentTagName('uAAKEfl');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('uAAKEfl');
} else {
    $response = \Livewire\Livewire::mount('contestant-vote-component', ['contest' => $contest]);
    $html = $response->html();
    $_instance->logRenderedChild('uAAKEfl', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>
        </div>
    </div>
 <?php if (isset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015)): ?>
<?php $component = $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015; ?>
<?php unset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?><?php /**PATH /var/www/shosa/resources/views/user/vote/show.blade.php ENDPATH**/ ?>