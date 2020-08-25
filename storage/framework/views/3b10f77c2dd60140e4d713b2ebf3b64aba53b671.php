<?php $__env->startSection('content'); ?>
<section class="gry-bg py-4 profile">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-lg-3 d-none d-lg-block">
                <?php if(Auth::user()->user_type == 'seller'): ?>
                    <?php echo $__env->make('frontend.inc.seller_side_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php elseif(Auth::user()->user_type == 'customer'): ?>
                    <?php echo $__env->make('frontend.inc.customer_side_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            </div>

            <div class="col-lg-9">
                <div class="main-content">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    <?php echo e(__('Support Ticket')); ?>

                                </h2>
                            </div>
                            <div class="col-md-6">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
                                        <li><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
                                        <li><a href="<?php echo e(route('support_ticket.index')); ?>"><?php echo e(__('Support Ticket')); ?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="dashboard-widget text-center plus-widget mt-4 c-pointer" data-toggle="modal" data-target="#ticket_modal">
                                <i class="la la-plus"></i>
                                <span class="d-block title heading-6 strong-400 c-base-1"><?php echo e(__('Create a Ticket')); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card no-border mt-4">
                        <table class="table table-sm table-hover table-responsive-md">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Ticket ID')); ?></th>
                                    <th><?php echo e(__('Sending Date')); ?></th>
                                    <th><?php echo e(__('Subject')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Options')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($tickets) > 0): ?>
                                    <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>#<?php echo e($ticket->code); ?></td>
                                            <td><?php echo e($ticket->created_at); ?></td>
                                            <td><?php echo e($ticket->subject); ?></td>
                                            <td>
                                                <?php if($ticket->status == 'pending'): ?>
                                                    <span class="badge badge-pill badge-danger">Pending</span>
                                                <?php elseif($ticket->status == 'open'): ?>
                                                    <span class="badge badge-pill badge-secondary">Open</span>
                                                <?php else: ?>
                                                    <span class="badge badge-pill badge-success">Solved</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(route('support_ticket.show', encrypt($ticket->id))); ?>" class="btn btn-styled btn-link py-1 px-0 icon-anim text-underline--none">
                                                    <?php echo e(__('View Details')); ?>

                                                    <i class="la la-angle-right text-sm"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center pt-5 h4" colspan="100%">
                                            <i class="la la-meh-o d-block heading-1 alpha-5"></i>
                                            <span class="d-block"><?php echo e(__('No history found.')); ?></span>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-wrapper py-4">
                        <ul class="pagination justify-content-end">
                            <?php echo e($tickets->links()); ?>

                        </ul>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>

<div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
        <div class="modal-content position-relative">
            <div class="modal-header">
                <h5 class="modal-title strong-600 heading-5"><?php echo e(__('Create a Ticket')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-3 pt-3">
                <form class="" action="<?php echo e(route('support_ticket.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control mb-3" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <label>Provide a detailed description <span class="text-danger">*</span></label>
                        <textarea class="form-control editor" name="details" placeholder="Type your reply" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="attachments[]" id="file-2" class="custom-input-file custom-input-file--2" data-multiple-caption="{count} files selected" multiple />
                        <label for="file-2" class=" mw-100 mb-0">
                            <i class="fa fa-upload"></i>
                            <span>Attach files.</span>
                        </label>
                    </div>
                    <div class="text-right mt-4">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('cancel')); ?></button>
                        <button type="submit" class="btn btn-base-1"><?php echo e(__('Send Ticket')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/per/medloo/resources/views/frontend/support_ticket/index.blade.php ENDPATH**/ ?>