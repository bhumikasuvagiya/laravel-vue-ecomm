<template>
<div class="card col-lg-12 order_status_view_main">
           <h1 class="title">Your Order Number is #{{ order_number }}. Thank You! </h1>
        </div>
</template>
<script>
export default {
    name : 'OrderStatusView',
    setup(){
        const order_number = localStorage.getItem('order_id') || '';
        return {
            order_number,
        }
    }
}
</script>