<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5"><?php echo e(__('Order id')); ?>: <?php echo e($order->code); ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<?php
    $status = $order->orderDetails->first()->delivery_status;
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
?>

<div class="modal-body gry-bg px-3 pt-0">
    <div class="pt-4">
        <ul class="process-steps clearfix">
            <li <?php if($status == 'pending'): ?> class="active" <?php else: ?> class="done" <?php endif; ?>>
                <div class="icon">1</div>
                <div class="title"><?php echo e(__('Order placed')); ?></div>
            </li>
            <li <?php if($status == 'on_review'): ?> class="active" <?php elseif($status == 'on_delivery' || $status == 'delivered'): ?> class="done" <?php endif; ?>>
                <div class="icon">2</div>
                <div class="title"><?php echo e(__('On review')); ?></div>
            </li>
            <li <?php if($status == 'on_delivery'): ?> class="active" <?php elseif($status == 'delivered'): ?> class="done" <?php endif; ?>>
                <div class="icon">3</div>
                <div class="title"><?php echo e(__('On delivery')); ?></div>
            </li>
            <li <?php if($status == 'delivered'): ?> class="done" <?php endif; ?>>
                <div class="icon">4</div>
                <div class="title"><?php echo e(__('Delivered')); ?></div>
            </li>
        </ul>
    </div>
    <div class="card mt-4">
        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix">
            <div class="float-left"><?php echo e(__('Order Summary')); ?></div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600"><?php echo e(__('Order Code')); ?>:</td>
                            <td><?php echo e($order->code); ?></td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600"><?php echo e(__('Customer')); ?>:</td>
                            <td><?php echo e(json_decode($order->shipping_address)->name); ?></td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600"><?php echo e(__('Email')); ?>:</td>
                            <?php if($order->user_id != null): ?>
                                <td><?php echo e($order->user->email); ?></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600"><?php echo e(__('Shipping address')); ?>:</td>
                            <td><?php echo e(json_decode($order->shipping_address)->address); ?>, <?php echo e(json_decode($order->shipping_address)->city); ?>, <?php echo e(json_decode($order->shipping_address)->postal_code); ?>, <?php echo e(json_decode($order->shipping_address)->country); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600"><?php echo e(__('Order date')); ?>:</td>
                            <td><?php echo e(date('d-m-Y H:m A', $order->date)); ?></td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600"><?php echo e(__('Order status')); ?>:</td>
                            <td><?php echo e(ucfirst(str_replace('_', ' ', $status))); ?></td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600"><?php echo e(__('Total order amount')); ?>:</td>
                            <td><?php echo e(single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax'))); ?></td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600"><?php echo e(__('Shipping method')); ?>:</td>
                            <td><?php echo e(__('Flat shipping rate')); ?></td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600"><?php echo e(__('Payment method')); ?>:</td>
                            <td><?php echo e(ucfirst(str_replace('_', ' ', $order->payment_type))); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600"><?php echo e(__('Order Details')); ?></div>
                <div class="card-body pb-0">
                    <table class="details-table table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="30%"><?php echo e(__('Product')); ?></th>
                                <th><?php echo e(__('Variation')); ?></th>
                                <th><?php echo e(__('Quantity')); ?></th>
                                <th><?php echo e(__('Delivery Type')); ?></th>
                                <th><?php echo e(__('Price')); ?></th>
                                <?php if($refund_request_addon != null && $refund_request_addon->activated == 1): ?>
                                    <th><?php echo e(__('Refund')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $order->orderDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $orderDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td>
                                        <?php if($orderDetail->product != null): ?>
                                            <a href="<?php echo e(route('product', $orderDetail->product->slug)); ?>" target="_blank"><?php echo e($orderDetail->product->name); ?></a>
                                        <?php else: ?>
                                            <strong><?php echo e(__('Product Unavailable')); ?></strong>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e($orderDetail->variation); ?>

                                    </td>
                                    <td>
                                        <?php echo e($orderDetail->quantity); ?>

                                    </td>
                                    <td>
                                        <?php if($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery'): ?>
                                            <?php echo e(__('Home Delivery')); ?>

                                        <?php elseif($orderDetail->shipping_type == 'pickup_point'): ?>
                                            <?php if($orderDetail->pickup_point != null): ?>
                                                <?php echo e($orderDetail->pickup_point->name); ?> (<?php echo e(__('Pickip Point')); ?>)
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(single_price($orderDetail->price)); ?></td>
                                    <?php if($refund_request_addon != null && $refund_request_addon->activated == 1): ?>
                                        <?php
                                            $no_of_max_day = \App\BusinessSetting::where('type', 'refund_request_time')->first()->value;
                                            $last_refund_date = $orderDetail->created_at->addDays($no_of_max_day);
                                            $today_date = Carbon\Carbon::now();
                                        ?>
                                        <td>
                                            <?php if($orderDetail->product != null && $orderDetail->product->refundable != 0 && $orderDetail->refund_request == null && $today_date <= $last_refund_date && $orderDetail->delivery_status == 'delivered'): ?>
                                                <a href="<?php echo e(route('refund_request_send_page', $orderDetail->id)); ?>" class="btn btn-styled btn-sm btn-base-1"><?php echo e(__('Send')); ?></a>
                                            <?php elseif($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0): ?>
                                                <span class="strong-600"><?php echo e(__('Pending')); ?></span>
                                            <?php elseif($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1): ?>
                                                <span class="strong-600"><?php echo e(__('Approved')); ?></span>
                                            <?php elseif($orderDetail->product->refundable != 0): ?>
                                                <span class="strong-600"><?php echo e(__('N/A')); ?></span>
                                            <?php else: ?>
                                                <span class="strong-600"><?php echo e(__('Non-refundable')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card mt-4">
                <div class="card-header py-2 px-3 heading-6 strong-600"><?php echo e(__('Order Ammount')); ?></div>
                <div class="card-body pb-0">
                    <table class="table details-table">
                        <tbody>
                            <tr>
                                <th><?php echo e(__('Subtotal')); ?></th>
                                <td class="text-right">
                                    <span class="strong-600"><?php echo e(single_price($order->orderDetails->sum('price'))); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo e(__('Shipping')); ?></th>
                                <td class="text-right">
                                    <span class="text-italic"><?php echo e(single_price($order->orderDetails->sum('shipping_cost'))); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo e(__('Tax')); ?></th>
                                <td class="text-right">
                                    <span class="text-italic"><?php echo e(single_price($order->orderDetails->sum('tax'))); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th><?php echo e(__('Coupon Discount')); ?></th>
                                <td class="text-right">
                                    <span class="text-italic"><?php echo e(single_price($order->coupon_discount)); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="strong-600"><?php echo e(__('Total')); ?></span></th>
                                <td class="text-right">
                                    <strong><span><?php echo e(single_price($order->grand_total)); ?></span></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php if($order->manual_payment && $order->manual_payment_data == null): ?>
                <button onclick="show_make_payment_modal(<?php echo e($order->id); ?>)" class="btn btn-block btn-base-1"><?php echo e(__('Make Payment')); ?></button>
            <?php endif; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    function show_make_payment_modal(order_id){
        $.post('<?php echo e(route('checkout.make_payment')); ?>', {_token:'<?php echo e(csrf_token()); ?>', order_id : order_id}, function(data){
            $('#payment_modal_body').html(data);
            $('#payment_modal').modal('show');
            $('input[name=order_id]').val(order_id);
        });
    }
</script>
<?php /**PATH /var/www/html/per/medloo/resources/views/frontend/partials/order_details_customer.blade.php ENDPATH**/ ?>