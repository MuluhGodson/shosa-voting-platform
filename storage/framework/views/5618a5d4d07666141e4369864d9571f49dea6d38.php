<div>
    <div class="p-4">
        <div>
            <a href="<?php echo e(route('candidate.apply', $contest->slug)); ?>" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-gray-200 text-xs uppercase tracking-widest bg-secondary hover:bg-transparent hover:border-secondary hover:text-secondary active:bg-gray-900 focus:outline-none focus:border-secondary focus:ring focus:ring-secondary disabled:opacity-25 transition">
                <?php echo e(__('Add Contestant')); ?>

            </a>
        </div>
    </div>

        <div class="my-4">
        <div class="grid sm:grid-cols-4 gap-4">
            <?php $__empty_1 = true; $__currentLoopData = $contest->candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000" class="shadow-lg transition hover:px-1 duration-500 ease-in-out  col rounded hover:border-r-2 hover:boder-r-white hover:border-l-2 hover:border-l-secondary cursor-pointer hover:transform hover:scale-150">
                    <div wire:click="openCandidate('<?php echo e($cand->slug); ?>')">
                        <img src="<?php echo e(Storage::url($cand->photo)); ?>" class="object-cover object-top h-60 w-full" alt="<?php echo e($cand->name); ?>">
                        <div class="my-1 flex justify-center gap-4 py-1 px-1">
                            <p class="text-sm text-gray-400"><i class="fas fa-birthday-cake"></i> <?php echo e($cand->dob); ?></p>
                            <p class="text-sm text-gray-400"><i class="fas fa-city"></i> <?php echo e($cand->town); ?></p>
                         
                        </div>
                        <div class="p-2 my-1">
                            <h1 class="text-center text-lg text-secondary font-bold uppercase">
                                <span class="text-gray-300">#<?php echo e($cand->id); ?></span> <?php echo e($cand->name); ?>

                            </h1>
                            <p class="text-gray-400 text-center"><?php echo e(Str::words($cand->bio,15,'...')); ?>

                        </div>

                        
                    </div>
                   
                    <div>
                        <div class="flex justify-between content-end p-3">
                            <div>
                                <button wire:click="openEdit('<?php echo e($cand->slug); ?>')"><i class="fas fa-edit text-secondary"></i></button>
                            </div>
                            <div>
                                <button wire:click="delete('<?php echo e($cand->slug); ?>')"><i class="fas fa-trash text-red-500"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-400">No contestants applied yet.</p>
            <?php endif; ?>
        </div>
    </div>



        <?php if($viewCandidate): ?>
        <!-- Modal to view candidate -->
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.dialog-modal','data' => ['class' => 'bg-transparent','wire:model' => 'viewCandidate']]); ?>
<?php $component->withName('jet-dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'bg-transparent','wire:model' => 'viewCandidate']); ?>
                 <?php $__env->slot('title', null, []); ?> 
                    
                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('content', null, []); ?> 

                    <div class="max-w-4xl flex items-center h-auto flex-wrap mx-auto my-32 lg:my-0">
                        
                        <!--Main Col-->
                        <div class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-black bg-opacity-75 mx-6 lg:mx-0">
                        

                            <div class="p-4 md:p-12 text-center lg:text-left">
                                <!-- Image for mobile view-->
                                <div class="block lg:hidden rounded-full shadow-xl object-top mx-auto -mt-16 h-48 w-48 bg-cover bg-center" style="background-image: url('<?php echo e(Storage::url($candidate->photo)); ?>')"></div>
                                
                                <h1 class="text-xl font-bold pt-8 lg:pt-0 text-secondary text-left uppercase"><?php echo e($candidate->name); ?> - <?php echo e($candidate->town); ?></h1>
                                <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                                
                                <div class="text-md text-left">
                                    <p>
                                        Date of Birth: <?php echo e($candidate->dob); ?>

                                    </p>
                                    <p>
                                        Division of Origin: <?php echo e($candidate->division->name); ?>

                                    </p>
                                    <p>
                                        Height: <?php echo e($candidate->height); ?>

                                    </p>
                                    <p>
                                        Profession: <?php echo e($candidate->profession); ?>

                                    </p>
                                    <p>
                                        Email: <?php echo e($candidate->email); ?>

                                    </p>
                                    <p>
                                        Tel: <?php echo e($candidate->tel); ?>

                                    </p>
                                   
                                </div>
                                <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-gray-500 opacity-25"></div>
                                <p class="pt-8 text-sm">
                                    <?php echo e(Str::words($candidate->bio, $text_words , '...')); ?>

                                    <?php if(!$showText): ?>
                                        <button wire:click="openText('<?php echo e($candidate->slug); ?>','y')" class="bg-transparent text-secondary font-bold">See all</button>
                                    <?php else: ?>
                                        <button wire:click="openText('<?php echo e($candidate->slug); ?>','n')" class="bg-transparent text-secondary font-bold">See less</button>
                                    <?php endif; ?>
                                </p>

                                <div class="pt-12 pb-8">
                                    <a href="" class="bg-secondary hover:bg-transparent hover:border hover:border-secondary hover:text-secondary text-white font-bold py-2 px-4 rounded-full">
                                    View Votes
                                    </a> 
                                </div>

                                
                                
                                <!-- Use https://simpleicons.org/ to find the svg for your preferred product --> 

                            </div>

                        </div>
                        
                        <!--Img Col-->
                        <div class="w-full lg:w-2/5">
                            <!-- Big profile image for side bar (desktop) -->
                            <img src="<?php echo e(Storage::url($candidate->photo)); ?>" class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
                        </div>

                        <!-- Pin to top right corner -->
                        <div class="absolute top-0 right-0 h-12 w-18 p-4">
                            <p class="pt-4 font-bold flex items-center justify-center lg:justify-start uppercase text-3xl">
                               #<span class="text-secondary"> <?php echo e($candidate->id); ?></span>
                            </p>
                        </div>

                        <!-- Pin to left corner -->
                        <?php if($candidate->fb_link || $candidate->ig_link || $candidate->twitter_link): ?>
                        <div class="absolute top-0 left-0 h-10 w-18 p-1 text-white">
                            <div class="flex justify-center gap-1 text-sm p-2">
                                <?php if($candidate->fb_link): ?>
                                    <div><a target="_blank" href="<?php echo e($candidate->fb_link); ?>"><i class="fab fa-facebook p-1 border rounded text-gray-200"></i></a></div>
                                <?php endif; ?>
                                <?php if($candidate->ig_link): ?>
                                    <div><a target="_blank" href="<?php echo e($candidate->ig_link); ?>"><i class="fab fa-instagram p-1 border rounded text-gray-200"></i></a></div>
                                <?php endif; ?>
                                <?php if($candidate->twitter_link): ?>
                                    <div><a target="_blank" href="<?php echo e($candidate->twitter_link); ?>"><i class="fab fa-twitter p-1 border rounded text-gray-200"></i></a></div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        

                    </div>
                 <?php $__env->endSlot(); ?>

                     <?php $__env->slot('footer', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.secondary-button','data' => ['class' => 'bg-transparent text-gray-400','wire:click' => '$toggle(\'viewCandidate\')','wire:loading.attr' => 'disabled']]); ?>
<?php $component->withName('jet-secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'bg-transparent text-gray-400','wire:click' => '$toggle(\'viewCandidate\')','wire:loading.attr' => 'disabled']); ?>
                            Close
                         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['class' => 'ml-2 bg-transparent border border-secondary','wire:click' => 'openEdit(\''.e($candidate->slug).'\')','wire:loading.class' => 'bg-transparent']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'ml-2 bg-transparent border border-secondary','wire:click' => 'openEdit(\''.e($candidate->slug).'\')','wire:loading.class' => 'bg-transparent']); ?>
                            Edit
                            <div wire:loading wire:target="openEdit">
                                <img width="20px" src="<?php echo e(asset("images/logo/loading.png")); ?>" class="animate-spin">
                            </div>
                         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.danger-button','data' => ['class' => 'ml-2','wire:click' => 'delete(\''.e($candidate->slug).'\')','wire:loading.class' => 'bg-transparent']]); ?>
<?php $component->withName('jet-danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'ml-2','wire:click' => 'delete(\''.e($candidate->slug).'\')','wire:loading.class' => 'bg-transparent']); ?>
                            Delete
                            <div wire:loading wire:target="delete">
                                <img width="20px" src="<?php echo e(asset("images/logo/loading.png")); ?>" class="animate-spin">
                            </div>
                         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                 <?php $__env->endSlot(); ?>
             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if($editCandidate): ?>
            <!-- Modal to edit candidate -->
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.dialog-modal','data' => ['class' => 'bg-transparent','wire:model' => 'editCandidate']]); ?>
<?php $component->withName('jet-dialog-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'bg-transparent','wire:model' => 'editCandidate']); ?>
                 <?php $__env->slot('title', null, []); ?> 
                    
                 <?php $__env->endSlot(); ?>

                 <?php $__env->slot('content', null, []); ?> 

                           <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.validation-errors','data' => ['class' => 'mb-4']]); ?>
<?php $component->withName('jet-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-4']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

       
            <p class="text-center font-semibold text-gray-300">Update information for <span class="text-secondary"><?php echo e($name); ?></span></p>
            <div class="mt-4">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'name','value' => ''.e(__('Name')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'name','value' => ''.e(__('Name')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'name','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'name','type' => 'text','name' => 'name','value' => old('name'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'name','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'name','type' => 'text','name' => 'name','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('name')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </div>

            <div class="mt-4 grid md:grid-cols-2 grid-cols-1 gap-4 justify-between">
                <div class="mt-2">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'currency','value' => ''.e(__('Gender')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'currency','value' => ''.e(__('Gender')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <select wire:model="gender" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm">
                        <option>Select a gender</option>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>
                </div>
                <div class="mt-2">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'dob','value' => ''.e(__('Date of Birth')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'dob','value' => ''.e(__('Date of Birth')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'dob','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'dob','type' => 'date','name' => 'dob','value' => old('dob'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'dob','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'dob','type' => 'date','name' => 'dob','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('dob')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                </div>
            </div>

            <div class="mt-4">
                 <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'pob','value' => ''.e(__('Division of Origin')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'pob','value' => ''.e(__('Division of Origin')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                 <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('utils.location', ['lt' => $division])->html();
} elseif ($_instance->childHasBeenRendered('pJlUZSp')) {
    $componentId = $_instance->getRenderedChildComponentId('pJlUZSp');
    $componentTag = $_instance->getRenderedChildComponentTagName('pJlUZSp');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('pJlUZSp');
} else {
    $response = \Livewire\Livewire::mount('utils.location', ['lt' => $division]);
    $html = $response->html();
    $_instance->logRenderedChild('pJlUZSp', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            </div>

            <div class="mt-4">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'email','value' => ''.e(__('Email')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'email','value' => ''.e(__('Email')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'email','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'email','type' => 'text','name' => 'email','value' => old('email'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'email','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'email','type' => 'text','name' => 'email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('email')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </div>

            <div class="mt-4">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'tel','value' => ''.e(__('Telephone')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'tel','value' => ''.e(__('Telephone')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'tel','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'tel','type' => 'text','name' => 'tel','value' => old('tel'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'tel','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'tel','type' => 'text','name' => 'tel','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('tel')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </div>

            <div class="mt-4">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'height','value' => ''.e(__('Height')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'height','value' => ''.e(__('Height')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <div class="flex flex-row gap-4 justify-between">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'height','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'height','type' => 'text','name' => 'height','value' => old('height'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'height','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'height','type' => 'text','name' => 'height','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('height')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <select wire:model="h_unit" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="m">m</option>
                        <option value="cm">cm</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'bio','value' => ''.e(__('Bio')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'bio','value' => ''.e(__('Bio')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <small class="text-gray-500">Tell us about yourself</small>
                <textarea cols="50" wire:model="bio" class="block mt-1 w-full border-gray-400 text-gray-800 focus:outline-none focus:ring focus:border-secondary focus:ring-secondary focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
            </div>

            <div class="mt-4">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'profession','value' => ''.e(__('Profession')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'profession','value' => ''.e(__('Profession')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'profession','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'profession','type' => 'text','name' => 'profession','value' => old('profession'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'profession','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'profession','type' => 'text','name' => 'profession','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('profession')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </div>

            <div class="mt-4">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'town','value' => ''.e(__('Town')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'town','value' => ''.e(__('Town')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                 <small class="text-gray-500">Which town do you live in?</small>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'town','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'town','type' => 'text','name' => 'town','value' => old('town'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'town','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'town','type' => 'text','name' => 'town','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('town')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </div>



            <div class="mt-4 grid md:grid-cols-3 grid-cols-1 gap-4 justify-between">
                <div class="mt-1">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'instagram','value' => ''.e(__('Instagram Account')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'instagram','value' => ''.e(__('Instagram Account')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <small class="text-gray-500"><i class="fab fa-instagram"></i> Link to your Instagram account </small>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'instagram','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'instagram','type' => 'text','name' => 'instagram','value' => old('instagram'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'instagram','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'instagram','type' => 'text','name' => 'instagram','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('instagram')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                </div>

                <div class="mt-1">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'facebook','value' => ''.e(__('Facebook Account')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'facebook','value' => ''.e(__('Facebook Account')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <small class="text-gray-500"><i class="fab fa-facebook"></i>  Link to your Facebook account </small>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'facebook','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'facebook','type' => 'text','name' => 'facebook','value' => old('facebook'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'facebook','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'facebook','type' => 'text','name' => 'facebook','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('facebook')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                </div>

                <div class="mt-1">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'twitter','value' => ''.e(__('Twitter Account')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'twitter','value' => ''.e(__('Twitter Account')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <small class="text-gray-500"><i class="fab fa-twitter"></i> Link to your Twitter account </small>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'twitter','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'twitter','type' => 'text','name' => 'twitter','value' => old('twitter'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'twitter','class' => 'block mt-1 w-full border-gray-400 text-gray-800','wire:model' => 'twitter','type' => 'text','name' => 'twitter','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('twitter')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                </div>
            </div>


            <div class="my-4">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['class' => 'font-bold','for' => 'cover','value' => ''.e(__('Photo')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'font-bold','for' => 'cover','value' => ''.e(__('Photo')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <small class="text-gray-500">Upload a photo of yourself for this contest.</small>
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'cover','class' => 'block mt-1 w-full border-gray-400 text-gray-400','wire:model' => 'cover','type' => 'file','name' => 'cover','value' => old('cover'),'required' => true]]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'cover','class' => 'block mt-1 w-full border-gray-400 text-gray-400','wire:model' => 'cover','type' => 'file','name' => 'cover','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('cover')),'required' => true]); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                <?php if($cover): ?>
                    Photo Preview:
                    <img width="200px" src="<?php echo e($cover->temporaryUrl()); ?>">
                <?php endif; ?>
            </div>

                 <?php $__env->endSlot(); ?>

                     <?php $__env->slot('footer', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.secondary-button','data' => ['class' => 'bg-transparent text-gray-400','wire:click' => '$toggle(\'editCandidate\')','wire:loading.attr' => 'disabled']]); ?>
<?php $component->withName('jet-secondary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'bg-transparent text-gray-400','wire:click' => '$toggle(\'editCandidate\')','wire:loading.attr' => 'disabled']); ?>
                            Close
                         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.button','data' => ['class' => 'ml-2','wire:click' => 'update(\''.e($slug).'\')','wire:loading.class' => 'bg-transparent']]); ?>
<?php $component->withName('jet-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'ml-2','wire:click' => 'update(\''.e($slug).'\')','wire:loading.class' => 'bg-transparent']); ?>
                            Update
                            <div wire:loading wire:target="update">
                                <img width="20px" src="<?php echo e(asset("images/logo/loading.png")); ?>" class="animate-spin">
                            </div>
                         <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                 <?php $__env->endSlot(); ?>
             <?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php endif; ?>
</div>
<?php /**PATH /var/www/shosa/resources/views/livewire/candidate-component.blade.php ENDPATH**/ ?>